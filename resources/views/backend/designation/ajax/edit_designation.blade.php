<label for="">Designation Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $designation->name }}">
<input type="hidden" name="designation_id" id="designation_id" value="{{ $designation->id }}">
<label for="status" class="mt-2">Status :</label>
Active &nbsp;<input type="radio" name="status" checked value="1" {{ ($designation->status == 1) ? 'checked' : '' }}>
Inactive &nbsp;<input type="radio" name="status" value="0" {{ ($designation->status == 0) ? 'checked' : '' }}>
