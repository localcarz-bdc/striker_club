<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Member;
use App\Models\Balance;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;
use Illuminate\Support\Facades\Auth;

class AdminMemberController extends Controller
{
    public function __construct(protected CommonServiceInterface $commonService, protected FileUploaderServiceInterface $fileUploader){}

    public function index(Request $request)
    {
        // $leads = $this->leadService->all();
        // $data = User::where('name','!=','Super Admin')->where('designation','!=','Admin')->where('name','!=','Marif Akter')->where('name','!=','Developer')->where('designation','!=','Debutant')->orderByDesc('id');
        $data = User::whereNot('name', 'Marif Akter')
        ->whereNotIn('designation', ['Admin', 'Debutant','Super Admin','Developer'])
        ->orderByDesc('id')
        ->get();
        if ($request->ajax()) {
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
                    ->addColumn('DT_RowIndex', function ($row) {
                        return $row->id; // Use any unique identifier for your rows
                    })

                    ->editColumn('role', function ($row) {
                        $designations = Designation::where('status', 1)->get();

                        $html = '<select name="approveRole" id="approveRole" class="form-control is_approve" data-isApproveId="' . $row->id . '">';
                        $html .= '<option value="1" ' . ($row->role == 1 ? 'selected' : '') . '>Admin</option>';
                        $html .= '<option value="0" ' . ($row->role == 0 ? 'selected' : '') . '>Member</option>';
                        $html .= '</select>';

                        $html .= '<input type="hidden" name="designationId" class="designationId" value="' . $row->id . '">';

                        return $html;
                    })

                    ->editColumn('email', function ($row) {
                        return $row->email ?? '' ; // Use any unique identifier for your rows
                    })
                    ->editColumn('status', function ($row) {
                        return ($row->status == 1)? 'Active' : 'Inactive' ; // Use any unique identifier for your rows
                    })
                    ->editColumn('total', function ($row) {
                        return ($row->total_balance == Null)? '$'.'0' : '$'.$row->total_balance ; // Use any unique identifier for your rows
                    })
                    ->editColumn('paid', function ($row) {
                        return ($row->paid_balance == Null)? '$'.'0' : '$'.$row->paid_balance ; // Use any unique identifier for your rows
                    })
                    ->editColumn('due', function ($row) {
                        return ($row->due_balance == Null)? '$'.'0' : '$'.$row->due_balance ; // Use any unique identifier for your rows
                    })

                    ->addColumn('img', function ($row) {

                        $filePath = public_path("frontend/assets/img/members/{$row->image}");

                        if (file_exists($filePath)) {
                            ($row->image === null) ? $data = '400x600.png' : $data = $row->image ;
                            $url = asset("frontend/assets/img/members/{$data}");
                        } else {
                            $url = asset("frontend/assets/img/members/400x600.png");
                        }

                        // $filePath = public_path("frontend/assets/img/members/{$row->image}");

                        // (file_exists($filePath)) ? $url = asset("frontend/assets/img/members/{$row->image}") : $url = asset("frontend/assets/img/members/400x600.png") ;

                        return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" loading="lazy"/>';
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.individual.profile.payment',$row->id).'" class="btn btn-sm btn-primary" id="makepayment" title="Payment"><i class="fa fa-cubes"></i></a>&nbsp;&nbsp;'.
                        '<a href="'. route('admin.membersData.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        '&nbsp;<a href="'.route('admin.membersData.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                        &nbsp;<a href="'.route('admin.membersData.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','img','role'])
                    ->make(true);
        }
        return view('backend.member_management.admin_member');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $designations = Designation::pluck('name');
        return view('backend.member_management.ajax.create_admin_member', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
           [
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:users,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
           ]
        );

        $due_balance = $request->total_balance - $request->paid_balance;

        $attribute['name'] = $request->name;
        $attribute['email'] = $request->email;
        $attribute['total_balance'] = $request->total_balance;
        $attribute['paid_balance'] = $request->paid_balance;
        $attribute['due_balance'] = $due_balance;
        $attribute['designation'] = $request->designation;
        ($request->designation == 'Member') ? $attribute['role'] = 0  : $attribute['role'] = 1 ;
        $attribute['password'] = bcrypt(12345678);
        $attribute['status'] = $request->status;
        if (isset($request->img)) {
            $attribute['image'] = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/members/');

            $member = User::create($attribute);
            if (!isset($member) or empty($member)) {
                File::delete('frontend/assets/img/members/' . $tmpImagePath);
            }
        }else{
            $member = User::create($attribute);
        }

        $lastInsertId = $member->id;
        $data['user_id'] = $lastInsertId;
        $data['due'] = $request->total_balance;
        $data['paid'] = $request->paid_balance;
        $data['balance'] = $due_balance;
        $data['action_by'] = Auth::user()->id;
        $data['year'] = intval(date('Y'));
        Balance::create($data);

        return response()->json(['success' => 'Member added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = User::find($id);
        // dd($member);
        $member->is_read = 1;
        $member->save();
        return view('backend.member_management.ajax.view_admin_member', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::find($id);
        $designations = Designation::pluck('name');
        return view('backend.member_management.ajax.edit_admin_member', compact('member','designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = $request->member_id;
        $request->validate([
             'name' => 'required',
             'email' => 'required|email|unique:users,email,' . $userId,
             'designation' => 'required',
             'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'status' => 'required',
            ]);

            $due_balance = $request->total_balance - $request->paid_balance;

            $member = User::find($request->member_id);
            $member->name = $request->name;
            $member->email = $request->email;
            $member->total_balance = $request->total_balance;
            $member->paid_balance = $request->paid_balance;
            $member->due_balance = $due_balance;
            $member->designation = $request->designation;
            $member->status = $request->status;

            if (!empty($member->img)) {
                File::delete('frontend/assets/img/members/' . $member->image);
            }
            if (isset($request->img)) {
                $member->image = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/members/');
                $member = $member->update();
            }else{
                $member = $member->update();
            }

            $balance = Balance::where('user_id',$request->member_id)->first();

            if($balance){
                $balance->user_id = $request->member_id;
                $balance->due = $request->total_balance;
                $balance->paid = $request->paid_balance;
                $balance->balance = $due_balance;
                $balance->action_by = Auth::user()->id;
                $balance->year = intVal(date('Y'));
                $balance->update();
            }else{
                $balance = new Balance();
                $balance->user_id = $request->member_id;
                $balance->due = $request->total_balance;
                $balance->paid = $request->paid_balance;
                $balance->balance = $due_balance;
                $balance->action_by = Auth::user()->id;
                $balance->year = intval(date('Y'));
                $balance->save();
            }


            return response()->json(['success' => 'Member updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $data = User::find($id);

        if (!empty($data->image)) {
            File::delete('frontend/assets/img/members/' . $data->image);
        }

        $data->delete();
       return response()->json(['success' => 'Member deleted successfully']);
    }
}
