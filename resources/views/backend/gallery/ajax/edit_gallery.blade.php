
<label for="">Title</label>
<input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $gallery->title }}">

<input type="hidden" name="gallery_id" id="gallery_id" value="{{ $gallery->id }}">

<!-- <select name="" id="" class="form-control" name="status" placeholder="status">
    <option value="" selected disabled>Select Status</option>
    <label for="">Status</label>
    <option value="1">Active</option>
    <option value="0">Inactive</option>

</select> -->
<label for="">Image</label>
<input type="file" class="form-control" name="img">

@php
    $filePath = public_path("frontend/assets/img/gallery/{$gallery->image}");

    if (file_exists($filePath)) {
        ($gallery->image === null) ? $data = '400x600.png ' : $data = $gallery->image ;
        $url = asset("frontend/assets/img/gallery/{$data}");
    } else {
        $url = asset("frontend/assets/img/gallery/400x600.png");
    }

    ($gallery->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp

<img src='{{ $url }}' alt="" style="width:50%">

<label for="status" class="mt-2">Status :</label>
Active &nbsp;<input type="radio" name="status" checked value="1" {{ ($gallery->status == 1) ? 'checked' : '' }}>
Inactive &nbsp;<input type="radio" name="status" value="0" {{ ($gallery->status == 0) ? 'checked' : '' }}>
