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
        text-align: "."center;
    }

    /* #contentToConvert {
        background-image: url('{{ asset('frontend/assets/images/inv2.png') }}');
        background-size: cover;
        width:100%;
        height:100%;
    } */


</style>

</head>

<body>
    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                    <tr width="100%">
                        {{-- <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                            <img src="{{ asset('frontend') }}/assets/images/car77.png" alt="logo.png" height="auto"
                        width="100">
                        </td> --}}
                        <td  width="50%" style="font-size: 14px; padding: 40px; margin-top:-45px">

                            <p >StrikersClub.com</p>
                            <p>1100 Springhill Ave.<br/> Mobile, AL 36603</p>

                            {{-- <p>Phone: (251) 281-8666</p> --}}
                           <a href="https://strikersclubinc.org/">strikersclub.com</a>

                        </td>
                        <td  width="50%" style="font-size: 14px; padding: 40px; ">

                            <h1 style="margin-top:-7px">INVOICE</h1>
                            {{-- <p style="margin-top:-17px">Invoice no: 01245</p> --}}

                        </td>
                    </tr>
                </table>
                <hr>
                <table width="100%" style="font-family: sans-serif; " cellpadding="10" >
                    <tr>
                        <td width="100%" style=" font-size: 14px;  padding: 40px;">
                            <p style="font-weight: bold; opacity:50%">BILL TO</p>
                            <p>{{ auth()->user()->name}}</p>
                            <p>{{ auth()->user()->email}}</p><br/>



                        </td>
                        <td  width="100%" style="font-size: 14px;  padding: 40px; ">
                          <p> <span style="font-weight: bold">Invoice No:</span> {{$dataToCompact->invoice_id}}</p>
                        @php
                        $dateTime = new DateTime(now());
                        // Format the date as "j F Y" (day, month, year)
                        $formattedDate = $dateTime->format('F j, Y');

                        @endphp
                         <p> <span style="font-weight: bold">Invoice Date:</span> {{ $formattedDate }}</p>
                         {{-- <p> <span style="font-weight: bold">Amount Due (USD):</span> {{ $products->total}}</p> --}}

                        </td>
                    </tr>
                </table>

                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                    cellpadding="8">
                    <thead >
                        <tr style="background-color: #036a7c;color:white;font-weight:bold">
                            <td width="20%" style="text-align: left;"  ><strong>Detail</strong></td>
                            <td width="40%" style="text-align: left;"  ><strong>Due</strong></td>
                            <td width="40%" style="text-align: left;" ><strong>Pay</strong></td>
                            <td width="40%" style="text-align: left;" ><strong>Balance</strong></td>
                        </tr>
                    </thead>
                    <tbody>


                     <!-- ITEMS HERE -->

                     <tr>
                        {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                        <td style="padding:3px 7px; line-height: 20px;" >Membership Fee
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;">
                            ${{  $dataToCompact->total}}
                        </td>
                        <td style="padding:3px 7px; line-height: 20px;">
                            {{  $dataToCompact->subtotal}}
                        </td>
                        @php
                            $balance_amount = intval($dataToCompact->total) - intVal(str_replace('$','',$dataToCompact->subtotal));
                            ($balance_amount <  0) ? $amount_info = '()'.abs($balance_amount).')' : $amount_info = '$'.$balance_amount;

                            $dataToCompact->total
                        @endphp
                        <td style="padding:3px 7px; line-height: 20px;">
                            {{  $amount_info }}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" style="font-family: sans-serif; font-size: 14px; margin-left:5px; margin-top:-25px">
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
                                        <strong>Subtotal: </strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$dataToCompact->subtotal}}</td>
                                </tr>
                                {{-- <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Discount :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{($dataToCompact->discount)? $products->discount .'%' : ''}}</td>
                                </tr> --}}
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Total :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$dataToCompact->total}}</td>
                                </tr>

                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Amount Due:</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$amount_info}}</td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
