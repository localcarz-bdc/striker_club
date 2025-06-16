<p>Name : {{ $member->name}}</p>
<p>Email : {{ $member->email}}</p>
<p>Membership : $ {{ $member->total_balance ?? 0}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Last Paid : $ {{ $member->paid_balance ?? 0}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Balance : $ {{ $member->due_balance ?? 0}}</p>
<p>Designation : {{ $member->designation}}</p>
@php
    $filePath = public_path("frontend/assets/img/members/{$member->image}");

    if (file_exists($filePath)) {
        ($member->image === null) ? $data = '400x600.png ' : $data = $member->image ;
        $img = asset("frontend/assets/img/members/{$data}");
    } else {
        $img = asset("frontend/assets/img/members/400x600.png");
    }

    ($member->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp
<p>status : {{ $info }}</p>
<img src='{{ $img }}' alt="" style="width:50%">

