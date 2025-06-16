<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\DueOrder;
use App\Models\TmpInvoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Session;

class MemberInvoiceConrtroller extends Controller
{
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

    public function InvoiceShow(Request $request)
    {
        $invoices = TmpInvoice::where('user_id', Auth::id())->where('status',0)->orderByDesc('id')->get();
        return view('member.cart.cart', compact('invoices'));
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
            $data = Payment::orderByDesc('created_at')->where('user_id', Auth::user()->id);
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
                    return $row->payment_id;
                })
                ->editColumn('date', function ($row) {
                    $formattedDate = Carbon::parse($row->created_at)->format('m-d-Y');
                    return $formattedDate;
                })
                ->editColumn('details', function ($row) {
                    return $row->pay_status;
                })
                ->addColumn('paid', function ($row) {
                    return $row->subtotal;
                })
                ->addColumn('type', function ($row) {
                    return '<p>Annual Fee</p>';
                })
                // ->addColumn('total', function ($row) {
                //     Auth::user()->()
                //     return '<p>Annual Fee</p>';
                // })
                ->addColumn('method', function ($row) {
                    // if($row->pay_type == 1){
                    //     $cus_pay = 'Card';
                    // }else if($row->pay_type == 2){
                    //     $cus_pay = 'Cash';
                    // }else{
                    //     $cus_pay = 'Check';
                    // }
                    // return $cus_pay;
                    return $row->pay_type;
                })
                ->editColumn('amount', function ($row) {
                    return '$' . number_format($row->amount, 2);
                })
                ->editColumn('status', function ($row) {
                    // if($row->status == 0){
                    //     $html = '<span class="bg-warning p-1">Pending</span>';
                    // }else if($row->status == 1){
                    //     $html = '<span class="bg-success p-1">Approved</span>';
                    // }else if($row->status == 3){
                    //     $html = '<span class="bg-primary p-1">Processing</span>';
                    // }else{
                    //     $html = '<span class="bg-danger p-1">Blocked</span>';
                    // }
                    // return $html;
                    return $row->payment_status;
                })
                ->addColumn('action', function ($row) {
                    $downloadPdfUrl = route('member.invoice.pdf', ['id' => $row->id]);
                    $deleteUrl = route('member.invoice.new.delete', ['id' => $row->id]);
                    $html = '<a href="' . $downloadPdfUrl . '" title="Download PDF" target="_blank" class="btn btn-sm btn-primary download_pdf"  data-id="' . $row->id . '" data-type="' . $row->type . '"><i class="fa fa-file-pdf fs-5"></i></a>&nbsp;';
                    // if($row->status == 0){
                    //     $html .='<a href="'.$deleteUrl.'" id="delete" data-id="'.$row->id.'" data-user_id="'.$row->id.'" class="btn btn-sm delete_two text-white btn-danger"  title="Delete"> <i class="fa fa-trash"></i> </a> &nbsp;';
                    // }
                    return $html;
                })
                ->rawColumns(['type','action','method', 'Payment date', 'status','check'])
                ->make(true);
        }
        return view('member.member_invoice.invoice-list');
    }


    public function invoicePdf($id)
    {
        try
        {
            // $dataToCompact = DueOrder::find($id);
            $dataToCompact = Payment::find($id);
            // $pdf = PDF::loadView('member.pdf.invoice-download', compact('dataToCompact'));
            $pdf = PDF::loadView('member.pdf.invoice-download', compact('dataToCompact'));
            return $pdf->stream('Strikers Club - ' . rand(1234, 9999) . '.pdf');

        }catch(Exception $e)
        {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
