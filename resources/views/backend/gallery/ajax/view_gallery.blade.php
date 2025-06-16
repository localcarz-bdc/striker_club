<h3>Title : {{ $gallery->title}}</h3>
@php
    $filePath = public_path("frontend/assets/img/gallery/{$gallery->image}");

    if (file_exists($filePath)) {
        ($gallery->image === null) ? $data = '400x600.png ' : $data = $gallery->image ;
        $img = asset("frontend/assets/img/gallery/{$data}");
    } else {
        $img = asset("frontend/assets/img/gallery/400x600.png");
    }

    ($gallery->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp
<p>status : {{ $info }}</p>
<img src='{{ $img }}' alt="" style="width:50%">

