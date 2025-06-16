@extends('member.layout.app')

@push('css')
    <style>
        a {
            text-decoration: none;
        }

        ul {
            list-style-type: none;
        }

        body {
            font-family: "Averia Serif Libre", cursive;
            background-color: rgb(19, 18, 21);

        }

        .radio-section {


            float: right;
            padding: 0 !important;



        }

        .radio-item [type="radio"] {
            display: none;
        }

        .radio-item+.radio-item {
            margin-top: 15px;
        }

        .radio-item label {
            display: block;
            padding: 10px 60px;
            background: #dce9e8;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 300;
            min-width: 250px;
            white-space: nowrap;
            position: relative;
            transition: 0.8s ease-in-out 0s;
        }

        .radio-item label:after,
        .radio-item label:before {
            content: "";
            position: absolute;
            border-radius: 50%;
        }

        .radio-item label:after {
            height: 19px;
            width: 19px;
            border: 1px solid #027e8f;
            left: 19px;
            top: calc(50% - 10px);
        }

        .radio-item label:before {
            background: #027e8f;
            height: 20px;
            width: 20px;
            left: 18px;
            top: calc(50%-5px);
            transform: scale(5);
            opacity: 0;
            visibility: hidden;
            transition: 0.4s ease-in-out 0s;
        }

        .radio-item [type="radio"]:checked~label::before {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        /* radio button css close */
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #e7e7e7;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.cost {
            text-align: "." center;
        }
    </style>
@endpush
@php
    $invoiceData = Session::get('invoice_data');
@endphp
@section('content')
<div class="content-wrapper">
    <div class="page-content-tab">

        <div class="container-fluid" id="contentToConvert">
            <div class="row p-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="font-family: sans-serif; background-color:#dce9e8; padding:25px">


                            <table width="100%" style="font-family: sans-serif;" cellpadding="10" class="p-0">
                                <tr width="100%">

                                    <td width="50%" style="font-size: 14px;  margin-top:-45px">

                                        <p style="color:rgb(53, 49, 49); font-size:16px">Dreambestcar.com</p>
                                        <p style="color:rgb(53, 49, 49); font-size:16px">8080 Howells Ferry Rd.
                                            <br />Semmes, AL 36575</p>


                                        <p style="color:rgb(53, 49, 49); font-size:16px">Phone: (251) 281-8666</p>
                                        <a style="color:rgb(10, 58, 218); font-size:16px"
                                            href="https://phplaravel-1194462-4226380.cloudwaysapps.com/">dreambest.com</a>

                                    </td>
                                    <td width="50%" style="font-size: 14px; float:right ">

                                        <h1 style="margin-top:-7px; float:right; font-weight:600">INVOICE</h1>
                                        {{-- <p style="margin-top:-17px; float:right; padding-top:60px; margin-left:25px;">Invoice no:
                                            01245</p> --}}

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-body p-5">
                            <div class="col-md-12">
                                <table width="100%" style="font-family: sans-serif; margin-top:40px " cellpadding="10">
                                    <tr class="m-0 p-0 ">
                                        <td width="100%" style=" font-size: 14px;">
                                            <p style="font-weight: bold; opacity:50%; color: #036a7c;">BILL TO</p>
                                            <p>{{ $userInfo->dealer_name ?? 'Dealer Name' }}</p>
                                            <p>{{ $userInfo->dealer_address ?? 'Dealer Address' }}</p>
                                            <p>{{ $userInfo->dealer_number ?? 'Dealer Number'}}</p><br />
                                            <input type="hidden" value="{{ $userInfo->user_id ?? 22 }}" name="user_id"
                                                id="user_id">
                                        </td>
                                        <td width="100%" style="font-size: 14px;">

                                            @php
                                                $dateTime = new DateTime(now());
                                                // Format the date as "j F Y" (day, month, year)
                                                $formattedDate = $dateTime->format('F j, Y');

                                            @endphp
                                            <p style="float:right; margin-left:-110px"> <span
                                                    style="font-weight: bold">Invoice Date:</span>
                                                {{ $formattedDate }}</p>


                                        </td>
                                    </tr>

                                </table>
                                @if (!empty($invoiceData))
                                    <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                                        cellpadding="8">
                                        <thead>
                                            <tr style="background-color: #028299;color:white;font-weight:bold">

                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Details</strong>
                                                </td>
                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Quantity</strong>
                                                </td>
                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Cost</strong>
                                                </td>

                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Amount</strong>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_inventory = 0;

                                            @endphp
                                            <!-- ITEMS HERE -->
                                            @if (!empty($invoiceData['inventory_ids']))
                                                @foreach ($invoiceData['inventory_ids'] as $inventoryId)
                                                    @php
                                                        $total_inventory += 20;
                                                    @endphp
                                                @endforeach
                                                <tr>

                                                    <td style="padding:12px 7px; line-height: 20px;"> Email lead
                                                    </td>
                                                    <td style="padding:3px 7px; line-height: 20px;">
                                                        <p class="mt-2">
                                                            {{ count($invoiceData['inventory_ids']) }}</p>


                                                    </td>
                                                    <td style="padding: 3px 7px; line-height: 20px;">
                                                        <p class="mt-2">
                                                            ${{ $total_inventory }}</p>
                                                    </td>
                                                    <td style="padding: 3px 7px; line-height: 20px;">
                                                        <input style="background:none; border:none" type="text"
                                                            value="${{ $total_inventory }}" disabled
                                                            class="amount-input mt-2">
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>

                                    <table width="100%"
                                        style="font-family: sans-serif; font-size: 14px; margin-top:-12px">
                                        <tr>
                                            <td>
                                                <table width="65%" align="left"
                                                    style="font-family: sans-serif; font-size: 14px;">
                                                    <tr>
                                                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <table width="25%" align="right"
                                                    style="font-family: sans-serif; font-size: 14px;">
                                                    <tr>
                                                        <td style="border: 1px #eee solid; line-height: 20px; height:40px;">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;"
                                                                class="">Subtotal: </p>
                                                        </td>
                                                        <td style="border: 1px #eee solid; line-height: 20px;">
                                                            <input style="width:100%; height:40px" type="text"
                                                                id="subtotal" class="subtotal"
                                                                value="${{ $total_inventory }}" disabled />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;"
                                                                class="">Discount: </p>

                                                        </td>
                                                        <td style="border: 1px #eee solid; line-height: 20px;">
                                                            <div class="input-group">
                                                                <input type="text" name="discount" class="form-control"
                                                                    id="discount">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;"
                                                                class="">Total: </p>


                                                        </td>
                                                        <td style="border: 1px #eee solid;  line-height: 20px;">
                                                            <input style="width:100%; height:40px" type="text"
                                                                id="total" disabled>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">

                                                            <p style="margin-top:10px; margin-left:7px;  font-size:15px; font-weight:bold;"
                                                                class="">Amount Due: </p>


                                                        </td>


                                                        <td style="border: 1px #eee solid;  line-height: 20px;">
                                                            <input style="width:100%; height:40px" type="text"
                                                                id="another-total" disabled>

                                                        </td>





                                                    </tr>



                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                @endif


                                {{-- <section>
                                    <div
                                    style="height: 155px;
                                width: 25%;
                                background-color: #ddd;
                                float: right; margin-left:250px !important;margin-top:245px;border-radius:10px">


                                    <button
                                        style="border: none; background-color: black;color: white;
                                        margin-top: 25px;
                                        margin-bottom:17px;
                                        margin-left: 6%;
                                        padding-left: 100px;
                                        padding-right: 100px;
                                        padding-top:10px;
                                        padding-bottom:10px;
                                        border-radius: 10px;
                                        font-weight:bold;
                                        margin-bottom:15px;
                                        ">Pay
                                        Securely Online</button><br />



                                    <ul style="list-style: none; padding: 0; margin: 15px 0 0 2%;">
                                        <li style="display: inline-block; margin-left: 26px;">
                                            <img src="{{ asset('dashboard/images/card/visa.jpg') }}" alt="Visa"
                                                width="50px" height="35px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('dashboard/images/card/mastercard.png') }}"
                                                alt="Mastercard" width="50px" height="35px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('dashboard/images/card/discover.png') }}" alt="Discover"
                                                width="50px" height="35px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('dashboard/images/card/bank-transfer.png') }}"
                                                alt="Bank Transfer" width="50px" height="35px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('dashboard/images/card/american.png') }}"
                                                alt="American Express" width="50px" height="35px">
                                        </li>
                                    </ul>


                                </div>
                                </section> --}}

                                <section style=" width: 25%; float:rigth" class="radio-section">
                                    <div class="radio-list">
                                        <p style="margin-top:18px; margin-bottom:15px; font-size:18px">What payment method
                                            do you prefer to use?</p>
                                        <div class="radio-item">

                                            <input value="card" name="radio" id="radio1" type="radio">
                                            <label for="radio1">Card</label>
                                        </div>
                                        <div class="radio-item"><input name="radio" id="radio2"
                                                type="radio"><label for="radio2">Cash</label></div>
                                        <div class="radio-item"><input name="radio" id="radio3"
                                                type="radio"><label for="radio3">Check</label></div>
                                    </div>

                                </section>



                                <div style="display: block;margin-top:200px;margin-bottom:50px;">
                                    <p style="font-weight: bold; font-size:17px; margin-bottom:3px;">Notes / Terms</p>
                                    <p style="font-size:14px"> Make check payable to 'Dream Best Car' or you can <br />
                                        electronically send the payment. ACH info</p>
                                    <p style="font-size:14px"> Account name- Dream Best Car</p>
                                    <p style="font-size:14px"> Account name- Anryd Enterprises LLC.</p>
                                    <p style="font-size:14px"> Bank Name- Wells Fargo, N.A.</p>
                                    <p style="font-size:14px"> Account number- 12345678</p>
                                    <p style="font-size:14px"> Routing number- 062000080</p>

                                </div>






                            </div>

                        </div>
                        <div class="card-footer">

                            <a href="#" class="btn btn-primary float-right " onclick="NewInvoice()">
                                <i class="fa fa-file-invoice-dollar me-3"></i> Create Invoice
                            </a>




                        </div>
                    </div>
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
            // Function to update subtotal and total
            function updateTotals() {
                var total = 0;

                // Calculate total from each amount input
                $('.amount-input').each(function() {
                    var amount = parseFloat($(this).val().replace('$', '')) || 0;
                    total += amount;
                });

                var discount = parseFloat($('#discount').val()) || 0;

                var subtotal = total - (total * discount / 100);
                var due = subtotal.toFixed(2);

                // Update the fields with the calculated values
                $('#total').val('$' + subtotal.toFixed(2));
                $('#subtotal').val('$' + subtotal.toFixed(2));
                $('#another-total').val('$' + due);
                $('#top-total').text('Amount Due (USD): $' + due);
            }

            // Watch for changes in the amount input
            $('.amount-input').on('input', function() {
                updateTotals();
            });

            // Watch for changes in the discount input
            $('#discount').on('input', function() {
                updateTotals();
            });

            // Initial update when the page loads
            updateTotals();



        });



        $(document).ready(function() {
            $('#radio1').change(function() {
                if ($(this).is(':checked')) {


                    $data = $(this).val();
                    if ($data == 'card') {

                        alert('card')

                    }


                }
            });
        });
        // click new invoice create button

        function NewInvoice() {
            var user_id = $('#user_id').val();
            var discount = $('#discount').val();
            var total = $('#total').val();
            var subtotal = $('#subtotal').val();

            $.ajax({
                url: "{{ route('member.invoice.new.store') }}", // Replace with your server endpoint
                method: 'POST',
                dataType: 'json',
                data: {
                    invoiceData: @json($invoiceData),
                    user_id: user_id,
                    discount: discount,
                    total: total,
                    subtotal: subtotal,
                },
                success: function(response) {
                    // Handle the response from the server
                    if (response.status == 'success') {

                        toastr.success("Invoice create successfully");
                        window.location.href = "{{ route('member.invoice.list') }}";
                    }
                },
            });
        }
    </script>
@endpush
