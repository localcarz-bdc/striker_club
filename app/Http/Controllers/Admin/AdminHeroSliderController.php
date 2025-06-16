<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Gallery;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;

class AdminHeroSliderController extends Controller
{
    public function __construct(protected CommonServiceInterface $commonService, protected FileUploaderServiceInterface $fileUploader){}

    public function index(Request $request)
    {
        $data = HeroSlider::orderByDesc('id')->get();
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

                    ->addColumn('img', function ($row) {

                        $filePath = public_path("frontend/assets/img/hero/{$row->image}");

                        if (file_exists($filePath)) {
                            ($row->image === null) ? $data = 'h1_hero1.jpg' : $data = $row->image ;
                            $url = asset("frontend/assets/img/hero/{$data}");
                        } else {
                            $url = asset("frontend/assets/img/hero/h1_hero1.jpg");
                        }

                        return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" loading="lazy"/>';
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.hero_slider.show',$row->id).'" class="btn btn-sm btn-success" id="view" title="View"><i class="fa fa-eye"></i></a> &nbsp;'.
                        '&nbsp;<a href="'.route('admin.hero_slider.edit', $row->id).'" class="btn btn-sm btn-primary " title="Edit" id="edit" data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                        &nbsp;<a href="'.route('admin.hero_slider.delete', $row->id).'" class="btn btn-sm btn-danger deleteLead" id="delete" title="Delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','img'])
                    ->make(true);
        }
        return view('backend.heroSlider.heroSlider_list');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.heroSlider.ajax.create_hero_slider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
           [
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
           ]
        );

        $attribute['title'] = $request->title;
        $attribute['details'] = $request->sub_title;
        if (isset($request->image)) {
            $attribute['image'] = $tmpImagePath = $this->fileUploader->upload($request->image, 'frontend/assets/img/hero/');

            $gallery = HeroSlider::create($attribute);
            if (!isset($gallery) or empty($gallery)) {
                File::delete('frontend/assets/img/hero/' . $tmpImagePath);
            }
        }else{
            $gallery = HeroSlider::create($attribute);
        }

        return response()->json(['success' => 'Hero slider img added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heroSlider = HeroSlider::find($id);
        $heroSlider->is_read = 1;
        $heroSlider->save();
        return view('backend.heroSlider.ajax.view_hero_slider', compact('heroSlider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $heroSlider = Heroslider::find($id);
        return view('backend.heroSlider.ajax.edit_hero_slider', compact('heroSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
             'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
             'status' => 'required',
            ]);
            $gallery = Heroslider::find($request->gallery_id);
            $gallery->title = $request->title;
            $gallery->details = $request->sub_title;
            $gallery->status = $request->status;

            if (!empty($gallery->image)) {
                File::delete('frontend/assets/img/hero/' . $gallery->image);
            }
            if (isset($request->img)) {
                $gallery->image = $tmpImagePath = $this->fileUploader->upload($request->img, 'frontend/assets/img/hero/');
                $gallery = $gallery->update();

            }else{
                $gallery = $gallery->update();
            }

            return response()->json(['success' => 'Hero slider updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = Heroslider::find($id);
       if (!empty($data->image)) {
        File::delete('frontend/assets/img/hero/' . $data->image);
    }

       $data->delete();

       return response()->json(['success' => 'Hero slider deleted successfully']);
    }
}
