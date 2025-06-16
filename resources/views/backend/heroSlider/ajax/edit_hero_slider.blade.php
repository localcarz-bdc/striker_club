
<label for="">Title</label>
<input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $heroSlider->title }}">

<input type="hidden" name="gallery_id" id="gallery_id" value="{{ $heroSlider->id }}">
<label for="">Sub Title</label>
<textarea name="sub_title" id="summernote" cols="30" rows="6" placeholder="Enter sub-title" class="form-control">{!! $heroSlider->details!!} </textarea>

<!-- <select name="" id="" class="form-control" name="status" placeholder="status">
    <option value="" selected disabled>Select Status</option>
    <label for="">Status</label>
    <option value="1">Active</option>
    <option value="0">Inactive</option>

</select> -->
<label for="">Image</label>
<input type="file" class="form-control" name="image">

@php
    $filePath = public_path("frontend/assets/img/hero/{$heroSlider->image}");

    if (file_exists($filePath)) {
        ($heroSlider->image === null) ? $data = '400x600.png ' : $data = $heroSlider->image ;
        $url = asset("frontend/assets/img/hero/{$data}");
    } else {
        $url = asset("frontend/assets/img/hero/400x600.png");
    }

    ($heroSlider->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp

<img src='{{ $url }}' alt="" style="width:50%">

<label for="status" class="mt-2">Status :</label>
Active &nbsp;<input type="radio" name="status" checked value="1" {{ ($heroSlider->status == 1) ? 'checked' : '' }}>
Inactive &nbsp;<input type="radio" name="status" value="0" {{ ($heroSlider->status == 0) ? 'checked' : '' }}>
