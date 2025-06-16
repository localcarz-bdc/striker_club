@extends('member.layout.app')

@push('css')
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #070707;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #070707;
            border-right: 0.1mm solid #070707;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #070707;
        }

        .items td.blanktotal {
            background-color: #070707;
            border: 0.1mm solid #0f0f0f;
            background-color: #070707;
            border: 0mm none #070707;
            border-top: 0.1mm solid #070707;
            border-right: 0.1mm solid #070707;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #070707;
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card"  style="background:white">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                                    <tr>
                                        <td width="100%"></td>
                                        <td width="100%" style="padding: 0px 40px;">
                                            <h1 style="font-weight: bold; color:#070707"> INVOICE</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px; color:#070707">
                                            <img src="{{ asset('frontend') }}/assets/img/logo/logo_01_smaller.png" alt="logo.png"
                                                height="auto" width="100">
                                        </td>
                                        <td width="100%" style="font-size: 14px; padding: 40px; color:#070707">

                                            <p>Strikers Club</p>
                                            <p>1100 Springhill Ave. <br /> Mobile, AL 36603</p>


                                            {{-- <p>Phone: (251) 281-8666</p> --}}
                                            <a href="https://strikersclubinc.org/">Strikers Club</a>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table width="100%" style="font-family: sans-serif; " cellpadding="10">
                                    <tr>
                                        <td width="50%" style=" font-size: 14px;  padding: 40px;color:#070707">
                                            <p style="font-weight: bold; opacity:50% color:#070707">BILL TO</p>
                                            @if (!empty($userInfo))
                                                @foreach ($userInfo as $user)
                                                @php
                                                    $data = App\Models\User::find($user->user_id);
                                                @endphp
                                                    <p>Contact Name - {{ $data->name ?? '' }}</p>
                                                    <p>{{ $data->phone ?? '' }}</p>
                                                    <p>{{ $data->email ?? '' }}</p>
                                                    <input type="hidden" value="<?php echo isset($user->user->id) ? $data->id : ''; ?>" id="user_id">

                                                    <br />
                                                @endforeach
                                            @endif

                                        </td>
                                        <td width="50%" style="font-size: 14px;  padding: 40px; float:right; color:#070707 ">
                                            <p> <span style="font-weight: bold; color:#070707">Invoice No:</span> DP - 00021</p>
                                            @php
                                                $dateTime = new DateTime(now());
                                                // Format the date as "j F Y" (day, month, year)
                                                $formattedDate = $dateTime->format('F j, Y');

                                            @endphp
                                            <p> <span style="font-weight: bold; color:#070707">Invoice Date:</span> {{ $formattedDate }}
                                            </p>
                                            <p id="top-total" > <span style="font-weight:bold ; color:#070707">Amount Due: </span>${{auth()->user()->due_balance}}</p>

                                        </td>
                                    </tr>

                                </table>
                                @if (!empty($invoiceData))
                                    <table class="items table table-bordered" width="100%" style="font-size: 14px;color:#070707"
                                        cellpadding="8">
                                        <thead>
                                            <tr style="background-color: #028299;color:white;font-weight:bold; ">

                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Date</strong>
                                                </td>
                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Description</strong>
                                                </td>
                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Qty</strong>
                                                </td>
                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Amount</strong>
                                                </td>

                                                <td width="20%" style="text-align: left;" align="center">
                                                    <strong>Total</strong>
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
                                                        $invoice_obj = App\Models\TmpInvoice::where('user_id', auth()->user()->id);
                                                        $invoice_data = $invoice_obj->get();
                                                        $tmp_invoices = $invoice_obj->sum('price');
                                                        $balance_amount = $data->due_balance -$tmp_invoices;
                                                        ($balance_amount < 0) ? $amount = '($'.abs($balance_amount).' )' : $amount = '$'.$balance_amount;

                                                        $pay_amount = auth()->user()->due_balance;
                                                    @endphp

                                                @endforeach

                                                @foreach ($invoice_data as $invoice)
                                                @php
                                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $invoice->created_at);
                                                    $formattedDate = $date->format('d M Y');
                                                    $pay_amount -=  $invoice->price;
                                                    ($pay_amount < 0 ) ? $exc_amount = '('.abs($pay_amount).')' : $exc_amount = $pay_amount;
                                                @endphp

                                                <tr>
                                                    <td style="padding:12px 7px; line-height: 20px;color:#070707">
                                                            {{$formattedDate}}
                                                    </td>
                                                    <td style="padding:3px 7px; line-height: 20px;color:#070707">
                                                        {{-- <p class="mt-2">
                                                            {{ count($invoiceData['inventory_ids']) }}</p> --}}
                                                            <p>Membership Fee</p>
                                                    </td>
                                                    <td style="padding: 3px 7px; line-height: 20px;color:#070707">
                                                        <p class="mt-2"> 1</p>
                                                    </td>
                                                    </td>
                                                    <td style="padding: 3px 7px; line-height: 20px;color:#070707">
                                                        <p class="mt-2">
                                                            ${{ $invoice->price }}</p>
                                                    </td>

                                                    <td style="padding: 3px 7px; line-height: 20px;color:#070707">
                                                        <input style="background:none; border:none ;color:#070707" type="text"
                                                            value=" {{ $exc_amount }}" disabled class="amount-input mt-2">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <table width="100%" style="font-family: sans-serif; font-size: 14px; margin-top:-12px; color:#070707">
                                        <tr>
                                            <td>
                                                <table width="65%" align="left"
                                                    style="font-family: sans-serif; font-size: 14px;color:#070707">
                                                    <tr>
                                                        <td style="padding: 0px; line-height: 20px; color:#070707">&nbsp;</td>
                                                    </tr>
                                                </table>
                                                <table width="25%" align="right"
                                                    style="font-family: sans-serif; font-size: 14px;color:#070707">
                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; line-height: 20px; height:40px;color:#070707">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;color:#070707"
                                                            class="">Subtotal: </p>
                                                        </td>
                                                        <td
                                                            style="border: 1px #eee solid; line-height: 20px;color:#070707">
                                                            <input style="width:100%; height:40px ; color:#070707" type="text" id="subtotal" class="subtotal"
                                                                value="${{ $tmp_invoices }}" disabled />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        {{-- <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;color:#070707">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;color:#070707"
                                                            class="">Discount: </p>

                                                        </td> --}}
                                                        {{-- <td
                                                            style="border: 1px #eee solid; line-height: 20px;color:#070707">
                                                            <div class="input-group">
                                                                <input  type="text" name="discount" class="form-control"
                                                                    id="discount">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </td> --}}
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;color:#070707">
                                                            <p style="margin-top:10px; margin-left:7px;  font-size:16px; font-weight:bold;color:#070707"
                                                            class="">Total: </p>


                                                        </td>
                                                        <td
                                                            style="border: 1px #eee solid;  line-height: 20px;color:#070707">
                                                            <input style="width:100%; height:40px" type="text" id="total" value="{{ '$'.$data->due_balance }}" disabled>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;color:#070707">

                                                            <p style="margin-top:10px; margin-left:7px;  font-size:15px; font-weight:bold;color:#070707"
                                                            class="">Amount Due: </p>
                                                        </td>
                                                            <td
                                                            style="border: 1px #eee solid;  line-height: 20px;color:#070707">
                                                            <input style="width:100%; height:40px;color:#070707" type="text"  id="another-total" value="{{$amount}}" disabled>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <input type="radio" value="cash" name="pay_type" class="payment_type" checked> &nbsp;Cash &nbsp; &nbsp;
                                                            <input type="radio" value="check" name="pay_type" class="payment_type"> &nbsp;Check &nbsp; &nbsp;
                                                            <input type="radio" value="card" name="pay_type" class="payment_type"> &nbsp;Card &nbsp; &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                @endif
                                <div style="height: 55px; width: 25%; background-color: #ddd;
                                float: right; margin:0 auto;margin-top:20px;border-radius:10px;color:#070707">
                                    <ul style="list-style: none; padding: 0; margin: 15px 0 0 2%;">
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('backend/card/visa.jpg') }}" alt="Visa"
                                            width="25px" height="15px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('backend/card/mastercard.png') }}"
                                                alt="Mastercard"  width="25px" height="15px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('backend/card/discover.png') }}" alt="Discover"
                                            width="25px" height="15px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('backend/card/bank-transfer.png') }}"
                                                alt="Bank Transfer"  width="25px" height="15px">
                                        </li>
                                        <li style="display: inline-block; margin-left: 10px;">
                                            <img src="{{ asset('backend/card/american.png') }}"
                                                alt="American Express"  width="25px" height="15px">
                                        </li>
                                    </ul>
                                </div>
                                <br />
                            </div>
                        </div>
                            <div class="card-header">

                                <a  class="btn btn-lg btn-success float-right"  id="create_invoice">
                                    <i class="fa fa-file-invoice-dollar me-3"></i> Next to proceed
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



        // $(document).ready(function() {
        //     // Function to update subtotal and total
        //     function updateTotals() {
        //         var total = 0;

        //         // Calculate total from each amount input
        //         $('.amount-input').each(function() {
        //             var amount = parseFloat($(this).val().replace('$', '')) || 0;
        //             total += amount;
        //         });

        //         var discount = parseFloat($('#discount').val()) || 0;

        //         var subtotal = total - (total * discount / 100);
        //         var due = subtotal.toFixed(2);

        //         // Update the fields with the calculated values
        //         $('#total').val('$' + total.toFixed(2));
        //         $('#subtotal').val('$' + subtotal.toFixed(2));
        //         $('#another-total').val('$' + due);
        //         $('#top-total').text('Amount Due (USD): $' + due);
        //     }

        //     // Watch for changes in the amount input
        //     $('.amount-input').on('input', function() {
        //         updateTotals();
        //     });

        //     // Watch for changes in the discount input
        //     $('#discount').on('input', function() {
        //         updateTotals();
        //     });

        //     // Initial update when the page loads
        //     updateTotals();
        // });

        // click new invoice create button
        $(document).on('click','#create_invoice',function(e){
            e.preventDefault();
            var pay_type = $('input[name="pay_type"]:checked').val();
            if(pay_type == 'card'){
                // alert('card aishe ')
                window.location.href = "{{ route('member.card.payment') }}";
            }else{
                // NewInvoice();
                // alert('ok');
                var user_id = $('#user_id').val();
            // var discount = $('#discount').val();
            var total = $('#total').val();
            var subtotal = $('#subtotal').val();

            $.ajax({
                url: "{{ route('member.invoice.new.store') }}", // Replace with your server endpoint
                method: 'POST',
                dataType: 'json',
                data: {
                    invoiceData: @json($invoiceData),
                    user_id: user_id,
                    // discount: discount,
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
        });

        // function NewInvoice() {
        //     alert('ok');
        //     var user_id = $('#user_id').val();
        //     // var discount = $('#discount').val();
        //     var total = $('#total').val();
        //     var subtotal = $('#subtotal').val();

        //     $.ajax({
        //         url: "{{ route('member.invoice.new.store') }}", // Replace with your server endpoint
        //         method: 'POST',
        //         dataType: 'json',
        //         data: {
        //             invoiceData: @json($invoiceData),
        //             user_id: user_id,
        //             // discount: discount,
        //             total: total,
        //             subtotal: subtotal,
        //         },
        //         success: function(response) {
        //             // Handle the response from the server
        //             if (response.status == 'success') {

        //                 toastr.success("Invoice create successfully");
        //                 window.location.href = "{{ route('member.invoice.list') }}";
        //             }
        //         },
        //     });
        // }
    </script>
@endpush
