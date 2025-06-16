<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $leads = $this->leadService->all();
        $data = Contact::orderByDesc('id');
        // dd($data);
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

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.contact.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        ' &nbsp;<a href="'.route('admin.contact.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                        //  &nbsp;<a href="#" class="btn btn-sm btn-warning permanentDeleteLead" title="delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check'])
                    ->make(true);
        }
        return view('backend.contact.admin_contact');

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
        $contact = Contact::find($id);
        $contact->is_read = 1;
        $contact->save();
        return view('backend.contact.ajax.view_contact', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
       $data = Contact::find($id);
       $data->delete();

       return response()->json(['success' => 'Contact msg deleted successfully']);
    }

    public function isAdminRead(Request $request)
    {
        if($request->action =='contact'){
            $notifications = Notification::get();
            foreach($notifications as $notification){
                $notification->admin_is_read = 1;
                $notification->save();

            }
            return response()->json(['msg' => 'contact']);
        }
    }
}
