<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Balance;
use App\Models\DueOrder;
use App\Models\TmpInvoice;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AdminInvoiceConrtroller extends Controller
{

    public function index(Request $request, $id = null)
    {
        if($request->ajax()){
            $data = DueOrder::orderByDesc('created_at');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $html = '';
                    $html .= '<div class="icheck-primary  text-center">
                    <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                    </div>';

                    return $html;
                })
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id; // Use any unique identifier for your rows
                })
                ->editColumn('invoiceNo', function ($row) {
                    return $row->invoice_id;
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('type', function ($row) {
                    return 'Membership Fee';
                })
                ->addColumn('Payment method', function ($row) {
                    if($row->pay_type == 1){
                        $cus_pay = 'Card';
                    }else if($row->pay_type == 2){
                        $cus_pay = 'Cash';
                    }else{
                        $cus_pay = 'Check';
                    }
                    return $cus_pay;
                })
                ->addColumn('total', function ($row) {
                    return  $row->subtotal ;
                })
                ->addColumn('Payment date', function ($row) {
                    $paymentDate = Carbon::parse($row->updated_at)->format('m-d-Y');
                    return  $paymentDate ;
                })
                ->editColumn('status', function ($row) {
                    $html = '<select name="status" id="approveInvoice" class="form-control approveInvoice" data-id="' . $row->id . '">';
                    $html .= '<option value="">Select Status</option>';
                    $html .= '<option value="1" ' . ($row->status == 1 ? 'selected' : '') . '>Approve</option>';
                    $html .= '<option value="0" ' . ($row->status == 0 ? 'selected' : '') . '>Pending</option>';
                    ($row->pay_type == 3) ? $html .= '<option value="3" ' . ($row->status == 3 ? 'selected' : '') . '>Processing</option>' : null ;
                    $html .= '<option value="2" ' . ($row->status == 2 ? 'selected' : '') . '>Blocked</option>';
                    $html .= '</select>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $html = '<a href="'.route('admin.invoice.pdf', $row->id).'" title="Download PDF" target="_blank"  class="btn btn-sm btn-primary download_pdf" title="Edit"  data-id="'.$row->id.'"><i class="fa fa-file-pdf fs-5"></i></a>
                    &nbsp;<a href="'.route('admin.invoice.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    return $html;
                })
                ->rawColumns(['action', 'check','status'])
                ->make(true);
        }

        return view('backend.admin_invoice.invoice_list');
    }

    public function destroy(string $id)
    {
        $data = DueOrder::find($id);
        $data->delete();
       return response()->json(['success' => 'Invoice deleted successfully']);
    }


    public function invoicePdf($id)
    {
        try
        {
            $dataToCompact = DueOrder::find($id);
            // dd($dataToCompact);
            $pdf = PDF::loadView('member.pdf.invoice-download', compact('dataToCompact'));
            return $pdf->stream('Strikers Club - ' . rand(1234, 9999) . '.pdf');

        }catch(Exception $e)
        {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function invoiceStatusChange(Request $request,$id)
    {
        $dueorder = DueOrder::find($id);
        $user_id = $dueorder->user_id;

        $dueorder->status = $request->status;
        $dueorder->update();

        if($request->status == 1)
        {
            $due_amount = strVal(str_replace('$','',$dueorder->total));
            $paid_amount = strVal(str_replace('$','',$dueorder->subtotal));
            $calcauate = $due_amount - $paid_amount;
            $balance_amount = ($calcauate < 0) ? 0: $calcauate ;
            Balance::create([
                'user_id' => $user_id,
                'due' => $due_amount,
                'paid' => $paid_amount,
                'balance' => $balance_amount,
                'action_by' => Auth::user()->id,
                'year' => date('Y'),
            ]);
            $user = User::find($user_id);
            $user->paid_balance = $paid_amount;
            $user->due_balance = $balance_amount;
            $user->update();

            return response()->json(['success' => 'Invoice approved successfully']);
        }else{
            // Balance::find($user_id)->latest();
            return response()->json(['success' => 'Invoice updated successfully']);
        }
    }

    public function bulkInvoice(Request $request)
    {
        ($request->paymentType == 'full') ? $pay = $request->fullPaymentPrice : $pay = $request->customInput;

        try {
                    $invoicesToInsert[] = [
                        'lead_id' => $request->userId,
                        'price' => $pay, // Assuming 'price' is a key in your request
                        'user_id' => Auth::id(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                // }

               $invoice =  TmpInvoice::insert($invoicesToInsert);
               return response()->json(['status' => 'success', 'message' => 'Payment added into cart!']);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function individualInvoice(Request $request, $id)
    {
        // dd($request->all(), $id, Auth::user()->id);
        ($request->paymentType == 'full') ? $pay = $request->fullPaymentPrice : $pay = $request->customInput;

        try {
                    $invoicesToInsert[] = [
                        // 'lead_id' => $request->userId,
                        'lead_id' => Auth::user()->id,
                        'price' => $pay, // Assuming 'price' is a key in your request
                        'user_id' => $id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                // }
                // dd($invoicesToInsert);
               $invoice =  TmpInvoice::insert($invoicesToInsert);
               return response()->json(['status' => 'success', 'message' => 'Payment added into cart!']);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function InvoiceShow(Request $request)
    {
        // dd($request->all());
        $invoices = TmpInvoice::where('user_id', Auth::id())->orWhere('lead_id', Auth::id())->where('status',0)->orderByDesc('id')->get();
        return view('backend.cart.cart', compact('invoices'));
    }

    public function invoiceNewStore(Request $request)
    {
        try {
            $newInvoice = new DueOrder();
                $update_invoice = TmpInvoice::where('user_id',Auth::id())->get();
                foreach($update_invoice as $update)
                {
                    $update->status = 1;
                    $update->save();
                }
            switch($request->pay_type){
                case 'card':
                    $custom_pay = 1;
                    break;
                case 'cash':
                    $custom_pay = 2;
                    break;
                default:
                    $custom_pay = 3;
            }

            $newInvoice->user_id = $request->user_id;
            $newInvoice->subtotal = $request->subtotal;
            $newInvoice->total = '$'.Auth::user()->due_balance;
            $newInvoice->discount = $request->discount;
            $newInvoice->pay_type = $custom_pay;
            $newInvoice->save();
            $newInvoice->get_invoice_id();

            Log::info('Inventory status update  successful');
            return response()->json([
                'status' => 'success',
                'message'=>'Invoice create  successfully'
           ]);

        } catch (Exception $e) {
            Log::error('Error in DueOrder creation: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function allInvoice(Request $request, $id = null)
    {
        if($request->ajax()){
            $data = DueOrder::orderByDesc('created_at')->where('user_id', Auth::user()->id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $html = '';
                    $html .= '<div class="icheck-primary  text-center">
                    <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                    </div>';

                    return $html;
                })
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id; // Use any unique identifier for your rows
                })
                ->editColumn('invoiceNo', function ($row) {
                    return $row->invoice_id;
                })
                ->editColumn('date', function ($row) {
                    $formattedDate = Carbon::parse($row->created_at)->format('m-d-Y');
                    return $formattedDate;
                })
                ->editColumn('details', function ($row) {
                    return 'Membership Fee';
                })
                ->addColumn('paid', function ($row) {
                    return $row->subtotal;
                })
                ->addColumn('type', function ($row) {
                    return '<p>Annual Fee</p>';
                })
                ->addColumn('method', function ($row) {
                    if($row->pay_type == 1){
                        $cus_pay = 'Card';
                    }else if($row->pay_type == 2){
                        $cus_pay = 'Cash';
                    }else{
                        $cus_pay = 'Check';
                    }
                    return $cus_pay;
                })
                ->editColumn('status', function ($row) {
                    if($row->status == 0){
                        $html = '<span class="bg-warning p-1">Pending</span>';
                    }else if($row->status == 1){
                        $html = '<span class="bg-success p-1">Approved</span>';
                    }else if($row->status == 3){
                        $html = '<span class="bg-primary p-1">Processing</span>';
                    }else{
                        $html = '<span class="bg-danger p-1">Blocked</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $downloadPdfUrl = route('admin.invoice.pdf', ['id' => $row->id]);
                    $deleteUrl = route('admin.invoice.new.delete', ['id' => $row->id]);
                    $html = '<a href="' . $downloadPdfUrl . '" title="Download PDF" target="_blank" class="btn btn-sm btn-primary download_pdf"  data-id="' . $row->id . '" data-type="' . $row->type . '"><i class="fa fa-file-pdf fs-5"></i></a>&nbsp;';
                    if($row->status == 0){
                        $html .='<a href="'.$deleteUrl.'" id="delete" data-id="'.$row->id.'" data-user_id="'.$row->id.'" class="btn btn-sm delete_two text-white btn-danger"  title="Delete"> <i class="fa fa-trash"></i> </a> &nbsp;';
                    }
                    return $html;
                })
                ->rawColumns(['type','action','method', 'Payment date', 'status','check'])
                ->make(true);
        }
        return view('backend.own_invoice.invoice-list');
    }

    public function invoiceNewDelete($id)
    {
        $due_order = DueOrder::find($id);
        if ($due_order) {
            $due_order->delete();
        }
        return response()->json(['success' => 'Invoice deleted successfully']);
    }

}
