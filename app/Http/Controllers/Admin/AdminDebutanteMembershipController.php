<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\DebutanteMembership;
use App\Http\Controllers\Controller;

class AdminDebutanteMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $leads = $this->leadService->all();
        // dd($data);
        if ($request->ajax()) {
            $data = DebutanteMembership::with('membershipInfo')->orderByDesc('id');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function ($row) {
                        $html = '';
                        $html .= '<div class="icheck-primary  text-center">
                        <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                        </div>';

                        return $html;
                    })
                    ->addColumn('plus', function ($row) {
                        return  "<a href='#' class='toggle-details'><i
                        class='fa-solid fa-circle-plus'></i></a>"; // Use plus for collapse
                    })
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })
                    ->editColumn('name', function ($row) {
                        return $row->fname.' '.$row->lname; // Use any unique identifier for your rows
                    })
                    ->editColumn('birth', function ($row) {
                        return Carbon::parse($row->dob)->format('M d, Y ').'('.$row->age.')'; // Use any unique identifier for your rows
                    })
                    ->editColumn('adress_info', function ($row) {
                        return $row->address.' '.$row->city.' '.$row->state.' '.$row->zip; // Use any unique identifier for your rows
                    })
                    ->editColumn('is_approve', function ($row) {
                        $html = '<select name="" id="is_approve" class="form-control is_approve" data-isApproveId="' . $row->id . '">
                                    <option value="1" ' . ($row->is_approve == 1 ? 'selected' : '') . '>Approve</option>
                                    <option value="0" ' . ($row->is_approve == 0 ? 'selected' : '') . '>Reject</option>
                                </select>';

                        return $html;
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.debutante.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                         '<a href="'. route('admin.debutante.edit',$row->id).'" class="btn btn-sm btn-primary" id="edit" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;'.
                        ' &nbsp;<a href="'.route('admin.debutante.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                        //  &nbsp;<a href="#" class="btn btn-sm btn-warning permanentDeleteLead" title="delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','ageNo','is_approve'])
                    ->make(true);
        }
        return view('backend.debutante.admin_debutante_membership');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $membership =  DebutanteMembership::with('membershipInfo')->find($id);
        $membership->is_read = 1;
        $membership->save();
        return view('backend.debutante.ajax.view_debutante_membership', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $membership =  DebutanteMembership::with('membershipInfo')->find($id);
        return view('backend.debutante.ajax.edit_debutante_membership', compact('membership'));
    }

    public function isApprove(Request $request,$id)
    {
        ($request->value == 1)? $value = 100 : $value = 0;

        $membership =  DebutanteMembership::with('membershipInfo')->find($request->id);
        $user = User::where('email',$membership->email)->first();

        if($user == null){
            return response()->json(['error' => 'Debutante email already exist']);
        }

        $membership->is_approve = $request->value;
        $membership->balance = $value;
        $membership->save();

        if($request->value == 1){
            $user_data =new User();
            $user_data->name = $membership->fname.' '.$membership->lname;
            $user_data->email = $membership->email;
            $user_data->password = bcrypt(12345678);
            $user_data->role = 0;
            $user_data->designation = 'Debutant';
            $user_data->save();
            return response()->json(['success' => 'Debutante membership approved successfully']);
        }else{
            $user->delete();
            return response()->json(['success' => 'Debutante membership reject successfully']);
        }

        // $dataToCompact = [
        //     'username' => $invoices->username ?? '',
        //     'phone' => $invoices->phone ?? '',
        //     'email' => $invoices->email ?? '' ,
        //     'membership_type' => $result,
        //     'membership_price' => $price,
        //     'membership_type_old' => $result_old,
        //     'membership_price_old' => $price_old,
        // ];
        // $pdf = PDF::loadView('admin.pdf.membership_invoice',$dataToCompact);
        //  return $pdf->stream('invoice_' . rand(1234, 9999) . '.pdf');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DebutanteMembership::find($id);
        $data->delete();

        return response()->json(['success' => 'Debutante membership deleted successfully']);
    }
}
