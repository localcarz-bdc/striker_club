<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;

class AdminGalleryController extends Controller
{
    public function __construct(protected CommonServiceInterface $commonService, protected FileUploaderServiceInterface $fileUploader){}

    public function index(Request $request)
    {
        // $leads = $this->leadService->all();
        $data = Gallery::orderByDesc('id');
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
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })
                    ->editColumn('status', function ($row) {
                        return ($row->status == 1)? 'Active' : 'Inactive' ; // Use any unique identifier for your rows
                    })
                    ->addColumn('create', function ($row) {
                        $timestamp = $row->created_at;
                        $date = Carbon::parse($timestamp);

                        // Format the date as required
                        // $formattedDate = $date->format('d M Y'); // 29 Jan 2024
                        $formattedDate = $date->format('m-d-Y'); // 29 Jan 2024
                        $formattedTime = $date->format('H:i');   // 18:09
                        return  $formattedDate . ' ' . $formattedTime;
                    })

                    ->addColumn('img', function ($row) {

                        $filePath = public_path("frontend/assets/img/gallery/{$row->image}");

                        if (file_exists($filePath)) {
                            ($row->image === null) ? $data = '400x600.png ' : $data = $row->image ;
                            $url = asset("frontend/assets/img/gallery/{$data}");
                        } else {
                            $url = asset("frontend/assets/img/gallery/400x600.png");
                        }

                        return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" loading="lazy"/>';
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.gallery.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        '&nbsp;<a href="'.route('admin.gallery.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                        &nbsp;<a href="'.route('admin.gallery.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','img'])
                    ->make(true);
        }
        return view('backend.gallery.gallery_list');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.gallery.ajax.create_admin_member');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
           [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
           ]
        );

        $attribute['title'] = $request->title;
        $attribute['status'] = $request->status;
        if (isset($request->img)) {
            $attribute['image'] = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/gallery/');

            $gallery = Gallery::create($attribute);
            if (!isset($gallery) or empty($gallery)) {
                File::delete('frontend/assets/img/gallery/' . $tmpImagePath);
            }
        }else{
            $gallery = Gallery::create($attribute);
        }

        return response()->json(['success' => 'Gallery added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::find($id);
        $gallery->is_read = 1;
        $gallery->save();
        return view('backend.gallery.ajax.view_gallery', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        return view('backend.gallery.ajax.edit_gallery', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
             'title' => 'required',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'status' => 'required',
            ]);
            $gallery = Gallery::find($request->gallery_id);
            $gallery->title = $request->title;
            $gallery->status = $request->status;
            if (isset($request->img)) {
                $gallery->image = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/gallery/');

                $gallery = $gallery->update();
                if (!isset($gallery) or empty($gallery)) {
                    File::delete('frontend/assets/img/gallery/' . $tmpImagePath);
                }
            }else{
                $gallery = $gallery->update();
            }

            return response()->json(['success' => 'Gallery updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = Gallery::find($id);
       if (!empty($data->image)) {
        File::delete('frontend/assets/img/gallery/' . $data->image);
    }

       $data->delete();

       return response()->json(['success' => 'Gallery deleted successfully']);
    }
}
