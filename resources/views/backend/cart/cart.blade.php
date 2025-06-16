@extends('backend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class=" row">
        <div class="col-md-12">
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Checkout</h2>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table m-0  invoice_table">
                            <thead  class="table-bordered">
                                <tr>
                                    <th colspan="3" class="text-center">SL</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Cost</th>
                                    <th class="text-center">Amount</th>
                                    <th></th>

                                </tr>
                            </thead>

                            <tbody style="background:#fff;color:black">

                                @php
                                    $total = 0;
                                @endphp

                            @forelse ($invoices as $key=>$item)
                            @php
                                $price = $item->price ?? 0;
                                $numeric_price = preg_replace('/[^0-9]/', '', $price);
                                $price = is_numeric($numeric_price) ? intval($numeric_price) : 0;
                                $total += $price;

                                $formattedDate = \Carbon\Carbon::parse($item->created_at)->format('d M Y');
                            @endphp
                                <tr>
                                    <td colspan="3" class="text-center">{{++$key}}</td>
                                    <td class="text-center">{{$formattedDate}}</td>
                                    <td class="text-center">Membership Fee</td>
                                    <td class="text-center"><input type="number" value="1" min="1" max="1" style="padding:0;width:50px;"></td>
                                    <td class="text-center">{{auth()->user()->total_balance}}</td>
                                    <td class="text-center">{{$price}}</td>
                                    <td>
                                        <button class="deleteCart" type="button" data-id={{ $item->id }}>
                                            <span><i class="fa fa-trash text-danger"></i></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9"><a href="{{route('admin.profile.index')}}">Back to Payment</a></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-body -->

                <!-- /.card -->

            </section>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h3 >Card Totals</h3> --}}
                        <hr>
                        <form id="paypal_form" action="{{ route('payment') }}" method="post">
                            @csrf
                        <div class="d-flex ">
                            <input type="radio" name="pay_type" value="paypal" checked>&nbsp;&nbsp; PayPal &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="pay_type" value="card" >&nbsp;&nbsp; Card &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="pay_type" value="cash">&nbsp;&nbsp; Cash &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="pay_type" value="check">&nbsp;&nbsp; Check &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6 style="font-weight:700">Subtotal :</h6>
                            <input style="border:none; background:none; text-align:end; color:white" type="text" id="subtotal"
                                value="${{ $total }}" name="subtotal">
                        </div>
                        {{-- <hr> --}}
                        <div class="d-flex justify-content-between">
                            <h6 style="font-weight:700">Discount :</h6>
                            <input style="border:none; background:none; font-weight:700; text-align:end;color:white" id="discount" type="text" value="0" name="discount">
                        </div>
                        {{-- <hr> --}}
                        <div class="d-flex justify-content-between">
                            <h6 style="font-weight:700">Tax :</h6>
                            <input style="border:none; background:none; font-weight:700; text-align:end;color:white" id="discount" type="text" value="0" name="tax">
                        </div>
                        {{-- <hr> --}}
                        <div class="d-flex justify-content-between">
                            <h6 style="font-weight:700">Shipping Cost :</h6>
                            <input style="border:none; background:none; font-weight:700; text-align:end;color:white" id="discount" type="text" value="0" name="shipping">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6 style="font-weight:700">Grand Total :</h6>
                            <input style="border:none; background:none; font-weight:700; text-align:end;color:white" type="text"
                                id="total" value="${{ $total }}" name="total">
                        </div>
                    </div>
                    <div class="justify-content-between">
                        <div class="card-header">

                            <button type="button" class="btn btn-lg btn-info float-right" id="create_invoice">
                                <i class="fa fa-file-invoice-dollar me-3"></i> Next
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.deleteCart', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('member.cart.data.delete') }}",
                    method: "post",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.message, {
                                timeOut: 1000
                            });
                        }
                        location.reload();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click','#create_invoice',function(e){
            e.preventDefault();
            var pay_type = $('input[name="pay_type"]:checked').val();
            if(pay_type == 'card'){
                window.location.href = "{{ route('admin.card.payment') }}";
            }else if(pay_type == 'paypal'){
                $('#paypal_form').submit();
            }else{
                // alert('go to invoice')
                // NewInvoice();
                // alert('ok');
                var user_id = @json(auth()->user()->id);
                var discount = $('#discount').val();
                var total = $('#total').val();
                var subtotal = $('#subtotal').val();
                // alert(discount);
                $.ajax({
                    url: "{{ route('admin.invoice.new.store') }}", // Replace with your server endpoint
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        // invoiceData:
                        // discount: discount,
                        user_id: user_id,
                        total: total,
                        subtotal: subtotal,
                        pay_type: pay_type,
                    },
                    success: function(response) {
                        // Handle the response from the server
                        if (response.status == 'success') {

                            toastr.success("Invoice create successfully");
                            window.location.href = "{{ route('admin.invoice.list') }}";
                        }
                    },
                });
            }
        });
    </script>
@endpush
{{--
@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {

                var table = $('.invoice_table').DataTable({

                    dom: "lBfrtip",
                    buttons: ["copy", "csv", "excel", "pdf", "print"],

                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    searchable: true,
                    "ajax": {
                        "url": "{{ route('member.invoice.list') }}",
                        "datatype": "json",
                        "dataSrc": "data",
                        "data": function(data) {

                        }
                    },

                    drawCallback: function(settings) {

                        $('#is_check_all').prop('checked', false);

                    },

                    columns: [{
                            name: 'DT_RowIndex',
                            data: 'DT_RowIndex',
                            sWidth: '3%'
                        },

                        {
                            data: 'invoice_id',
                            name: 'invoice_id',
                            sWidth: '10%'
                        },
                        {
                            data: 'type',
                            name: 'type',

                        },
                        {
                            data: 'total',
                            name: 'total',

                        },
                        {
                            data: 'Payment method',
                            name: 'Payment method',

                        },
                        {
                            data: 'Payment date',
                            name: 'Payment date',

                        },


                        {
                            data: 'action',
                            name: 'action',
                            sWidth: "15%",
                            orderable: false,
                            searchable: false
                        },

                    ],
                    lengthMenu: [
                        [10, 25, 50, 100, 500, 1000, -1],
                        [10, 25, 50, 100, 500, 1000, "All"]
                    ],
                });
                table.buttons().container().appendTo('#exportButtonsContainer');

                $(document.body).on('click', '#is_check_all', function(event) {
                    alert('Checkbox clicked!');
                    var checked = event.target.checked;
                    if (true == checked) {
                        $('.check1').prop('checked', true);
                    }
                    if (false == checked) {
                        $('.check1').prop('checked', false);
                    }
                });

                $('#is_check_all').parent().addClass('text-center');

                $(document.body).on('click', '.check1', function(event) {

                    var allItem = $('.check1');

                    var array = $.map(allItem, function(el, index) {
                        return [el]
                    })

                    var allChecked = array.every(isSameAnswer);

                    function isSameAnswer(el, index, arr) {
                        if (index === 0) {
                            return true;
                        } else {
                            return (el.checked === arr[index - 1].checked);
                        }
                    }

                    if (allChecked && array[0].checked) {
                        $('#is_check_all').prop('checked', true);
                    } else {
                        $('#is_check_all').prop('checked', false);
                    }
                });

                //Submit filter form by select input changing
                $(document).on('change', '.submitable', function() {

                    table.ajax.reload();

                });


            });

        });
    </script>
@endpush --}}
