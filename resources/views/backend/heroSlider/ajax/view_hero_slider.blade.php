<h3>Title : {{ $heroSlider->title}}</h3>
<h3>Subtitle : {!! $heroSlider->details !!}</h3>
@php
    $filePath = public_path("frontend/assets/img/hero/{$heroSlider->image}");

    if (file_exists($filePath)) {
        ($heroSlider->image === null) ? $data = '400x600.png ' : $data = $heroSlider->image ;
        $img = asset("frontend/assets/img/hero/{$data}");
    } else {
        $img = asset("frontend/assets/img/hero/400x600.png");
    }

    ($heroSlider->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp
<p>status : {{ $info }}</p>
<img src='{{ $img }}' alt="" style="width:50%">

