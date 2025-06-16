<select name="paymentType" id="paymentType" class="form-control">
    <option value="" >Select Type</option>
    <option value="full" data-info="full">Full Amount</option>
    <option value="custom" data-info="partial">Partial Amount</option>
</select>

<input type="hidden" id="userId" name="userId" value="{{$id}}">
<input type="hidden" id="fullPaymentPrice" name="fullPaymentPrice" value="{{$balance}}">

