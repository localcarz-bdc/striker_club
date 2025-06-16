<?php

namespace App\Http\Controllers\member;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;

class MemberProfileController extends Controller
{
    public function __construct(protected CommonServiceInterface $commonService, protected FileUploaderServiceInterface $fileUploader){}

    public function index(Request $request)
    {
        // dd(Auth::user()->id);
        // $leads = $this->leadService->all();
        $data = User::where('id',Auth::user()->id);

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

                    ->editColumn('designation', function ($row) {
                        $designations = Designation::where('status', 1)->get();
                        $html = '<select name="" id="approveDesignation" class="form-control is_approve" data-isApproveId="' . $row->id . '">';

                        foreach ($designations as $designation) {
                            $html .= '<option value="' . $designation->name . '" ' . ($row->designation == $designation->name ? 'selected' : '') . 'disabled>' . $designation->name . '</option>';
                        }
                        $html .= '<option value="null" ' . ($row->designation == null ? 'selected' : '') . ' disabled>Member</option>';

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
                            ($row->image === null) ? $data = '400x600.png ' : $data = $row->image ;
                            $url = asset("frontend/assets/img/members/{$data}");
                        } else {
                            $url = asset("frontend/assets/img/members/400x600.png");
                        }

                        // $filePath = public_path("frontend/assets/img/members/{$row->image}");

                        // (file_exists($filePath)) ? $url = asset("frontend/assets/img/members/{$row->image}") : $url = asset("frontend/assets/img/members/400x600.png") ;

                        return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" loading="lazy"/>';
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('member.profile.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        // '&nbsp;<a href="'.route('member.profile.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a> &nbsp;'.
                        '<a href="'. route('member.profile.create').'" class="btn btn-sm btn-warning" id="createMember" title="Reset Password"><i class="fa fa-key"></i></a> &nbsp;'.
                        '<a href="'. route('member.profile.payment',$row->id).'" class="btn btn-sm btn-primary" id="makepayment" title="Payment"><i class="fa fa-cubes"></i></a>';
                        // '&nbsp;<a href="'.route('member.profile.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })
                    ->rawColumns(['action','check','img','designation'])
                    ->make(true);
        }
        return view('member.profile.admin_member');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('member.profile.ajax.reset_password');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
           ]
        );

        $attribute['name'] = $request->name;
        $attribute['designation'] = $request->designation;
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

        return response()->json(['success' => 'Profile added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd('asjdjalkdjlaks');
        $member = User::find($id);
        $member->is_read = 1;
        $member->save();
        return view('member.profile.ajax.view_admin_member', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = User::find($id);
        return view('member.profile.ajax.edit_admin_member', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
             'name' => 'required',
             'email' => 'required|email|unique:users,email,' . $request->member_id,
             'balance' => 'required',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'status' => 'required',
            ]);
            $member = User::find($request->member_id);
            $member->name = $request->name;
            $member->email = $request->email;
            $member->balance = $request->balance;
            $member->status = $request->status;
            if (!empty($member->img)) {
                File::delete('frontend/assets/img/members/' . $member->img);
            }
            if (isset($request->img)) {
                $member->img = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/members/');
                $member = $member->update();
            }else{
                $member = $member->update();
            }

            return response()->json(['success' => 'Profile updated successfully']);
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
       return response()->json(['success' => 'Profile deleted successfully']);
    }

    // public function reset()
    // {
    //     return view('backend.profile.ajax.profile_reset');
    // }

    public function resetStore(Request $request)
    {
        $request->validate([
            'previous_password' => 'required',
            'password' => 'required|min:8|confirmed', // 'confirmed' will look for a matching 'password_confirmation' field
        ]);

        // Ensure that the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the entered password matches the hashed password in the database
            if (Hash::check($request->previous_password, $user->password)) {
                // Password is correct, proceed with updating the password
                $user->password = bcrypt($request->password);
                $user->save();

                return response()->json(['success' => 'Password reset successfully']);
            } else {
                // Password is not correct
                return response()->json(['success' => 'Previous password is incorrect']);
            }
        } else {
            // User is not authenticated
            return response()->json(['success' => 'User is not authenticated']);
        }
    }


    public function payment(Request $request, $id)
    {
        $balance = User::find($id)->due_balance;
        return view('member.profile.ajax.payment', compact('id', 'balance'));
    }
}
