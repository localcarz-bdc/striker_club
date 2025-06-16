
<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $member->name }}">
<label for="">Email</label>
<input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ $member->email }}">
<label for="">Designation</label>
<select name="designation" id="" class="form-control">
    @foreach ($designations as $designation)
        <option value="{{ $designation}}" @selected($designation == $member->designation)>{{ $designation}}</option>
    @endforeach
</select>
{{-- <input type="text" class="form-control" name="designation" placeholder="enter designation" value="{{ $member->designation }}"> --}}

<input type="hidden" name="member_id" id="member_id" value="{{ $member->id }}">

<label for="">Image</label>
<input type="file" class="form-control" name="img">

@php
    $filePath = public_path("frontend/assets/img/members/{$member->image}");

    if (file_exists($filePath)) {
        ($member->image === null) ? $data = '400x600.png ' : $data = $member->image ;
        $url = asset("frontend/assets/img/members/{$data}");
    } else {
        $url = asset("frontend/assets/img/members/400x600.png");
    }

    ($member->status == 1)? $info = 'Active' : $info ='Inactive' ;
@endphp

<img src='{{ $url }}' alt="" style="width:50%">

<label for="status" class="mt-2">Status :</label>
Active &nbsp;<input type="radio" name="status" checked value="1" {{ ($member->status == 1) ? 'checked' : '' }}>
Inactive &nbsp;<input type="radio" name="status" value="0" {{ ($member->status == 0) ? 'checked' : '' }}>
