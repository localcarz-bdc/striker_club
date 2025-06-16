<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Traits\Notify;
use App\Models\Invoice;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Mail\DebutantApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminMembershipController extends Controller
{
    use Notify;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $leads = $this->leadService->all();
        // dd($data);
        if ($request->ajax()) {
            $data = Member::orderByDesc('id');
            // $info = $data->get();
            // dd($info);
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function ($row) {
                        $html = '';
                        $html .= '<div class="icheck-primary  text-center">
                        <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                        </div>';

                        return $html;
                    })
                    ->addColumn('date', function ($row) {
                        $timestamp = $row->created_at;
                        $date = Carbon::parse($timestamp);

                        // Format the date as required
                        // $formattedDate = $date->format('d M Y'); // 29 Jan 2024
                        $formattedDate = $date->format('m-d-Y'); // 29 Jan 2024
                        $formattedTime = $date->format('H:i');   // 18:09
                        return  $formattedDate . ' ' . $formattedTime;
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
                        $html = '<a href="'. route('admin.member.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                         '<a href="'. route('admin.member.edit',$row->id).'" class="btn btn-sm btn-primary" id="edit" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;'.
                        ' &nbsp;<a href="'.route('admin.member.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                        //  &nbsp;<a href="#" class="btn btn-sm btn-warning permanentDeleteLead" title="delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','ageNo','is_approve'])
                    ->make(true);
        }
        return view('backend.membership.membership');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.membership.ajax.create_membership');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:members,email',
            'confirm_email' => 'required|email|same:email',
            // 'confirm_email' => 'required|email',
            'marital' => 'required',
            'spouse' => 'required',
            'spouse_dob' => 'required',
            'educational_background' => 'required',
            'occupation' => 'required',
            'religious_affiliation' => 'required',
            'hobbies' => 'required',
            'other_affiliations' => 'required',
            'why_desire' => 'required',
            // 'striker_category' => 'required',
            'signature_date' => 'required',
            'name_of_striker' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $birthdate = Carbon::parse($request->dob);
        $age = $birthdate->diffInYears(Carbon::now());

        $member_data = new Member();
        $member_data->fname = $request->fname;
        $member_data->lname = $request->lname;
        $member_data->dob = $request->dob;
        $member_data->age = $age;
        $member_data->address = $request->address;
        $member_data->city = $request->city;
        $member_data->state = $request->state;
        $member_data->zip = $request->zip;
        $member_data->telephone = $request->telephone;
        $member_data->email = $request->email;
        $member_data->balance = $request->balance;
        $member_data->marital = $request->marital;
        $member_data->spouse = $request->spouse;
        $member_data->spouse_dob = $request->spouse_dob;
        $member_data->educational_background = $request->educational_background;
        $member_data->occupation = $request->occupation;
        $member_data->religious_affiliation = $request->religious_affiliation;
        $member_data->hobbies = $request->hobbies;
        $member_data->other_affiliations = $request->other_affiliations;
        $member_data->why_desire = $request->why_desire;
        $member_data->name_of_striker = $request->name_of_striker;
        $member_data->signature_date = $request->signature_date;
        $member_data->is_approve = 0;
        $member_data->is_read = 0;
        $member_data->save();

        // return response()->json(['success' => 'Member added successfully']);
        $data =[
            'name'=> $request->fname,
            // 'id'=> 31,
            // 'password'=> 12345678,
        ];
        Mail::to($request->email)->send(new DebutantApplication($data));

        $notification_title = 'Member Applicant Recieved';
        $notification_message = $request->email;
        $notification_admin_call_back_url = 'admin.member.index';
        $notification_member__call_back_url = null;
        $notificatioN_auth_id = -1;
        $notification_category = 'member-application';
        $notificationId = $this->saveNewNotification( $notification_title, $notification_message, $notification_admin_call_back_url,$notification_member__call_back_url, $notificatioN_auth_id,$notification_category);

        return response()->json(['success' => 'Member added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $membership =  Member::find($id);
        $membership->is_read = 1;
        $membership->save();
        return view('backend.membership.ajax.view_membership', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $membership =  Member::find($id);
        return view('backend.membership.ajax.edit_membership', compact('membership'));
    }

    public function isApprove(Request $request, $id)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'total_balance' => 'nullable|numeric',
                'pay_balance' => 'nullable|numeric',
                'type' => 'nullable'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $membership = Member::find($request->id);
            $user = User::where('email', $membership->email)->first();

            if ($request->value == 1) {

                if ($user != null) {
                    return response()->json(['errors' => 'Member email already exists',422]);
                }

                $user_data = new User();
                $user_data->name = $membership->fname . ' ' . $membership->lname;
                $user_data->email = $membership->email;
                $user_data->total_balance = $request->total_balance;
                $user_data->due_balance = $request->pay_balance;
                $user_data->type = $request->type;
                $user_data->password = bcrypt(12345678);
                $user_data->role = 0;
                $user_data->status = 1;
                $user_data->designation = 'Member';
                $user_data->save();

                $invoice = New Invoice();
                $invoice->user_id = $user_data->id;
                $invoice->username = $user_data->name;
                $invoice->phone = $membership->phone;
                $invoice->email = $user_data->email;
                $invoice->total_balance  = $user_data->total_balance ;
                $invoice->due_balance = $user_data->due_balance;
                $invoice->type = $user_data->type;
                $invoice->discount = $user_data->discount;
                $invoice->discount_type = 0;
                $invoice->save();

                // $membership->user_id = $user_data->id;
                $membership->is_approve = 1;
                $membership->save();

                $dataToCompact = [
                    'username' => $invoice->username ?? '',
                    'phone' => $invoice->phone ?? '',
                    'email' => $invoice->email ?? '' ,
                    'total_balance' => $invoice->total_balance ?? 0,
                    'due_balance' => $invoice->due_balance ?? 0,
                    'type' => $invoice->type ?? '',
                    'discount_type' => $invoice->discount_type ?? '',
                    'discount' => $invoice->discount ?? 0,
                ];


                // $pdf = PDF::loadView('backend.pdf.invoice',$dataToCompact);
                //  return $pdf->stream('invoice_' . rand(1234, 9999) . '.pdf');

                return response()->json(['success' => 'Membership approved successfully']);
            } else {
                // dd($request->all);
                $user->delete();
                $membership->is_approve = 0;
                $membership->save();

                return response()->json(['success' => 'Membership rejected successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:members,email,'.$request->memberId,
            'confirm_email' => 'required|email|same:email',
            // 'confirm_email' => 'required|email',
            'marital' => 'required',
            'spouse' => 'required',
            'spouse_dob' => 'required',
            'educational_background' => 'required',
            'occupation' => 'required',
            'religious_affiliation' => 'required',
            'hobbies' => 'required',
            'other_affiliations' => 'required',
            'why_desire' => 'required',
            // 'striker_category' => 'required',
            'signature_date' => 'required',
            'name_of_striker' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $birthdate = Carbon::parse($request->dob);
        $age = $birthdate->diffInYears(Carbon::now());

        $member_data = Member::find($request->memberId);
        $member_data->fname = $request->fname;
        $member_data->lname = $request->lname;
        $member_data->dob = $request->dob;
        $member_data->age = $age;
        $member_data->address = $request->address;
        $member_data->city = $request->city;
        $member_data->state = $request->state;
        $member_data->zip = $request->zip;
        $member_data->telephone = $request->telephone;
        $member_data->email = $request->email;
        $member_data->balance = $request->balance;
        $member_data->marital = $request->marital;
        $member_data->spouse = $request->spouse;
        $member_data->spouse_dob = $request->spouse_dob;
        $member_data->educational_background = $request->educational_background;
        $member_data->occupation = $request->occupation;
        $member_data->religious_affiliation = $request->religious_affiliation;
        $member_data->hobbies = $request->hobbies;
        $member_data->other_affiliations = $request->other_affiliations;
        $member_data->why_desire = $request->why_desire;
        $member_data->name_of_striker = $request->name_of_striker;
        $member_data->signature_date = $request->signature_date;
        $member_data->is_approve = 0;
        $member_data->is_read = 0;
        $member_data->save();

        $data =[
            'name'=> $request->fname,
            // 'id'=> 31,
            // 'password'=> 12345678,
        ];
        // Mail::to($request->email)->send(new DebutantApplication($data));

        $notification_title = 'Member updated Recieved';
        $notification_message = $request->email;
        $notification_admin_call_back_url = 'admin.member.index';
        $notification_member__call_back_url = null;
        $notificatioN_auth_id = -1;
        $notification_category = 'member-application';
        $notificationId = $this->saveNewNotification( $notification_title, $notification_message, $notification_admin_call_back_url,$notification_member__call_back_url, $notificatioN_auth_id,$notification_category);

        return response()->json(['success' => 'Member added successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Member::find($id);
        $data->delete();

        return response()->json(['success' => 'Membership deleted successfully']);
    }
}
