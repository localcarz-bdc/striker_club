{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Strikers Club | Forgate Password</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            /* display: flex; */
            align-items: center;
            /* justify-content: center; */
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h2>The Strikers Club</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            {{-- there had sign up form --}}
        </div>
        <div class="form-container sign-in-container" id="myModal">

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <form method="POST" action="{{ route('web.password.request') }}">
                @csrf

                <h1>Reset Password</h1>
                {{-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span> --}}
                <input type="email" class="form-control @error('email') is-invalid myModalInput @enderror"
                    id="email_code_send" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus placeholder="Enter your email" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Are you remember? Please Sign In') }}
                    </a>
                @endif

                <button id="sendCode">Send Reset Link</button>
            </form>
        </div>

        {{-- OTP Password --}}
        <div class="form-container sign-in-container" id="anotherDiv" style="display:none">


            <form method="POST" action="{{ route('web.password.request') }}">
                @csrf

                <h3>Enter OTP & Confirmed Password</h3>
                <h5 id="email-otp" class="otp_error text-success">Enter OTP </h5>
                {{-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> --}}
                {{-- <span>or use your account</span> --}}
                {{-- <input type="email" class="form-control @error('email') is-invalid myModalInput @enderror" id="email_code_send"
                name="otp" value="{{ old('email') }}" required autocomplete="email" autofocus
                placeholder="Enter your OTP" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
                {{-- <label class="label-item" style="left:0">OTP Code</label> --}}
                <input class=" form-control" type="text" placeholder="Enter Code" id="otp_code" name="otp" />
                <br>
                <span class="text-success" id="email-otp_pass" class="otp_error"></span><br><br>

                {{-- <label class="label-item" style="left:0">New Password</label> --}}
                <input class=" form-control" type="password" placeholder="New Password" id="new_password"
                    name="password" /> <br>
                <span class="text-danger" id="pwd_error"></span><br>

                {{-- <label class="label-item" style="left:0">Confirm Password</label> --}}
                <input class=" form-control" type="password" placeholder="Confirm Password" name="confirm_password"
                    id="confirm_password" /><br>
                <span class="text-danger" id="confirm_pwd_error"></span><br>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Are you remember? Please Sign In') }}
                    </a>
                @endif

                <button id="NewPassword">Submit</button>
            </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome, Friend!</h1>
                    <p>Enter your email and back with us</p>
                    <a href="{{ route('login') }}"><button class="ghost" id="signUp">Sign In</button></a>
                    {{-- <button class="ghost" id="signUp">Sign Up</button> --}}
                </div>
            </div>
        </div>
    </div>

</body>

{{-- <footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://florin-pop.com">Florin Pop</a>
		- Read how I created this and how you can join the challenge
		<a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
	</p>
</footer> --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    $(document).ready(function() {
        $('#sendCode').on('click', function(e) {
            e.preventDefault()


            var email = $('#email_code_send').val();
            $.ajax({
                url: "{{ route('web.password.request') }}",
                method: "post",
                data: {
                    email: email
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log(result);
                    if (result.error) {
                        if (result.error.email) {
                            $('#email-error').text(result.error.email[0]);
                        } else {
                            $('#email-error').text(result.error);
                        }
                    }
                    if (result.success) {
                        // $('#myModal').modal('hide');
                        // $('#OtpModal').modal('show');
                        $('#email-otp').text(result.success);

                        // Hide myModal and show anotherDiv
                        $('#myModal').hide();
                        // $('.myModalInput').hide();
                        $('#anotherDiv').show();
                    }

                }
            });

        });


        $('#NewPassword').on('click', function(e) {
            e.preventDefault()
            var otp = $('#otp_code').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();
            console.log(otp,new_password,confirm_password);
            $.ajax({
                url: "{{ route('web.otp.check') }}",
                method: "post",
                data: {
                    otp: otp,
                    password: new_password,
                    confirm_password: confirm_password
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log(result);
                    if (result.otp) {
                        $('#email-otp').text("");
                        $('#email-otp').text(result.otp).addClass('text-danger');
                    }
                    if (result.password) {
                        $('#pwd_error').text(result.password);
                    }
                    if (result.confirm_password) {
                        $('#confirm_pwd_error').text(result.confirm_password);
                    }
                    if (result.error) {
                        $('#email-otp').text("");
                        $('#email-otp').text(result.error).addClass('text-danger');
                    }
                    if (result.message) {
                        window.location.href = "{{ route('login') }}";
                        $('#forgot_success').text(result.message);
                    }

                }
            });


        });

    })
    // signUpButton.addEventListener('click', () => {
    // 	container.classList.add("right-panel-active");
    // });

    // signInButton.addEventListener('click', () => {
    // 	container.classList.remove("right-panel-active");
    // });
</script>

</html>
