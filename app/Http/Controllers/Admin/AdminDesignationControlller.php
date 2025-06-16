<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AdminDesignationControlller extends Controller
{
    public function index(Request $request)
    {
        $data = Designation::orderByDesc('id');
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
                    ->editColumn('status', function ($row) {
                        return ($row->status == 1)? 'Active' : 'Inactive' ; // Use any unique identifier for your rows
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.designation.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        '&nbsp;<a href="'.route('admin.designation.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                        &nbsp;<a href="'.route('admin.designation.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check'])
                    ->make(true);
        }
        return view('backend.designation.designation_list');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.designation.ajax.create_designation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
           [
            'name' => 'required',
            'status' => 'required',
           ]
        );

        $attribute['name'] = $request->name;
        $attribute['status'] = $request->status;
        Designation::create($attribute);
        return response()->json(['success' => 'Designation added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $designation = Designation::find($id);
        $designation->is_read = 1;
        $designation->save();
        return view('backend.designation.ajax.view_designation', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $designation = Designation::find($id);
        return view('backend.designation.ajax.edit_designation', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
             'name' => 'required',
            ]);
            $member = Designation::find($request->designation_id);
            $member->name = $request->name;
            $member->status = $request->status;
            $member = $member->update();


            return response()->json(['success' => 'Designation updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Designation::find($id);
        $data->delete();
       return response()->json(['success' => 'Designation deleted successfully']);
    }

    public function roleApprove(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->roleid);
        $user->role = $request->role;
        $user->save();
        return response()->json(['success' => 'Member role updated successfully']);
    }
}
