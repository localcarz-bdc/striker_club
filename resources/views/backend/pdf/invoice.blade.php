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
</style>

</head>

<body>
    <div class="container-fluid" id="contentToConvert">
        <div class="row">
            <div class="col-md-12">
                <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                    <tr >
                        <td width="100%"></td>
                        <td width="100%" style="padding: 0px 40px;">
                            <h1 style="font-weight: bold"> INVOICE</h1>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" style=" font-size: 20px; font-weight: bold; padding: 40px;">
                            <img src="{{ asset('dashboard') }}/assets/images/localcarz.png" alt="logo.png" height="auto"
                        width="100">
                        </td>
                        <td  width="100%" style="font-size: 14px; padding: 40px; ">

                            <p>LocalCarz.com</p>
                            <p>8080 Howells Ferry Rd. <br/>Semmes, AL 36575</p><br/>


                            <p>Phone: (251) 281-8666</p>
                           <a href="https://localcarz.com/">localcarz.com</a>

                        </td>
                    </tr>
                </table>
                <hr>
                <table width="100%" style="font-family: sans-serif; " cellpadding="10" >
                    <tr>
                        <td width="100%" style=" font-size: 14px;  padding: 40px;">
                            <p style="font-weight: bold; opacity:50%">BILL TO</p>
                            <p>{{ $username }}</p>
                            <p>Contact Name - {{ $username }}</p><br/>
                            <p>+1 {{ $phone }}</p>
                            <p>{{ $email }}</p>


                        </td>
                        <td  width="100%" style="font-size: 14px;  padding: 40px; ">
                          <p> <span style="font-weight: bold">Invoice Id:</span> 00001</p>
                        @php
                        $dateTime = new DateTime(now());
                        // Format the date as "j F Y" (day, month, year)
                        $formattedDate = $dateTime->format('F j, Y');

                        @endphp
                         <p> <span style="font-weight: bold">Invoice Date:</span> {{ $formattedDate }}</p>
                         {{-- <p> <span style="font-weight: bold">Former Membership:</span> {{ $membership_type_old }}</p>
                         <p> <span style="font-weight: bold">Current Membership:</span> {{ $membership_type }}</p> --}}
                         {{-- <p> <span style="font-weight: bold">Amount Due (USD):</span> {{ $products->total}}</p> --}}
                    </tr>

                </table>
                <table class="items table table-bordered" width="100%" style="font-size: 14px;"
                    cellpadding="8">
                    <thead >
                        <tr style="background-color: #EB172C;color:white;font-weight:bold">
                            <td width="15%" style="text-align: left;"><strong>S.N</strong></td>
                            <td width="25%" style="text-align: center;"><strong>Details</strong></td>
                            <td width="20%" style="text-align: center;"><strong>Cost</strong></td>
                            <td width="20%" style="text-align: center;"><strong>Amount</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td style="padding:3px 7px; line-height: 20px;">{{$invoice->inventory->stock}}</td> --}}
                            <td style="padding:3px 7px; line-height: 20px; padding-top:10px"> 01
                            </td>
                            <td style="padding:3px 7px; line-height: 20px; padding:0; margin:0"  align="center">
                              {{ $membership_type }} Membership
                              <br>
                              <p style="font-size:9px; margin-top:-5px; color:darkcyan">Previous membership - ({{ $membership_type_old }}) </p>

                            </td>
                            <td style="" align="center"> <p> ${{$membership_price}}</p></td>
                            <td style="padding: 3px 7px; line-height: 20px;" align="center"> <input type="text" value="${{$membership_price}}" disabled class="amount-input"></td>
                        </tr>




                    </tbody>
                </table>
                <br>
                <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                    <tr>
                        <td>
                            <table width="40%" align="left" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="50%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Sub total : </strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"> ${{$membership_price}}</td>
                                </tr>
                                <tr>

                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">
                                        <strong>Current balance : </strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"> ${{$membership_price_old}}</td>
                                </tr>

                                <?php
                                $subTotal = $membership_price - $membership_price_old;
                                if ($subTotal < 0) {
                                    $amountDue = 0;
                                    $creditAvailable = abs($subTotal);
                                } else {
                                    $amountDue = $subTotal;
                                    $creditAvailable = 0;
                                }
                                ?>
                                 <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Amount Due :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"> $<?php echo $amountDue; ?></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Credit Available :</strong></td>
                                    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"> $<?php echo $creditAvailable; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="height: 110px;
                width: 30%;
                background-color: #ddd;
                float: right; margin:0 auto;margin-top:20px;border-radius:10px;">

                {{-- <button style="border: none;
                background-color: black;
                color: white;
                margin-top: 19px;
                margin-left: 10%;
                padding: 10px;
                border-radius: 10px;font-weight:bold;margin-bottom:15px">Pay Securely Online</button><br/> --}}
                <img src="{{asset('dashboard/images/visa.jpg')}}" alt="" width="30px" style="margin-left:32px; margin-top: 49px;">
                <img src="{{asset('dashboard/images/mastercard.png')}}" alt="" width="30px"  style=" margin-top: 49px; " >
                <img src="{{asset('dashboard/images/discover.png')}}" alt="" width="30px"  style=" margin-top: 49px; ">
                <img src="{{asset('dashboard/images/bank-transfer.png')}}" alt="" width="30px"  style=" margin-top: 49px; ">
                <img src="{{asset('dashboard/images/american.png')}}" alt="" width="30px"  style=" margin-top: 49px; ">

                </div>


                {{--
                   <div style="display: block;margin-top:60px;margin-bottom:50px">
                   <p style="font-weight: bold">Notes / Terms</p>
                   <p> Make check payable to 'Local Carz' or you can <br/>
                    electronically send the payment. ACH info</p>
                    <p> Account name- Local Carz</p>
                    <p> Account name- Anryd Enterprises LLC.</p>
                    <p>  Bank Name- Wells Fargo, N.A.</p>
                    <p> Account number- 12345678</p>
                    <p>  Routing number- 062000080</p>
                    <p style="margin-left:4%;font-size:12px;opacity:50%; margin-top:10px">PS: Please ignore the credit card payment option. (Charges 3.5% credit card processing/transaction fee).</p>
                </div>

                --}}


            </div>

        </div>
    </div>
</body>
</html>
