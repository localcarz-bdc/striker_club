<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter name">
<label for="">Email</label>
<input type="text" class="form-control" name="email" placeholder="Enter email">

<label for="">Designation</label>
<select name="designation" id="" class="form-control">
    <option value="" selected disabled>--Select Designation--</option>
    @foreach ($designations as $designation)
        <option value="{{ $designation}}" >{{ $designation}}</option>
    @endforeach
</select>
<label for="">Due</label>
<input type="number" class="form-control" name="total_balance" id="total" placeholder="Enter Due">
<label for="">Paid</label>
<input type="number" class="form-control" name="paid_balance" id="paid" placeholder="Enter Paid">
<label for="">Balance</label>
<input type="number" class="form-control" name="due_balance" id="due" placeholder="See balance" disabled>
<label for="">Designation</label>
{{-- <input type="text" class="form-control" name="designation" placeholder="enter designation"> --}}

<!-- <select name="" id="" class="form-control" name="status" placeholder="status">
    <option value="" selected disabled>Select Status</option>
    <label for="">Status</label>
    <option value="1">Active</option>
    <option value="0">Inactive</option>

</select> -->
<label for="">Image</label>
<input type="file" class="form-control" name="img">

<label for="status" class="mt-2">Status :</label>
Active &nbsp;<input type="radio" name="status" checked value="1">
Inactive &nbsp;<input type="radio" name="status" value="0">
