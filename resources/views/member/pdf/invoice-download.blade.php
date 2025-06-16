<html>

<head>
    <style>
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

</head>

<body>
    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                {{-- <div style="float-right"><button class="btn btn-primary" >Download</button></div> --}}

                <table width="100%" style="font-family: sans-serif;" cellpadding="10" class="p-0">
                    <tr width="100%">

                        <td width="50%" style="font-size: 14px;  margin-top:-45px">

                            <p>Strikers Club Inc.</p>
                            <p>1100 Springhill Ave.<br/> Mobile, AL 36604</p>


                            {{--<p>{{'Phone :' ?? 'Phone: (251) 281-8666'  }}</p>--}}
                            <a href="https://www.strikersclubinc.org" target="_blank">https://www.strikersclubinc.org</a>

                        </td>
                        <td width="50%" style="font-size: 14px; float:right ">

                            <h1 style="margin-top:-7px; float:right">INVOICE</h1>
                            <p style="margin-top:-17px; float:right; padding-top:45px; margin-left:7px;">Invoice Id: <br>
                                {{$dataToCompact->payment_id}}</p>
                        </td>
                    </tr>


                </table>


                <hr style="height: 1px; background: rgb(179, 179, 179);margin-top:35px; border: none; width:97%">
                <table width="100%" style="font-family: sans-serif; margin-top:40px " cellpadding="10">
                    <tr class="m-0 p-0">
                        <td width="100%" style=" font-size: 14px;">
                            <p style="font-weight: bold; opacity:50%; color: #036a7c;">Received From</p>
                            <p>{{ auth()->user()->name}}</p>
                            <p>{{ auth()->user()->email}}</p><br/>
                            {{--<p>{{$user_info->dealer_address}}</p>
                            <p>{{$user_info->dealer_number}}</p> --}}
                            <br />
                        </td>
                        <td width="100%" style="font-size: 14px;">

                            @php
                                $dateTime = new DateTime(now());
                                // Format the date as "j F Y" (day, month, year)
                                // $formattedDate = $dateTime->format('F j, Y');
                                $formattedDate = $dateTime->format('m-d-Y');

                            @endphp
                            <p style="float:right"> <span style="font-weight: bold">Invoice Date:</span>
                                {{ $formattedDate }}</p>


                        </td>
                    </tr>

                </table>
                <table class="items table table-bordered" width="100%" style="font-size: 14px;" cellpadding="8">
                    <thead>
                        <tr style="background-color: #036a7c;color:white;font-weight:bold">
                            <td width="20%" style="text-align: left;"><strong>Date</strong></td>
                            <td width="40%" style="text-align: left;"><strong>Description</strong></td>

                            <td width="20%" style="text-align: left;"><strong>Quantity</strong></td>
                            <td width="20%" style="text-align: left;"><strong>Cost</strong></td>
                            <td width="20%" style="text-align: left;"><strong>Amount</strong></td>

                        </tr>
                    </thead>
                    <tbody>


                        <!-- ITEMS HERE -->

                        <tr>

                            <td style="padding:3px 7px; line-height: 20px;">{{date('m-d-y')}}
                            </td>
                            <td style="padding:3px 7px; line-height: 20px;">{{$dataToCompact->pay_status }}
                            </td>
                            <td style="padding:3px 7px; line-height: 20px;">1
                            </td>
                            <td style="padding:3px 7px; line-height: 20px;" class="text-right">
                                {{ '$'.$dataToCompact->amount }}

                            </td>
                            <td style="padding:3px 7px; line-height: 20px;">
                                {{ '$'.$dataToCompact->amount }}


                            </td>
                        </tr>
                    </tbody>
                </table>

                <table width="100%"
                    style="font-family: sans-serif; font-size: 14px; margin-left:5px; margin-top:-25px">
                    <tr>
                        <td>
                            <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="30%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Subtotal: </strong>
                                    </td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        {{ '$'.$dataToCompact->amount }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Discount :</strong>
                                    </td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        {{ $dataToCompact->discount ? $dataToCompact->discount . '%' : '0' }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Tax :</strong>
                                    </td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        {{ $dataToCompact->discount ? $dataToCompact->discount . '%' : '0' }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Shipping Cost :</strong>
                                    </td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        {{ $dataToCompact->discount ? $dataToCompact->discount . '%' : '0' }}</td>
                                </tr>
                                <hr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Grand Total :</strong>
                                    </td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        {{ '$'.$dataToCompact->amount }}</td>
                                </tr>

                                {{--<tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Due:</strong>
                                    </td>
                                    @php
                                        $total = intVal(str_replace('$','',$dataToCompact->total));
                                        $subtotal = intVal(str_replace('$','',$dataToCompact->subtotal));
                                        $result = $total - $subtotal;
                                        ($result < 0)?  $total_amount = 0:  $total_amount = $result;
                                    @endphp

                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                            ${{$total_amount}}
                                        </td>

                                </tr>--}}
                            </table>
                        </td>
                    </tr>
                </table>


                {{--<div
                    style="height: 110px;
                width: 30%;
                background-color: #ddd;
                float: right; margin:0 auto;margin-top:20px;border-radius:10px;">

                    <button
                        style="border: none;
                background-color: black;
                color: white;
                margin-top: 19px;
                margin-bottom:17px;
                margin-left: 15%;
                padding: 10px;
                border-radius: 10px;font-weight:bold;margin-bottom:15px">Pay
                        Securely Online</button><br />
                    <img src="{{ asset('backend/card/visa.jpg') }}" alt="" width="30px"
                        style="margin-left:20px ">
                    <img src="{{ asset('backend/card/mastercard.png') }}" alt="" width="30px"
                        style="margin-left:2px ">
                    <img src="{{ asset('backend/card/discover.png') }}" alt="" width="30px"
                        style="margin-left:2px ">
                    <img src="{{ asset('backend/card/bank-transfer.png') }}" alt="" width="30px"
                        style="margin-left:2px ">
                    <img src="{{ asset('backend/card/american.png') }}" alt="" width="30px"
                        style="margin-left:2px ">

                </div>--}}
                {{--<div style="display: block;margin-top:200px;margin-bottom:50px;">
                    <p style="font-weight: bold; font-size:17px; margin-bottom:3px;">Notes / Terms</p>
                    <p style="font-size:14px"> Make check payable or cash to 'Strikers Club' or you can <br />
                        electronically send the payment. ACH info</p>
                    <p style="font-size:14px"> Account name- Striker Club</p>
                    <p style="font-size:14px"> Account name- Striker Club ORG.</p>
                    <p style="font-size:14px"> Bank Name- Wells Fargo, N.A.</p>
                    <p style="font-size:14px"> Account number- 12345678</p>
                    <p style="font-size:14px"> Routing number- 062000080</p>
                    <p style="position:absolute; bottom:0; left:35px;">PS: Please remind that the credit card payment option.
                        (Charges 3.5% credit card processing/transaction fee).</p>
                </div>
                <div style="float: right;  margin-top:-160px;border-radius:10px;">
                    <img src="{{ asset('backend/signature/ss.webp') }}" alt="" height="90px"
                        width="150px" style="margin-right:20px;">


                </div>--}}



            </div>

        </div>
    </div>
</body>

</html>
