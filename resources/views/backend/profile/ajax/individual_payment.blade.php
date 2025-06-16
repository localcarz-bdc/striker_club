<div class="modal-header">
    <h4 class="modal-title">{{$user_object->name.'\'s'}} Payment</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row d-flex justify-content-between">
        <div></div>
        <div>Membership2 &nbsp; - ${{  session('total_balance') }}</div>
        <div>Last Paid &nbsp; - ${{  session('last_paid')}}</div>
        <div>Balance &nbsp; - ${{  session('balance') }}</div>
        <div></div>
    </div>
    <h6 class="modal-title"> </h6>

</div>


<select name="paymentType" id="paymentType" class="form-control">
    <option value="" >Select Type</option>
    <option value="full" data-info="full">Full Amount</option>
    <option value="custom" data-info="partial">Partial Amount</option>
</select>

<input type="hidden" id="userId" name="userId" value="{{$id}}">
<input type="hidden" id="fullPaymentPrice" name="fullPaymentPrice" value="{{$balance}}">

