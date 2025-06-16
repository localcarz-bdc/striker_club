<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;

class AdminProfileController extends Controller
{
    public function __construct(protected CommonServiceInterface $commonService, protected FileUploaderServiceInterface $fileUploader){}

    public function index(Request $request)
    {
        $users = User::where('id', Auth::id());
        if ($request->ajax()) {
            return DataTables::of($users)
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

                    ->editColumn('designation', function ($row) {

                        $designations = Designation::where('status', 1)->get();
                        $html = '<select name="" id="approveDesignation" class="form-control is_approve" data-isApproveId="' . $row->id . '">';

                        foreach ($designations as $designation) {
                            $html .= '<option value="' . $designation->name . '" ' . ($row->designation == $designation->name || $row->designation == Null ? 'selected' : '') . 'disabled>' . $designation->name . '</option>';
                        }
                        $html .= '</select>';
                        $html .= '<input type="hidden" name="designationId" class="designationId" value="'.$row->id.'">';

                        return $html;
                    })
                    ->editColumn('status', function ($row) {
                        return ($row->status == 1)? 'Active' : 'Inactive' ; // Use any unique identifier for your rows
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
                        $html = '<a href="'. route('admin.membersData.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        '<a href="'.route('admin.membersData.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a> &nbsp;'.
                        '<a href="'. route('admin.profile.reset').'" class="btn btn-sm btn-warning" id="reset" title="Reset Password"><i class="fa fa-key"></i></a>'.
                        '&nbsp; &nbsp;<a href="'. route('admin.profile.payment',$row->id).'" class="btn btn-sm btn-primary" id="makepayment" title="Payment"><i class="fa fa-cubes"></i></a>';
                        // &nbsp;<a href="'.route('admin.membersData.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','img','designation'])
                    ->make(true);
        }

        return view('backend.profile.profile');

    }

    public function reset()
    {
        return view('backend.profile.ajax.profile_reset');
    }

    public function resetStore(Request $request)
    {
        $request->validate([
            'previous_password' => 'required',
            'password' => 'required|min:8|confirmed', // 'confirmed' will look for a matching 'password_confirmation' field
        ]);

        if (Auth::check()) {
            $user = Auth::user();

            if (Hash::check($request->previous_password, $user->password)) {

                $user->password = Hash::make($request->password);
                $user->save();

                return response()->json(['success' => 'Password reset successfully']);
            } else {
                // Password is not correct
                return response()->json(['error' => 'Previous password is incorrect'], 422);
            }
        } else {
            // User is not authenticated
            return response()->json(['error' => 'User is not authenticated'], 403);
        }
    }

    public function payment(Request $request, $id)
    {
        // dd($id);
        $balance = User::find($id)->due_balance;
        return view('backend.profile.ajax.payment', compact('id', 'balance'));
    }

    public function individualPayment(Request $request, $id)
    {
        // dd($id);
        $user_object = User::find($id);
        $balance = $user_object->due_balance;
        $total_balance = $user_object->total_balance;
        $last_paid = $user_object->paid_balance;

        session(['total_balance' => $total_balance]);
        session(['last_paid' => $last_paid]);
        session(['balance' => $balance]);
        return view('backend.profile.ajax.individual_payment', compact('id', 'balance','user_object'));
    }



    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create(Request $request)
    // {
    //     $designations = Designation::pluck('name');
    //     return view('backend.profile.ajax.create_admin_member', compact('designations'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate(
    //        [
    //         'name' => 'required',
    //         'designation' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'status' => 'required',
    //        ]
    //     );

    //     $attribute['name'] = $request->name;
    //     $attribute['email'] = $request->email;
    //     $attribute['designation'] = $request->designation;
    //     ($request->designation == 'Member') ? $attribute['role'] = 0  : $attribute['role'] = 1 ;
    //     $attribute['password'] = bcrypt(12345678);
    //     $attribute['status'] = $request->status;
    //     if (isset($request->img)) {
    //         $attribute['image'] = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/members/');

    //         $member = User::create($attribute);
    //         if (!isset($member) or empty($member)) {
    //             File::delete('frontend/assets/img/members/' . $tmpImagePath);
    //         }
    //     }else{
    //         $member = User::create($attribute);
    //     }

    //     return response()->json(['success' => 'Member added successfully']);
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $member = User::find($id);
    //     $member->is_read = 1;
    //     $member->save();
    //     return view('backend.member_management.ajax.view_admin_member', compact('member'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $member = User::find($id);
    //     $designations = Designation::pluck('name');
    //     return view('backend.member_management.ajax.edit_admin_member', compact('member','designations'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request)
    // {
    //     // dd($request->all());
    //     $userId = $request->member_id;
    //     $request->validate([
    //          'name' => 'required',
    //          'email' => 'required|email|unique:users,email,' . $userId,
    //          'designation' => 'required',
    //          'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //          'status' => 'required',
    //         ]);
    //         $member = User::find($request->member_id);
    //         $member->name = $request->name;
    //         $member->email = $request->email;
    //         $member->designation = $request->designation;
    //         $member->status = $request->status;

    //         if (!empty($member->img)) {
    //             File::delete('frontend/assets/img/members/' . $member->image);
    //         }
    //         if (isset($request->img)) {
    //             $member->image = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/members/');
    //             $member = $member->update();
    //         }else{
    //             $member = $member->update();
    //         }

    //         return response()->json(['success' => 'Member updated successfully']);
    //    dd($request->all());
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     // dd($id);
    //     $data = User::find($id);

    //     if (!empty($data->image)) {
    //         File::delete('frontend/assets/img/members/' . $data->image);
    //     }

    //     $data->delete();
    //    return response()->json(['success' => 'Member deleted successfully']);
    // }
}
