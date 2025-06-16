@extends('backend.layout.app')

@section('content')
    <!-- Payment Failure Section -->
    <section class="sptb">
        <div style="margin-top:155px" class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div style="margin-top:105px">
                        <!-- Header and Image Side by Side with Reduced Gap -->
                        <div style="display: flex; align-items: center; justify-content: flex-start;">
                            <div>
                                <h2 style="font-weight:600;" class="mb-2">Oops!</h2>
                                <h2 style="font-weight:600; color: #d9534f;">Payment Failed</h2>
                            </div>
                            <div style="margin-left: 15px;">
                                <img class="pe-2" width="25%" src="{{ asset('/frontend/assets/img/fail.png') }}" alt="Payment Failed"/>
                            </div>
                        </div>
                        
                        <!-- Message Content -->
                        <p style="width:85%;" class="mt-5">
                            Unfortunately, your payment could not be processed at this time. This could be due to insufficient funds, an expired card, or other technical issues. Please try again later, or contact your bank or card issuer for more details.
                        </p>
                        <p style="width:85%;">
                            If you continue to experience problems, feel free to reach out to our support team, or try using a different payment method.
                        </p>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <a href="{{ route('admin.ownInvoice.list') }}" class="btn btn-primary me-3" style="background-color:#087880; border:none;">Back to Invoice</a>
                            <a href="{{ route('admin.dashboard') }}" style="text-decoration: underline; color:rgb(8, 120, 128);">Go back to dashboard</a>
                        </div>
                    </div>
                </div>

                <!-- Right Side Content (Optional Additional Info) -->
                <div class="col-xl-5 col-lg-5 col-md-12 mb-5">
                    <div style="background: black; box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; border-radius:15px;" class="p-4">
                        <h4 style="font-weight:600; color:white;" class="mt-3">Why did payment fail?</h4>
                        <ul style="color: #fff; margin-top: 20px;">
                            <li>Insufficient funds</li>
                            <li>Expired or invalid card</li>
                            <li>Technical error with the payment provider</li>
                            <li>Bank restrictions</li>
                        </ul>
                    </div>

                    <div style="background: black; box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; border-radius:15px;" class="p-4 mt-5">
                        <h4 style="font-weight:600; color:white;" class="mt-3">Need Help?</h4><br>
                        <p style="color: #fff;">Contact us via <a href="mailto:stewartleonard06@gmail.com" style="color:rgb(8, 120, 128);">email</a><br>E-mail : stewartleonard06@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
