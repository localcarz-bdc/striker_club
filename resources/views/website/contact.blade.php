@extends('website.layout.master')
@section('title','Contact')
@section('content')

<main>

    <div class="slider-area">
        <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="hero-caption hero-caption2">
                            <h2>Contact</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="contact-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div id="map" style="height: 480px; position: relative; overflow: hidden;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.948779826441!2d-88.06292842561385!3d30.691717187615794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x889a4e2f5311d189%3A0xa52eff8b0f71a695!2sStrikers%20Club%20Inc.!5e0!3m2!1sen!2sbd!4v1703959840474!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('name') is-invalid @enderror valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                    <span class="invalid-feedback" id="nameError" style="color:red"></span>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="reCaptcha" id="reCapcha">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                    <span class="invalid-feedback" id="emailError" style="color:red"></span>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                    <span class="invalid-feedback" id="subjectError" style="color:red"></span>
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                                    <span class="invalid-feedback" id="messageError" style="color:red"></span>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="g-recaptcha" name="" data-sitekey="{{ config('captcha.sitekey') }}"></div>
                        <span class="invalid-feedback" id="reCaptchaError" style="color:red"></span>
                        <div style="display:none">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}</div>

                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn " id="submitBtn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                        <h3>1100 Springhill Ave.</h3>
                        <p>Mobile, AL 36603</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                        <h3>Contact Available</h3>
                        <p>Any time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            // var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var reCaptcha = grecaptcha.getResponse();
            $('#reCapcha').val(reCaptcha)
            console.log("reCaptcha:", reCaptcha);
            // (name === '') ?  $('#nameError').text('Please enter your name') : $('#nameError').text('');
            // (subject === '') ?  $('#subjectError').text('Please enter your subject') : $('#subjectError').text('');
            // (message === '') ?  $('#messageError').text('Please enter your message') : $('#messageError').text('');
            // (email === '') ?  $('#emailError').text('Please enter your email') : (!emailRegex.test(email)) ?  $('#emailError').text('Please enter a valid email address') : $('#emailError').text('');;
            // (reCaptcha === '') ?  $('#reCaptchaError').text('Please check reCapcha') : $('#reCaptchaError').text('');

            // // Check if the reCAPTCHA is solved
            // if (reCaptcha.length !== 0) {
            //     alert(reCaptcha);
            //     return;
            // }

            // if(name !== '' || email !== '' || subject !== '' || message !== ''){
            var formData = $('#contactForm').serialize();
            $(this).addClass('btn-loading');
            $.ajax({
                type: 'post',
                url: "{{ route('contact.store') }}",
                data: formData,
                success: function(response) {
                    toastr.success(response.success);
                    $('#contactForm')[0].reset();
                    grecaptcha.reset();
                    // $('#nameError').text('')
                    // $('#emailError').text('')
                    // $('#subjectError').text('')
                    // $('#messageError').text('')
                    // $('#reCaptchaError').text('')
                    $('#submitBtn').removeClass('btn-loading');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors occurred
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        for (var key in errors) {
                            errorMessage += errors[key][0] + '<br>';
                        }
                        // $('#nameError').text(errors.name[0])
                        // $('#emailError').text(errors.email[0])
                        // $('#subjectError').text(errors.subject[0])
                        // $('#messageError').text(errors.message[0])
                        // $('#reCaptchaError').text(errors.reCaptcha[0])
                        toastr.error(errorMessage);
                        $('#uploadButton').removeClass('btn-loading');
                    } else {
                        toastr.error('An error occurred while processing the request.');
                        console.log(xhr);
                        $('#submitBtn').removeClass('btn-loading');
                    }
                }
            });
            // }
        });
    })
</script>
@endsection
