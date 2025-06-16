@extends('website.layout.master')
@section('title','Debutante Application')
@section('content')
<main>

    <div class="slider-area">
        <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="hero-caption hero-caption2">
                            <h2>Debutante Application</h2>
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
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8 card">
                    <form class="form-contact contact_form"
                        action="" method="post"
                        id="submitForm" novalidate="novalidate">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fname">First Name*</label>
                                    <input class="form-control valid" name="fname" id="fname"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your first name'"
                                        placeholder="Enter your first name">
                                    <span class="invalid-feedback" id="fnameError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="lname">Last Name*</label>
                                    <input class="form-control valid" name="lname" id="lname"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your last name'"
                                        placeholder="Enter your last name">
                                    <span class="invalid-feedback" id="lnameError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex " >
                                <div class="form-group col-md-6" >
                                    <label for="dob">Date of Birth* </label>
                                    <input class="form-control valid" name="dob" id="dob"
                                        type="date" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your brthe date Formate(MM/DD/YYYY)'"
                                        placeholder="Enter your birth date" style="width:90% !important">
                                    <span class="invalid-feedback" id="dobError" style="color:red"></span>
                                </div>
                                <div class="form-group col-md-6" style="margin-right: 10%">
                                    <label for="age">Age*</label>
                                    <input class="form-control valid" name="age" type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'See your age'"
                                        placeholder="See your age" disabled id="calculateAge">
                                    <span class="invalid-feedback" id="ageError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Address*</label>
                                    <input class="form-control valid" name="address" id="address"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your address'"
                                        placeholder="Enter your address">
                                    <span class="invalid-feedback" id="addressError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="city">City*</label>
                                    <input class="form-control valid" name="city" id="city"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your city'"
                                        placeholder="Enter your city">
                                    <span class="invalid-feedback" id="cityError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="state">State*</label>
                                    <input class="form-control valid" name="state" id="state"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your state'"
                                        placeholder="Enter your state">
                                    <span class="invalid-feedback" id="stateError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="zip">Zip Code*</label>
                                    <input class="form-control valid" name="zip" id="zip"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your zip'"
                                        placeholder="Enter your zip">
                                    <span class="invalid-feedback" id="zipError" style="color:red"></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="telephone">Telephone* (Format 000 000-0000 )</label>
                                    <input class="form-control valid" name="telephone" id="telephone"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your telephone Format(000 000-0000 )'"
                                         data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    <span class="invalid-feedback" id="telephoneError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input class="form-control valid" name="email" id="email"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your email'"
                                        placeholder="Enter your email">
                                    <span class="invalid-feedback" id="emailError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="confirm_email">Confirm Email*</label>
                                    <input class="form-control valid" name="confirm_email" id="confirm_email"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your confirm email'"
                                        placeholder="Enter your confirm email">
                                        <span class="invalid-feedback" id="confirm_emailError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="father">Father Name*</label>
                                    <input class="form-control valid" name="father" id="father"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your father name'"
                                        placeholder="Enter your father name">
                                        <span class="invalid-feedback" id="fatherError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mother">Mother Name*</label>
                                    <input class="form-control valid" name="mother" id="mother"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your mother name'"
                                        placeholder="Enter your mother name">
                                        <span class="invalid-feedback" id="motherError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hschool_graduation">High School Attended and Year of Graduation * (Format Year - Year)</label>
                                    <input class="form-control valid" name="hschool_graduation" id="hschool_graduation"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your high school attend and year of graduation'"
                                        placeholder="Enter your high school attend and year of graduation">
                                    <span class="invalid-feedback" id="hschool_graduationError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="college_university">College/University Currently Attending *</label>
                                    <input class="form-control valid" name="college_university" id="college_university"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your College /University currently attending'"
                                        placeholder="Enter your College /University currently attending">
                                    <span class="invalid-feedback" id="college_universityError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cgpa">Major, Minor, and Current GPA *</label>
                                    <input class="form-control valid" name="cgpa" id="cgpa"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your current CGPA'"
                                        placeholder="Enter your current CGPA">
                                    <span class="invalid-feedback" id="cgpaError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="why_debutant">Why do you wish to become a Debutante (or Escort)? *</label>
                                    <textarea class="form-control w-100" name="why_debutant" id="why_debutant" cols="30" rows="6"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe why do you wish to become a Debutante (or Escort)'" placeholder=" Describe why do you wish to become a Debutante (or Escort)"></textarea>
                                    <span class="invalid-feedback" id="why_debutantError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="is_debutant">Do you have an Escort (or Debutante)? If yes, please list his/her name, address, and college/university *</label>
                                    <textarea class="form-control w-100" name="is_debutant" id="is_debutant" cols="30" rows="6"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe you have an Escort (or Debutante)? If yes, please list his/her name, address, and college/university'" placeholder=" Describe you have an Escort (or Debutante)? If yes, please list his/her name, address, and college/university"></textarea>
                                        <span class="invalid-feedback" id="is_debutantError" style="color:red"></span>
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="is_philosophy">What is your philosophy of life?*</label>
                                    <textarea class="form-control w-100" name="is_philosophy" id="is_philosophy" cols="30" rows="6"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe your philosophy of life'" placeholder=" Describe your philosophy of life"></textarea>
                                        <span class="invalid-feedback" id="is_philosophyError" style="color:red"></span>
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="is_learn_debutant">How did you learn about the Debutante/Escort program? *</label>
                                    <textarea class="form-control w-100" name="is_learn_debutant" id="is_learn_debutant" cols="30" rows="6"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe about the Debutante/Escort program *'" placeholder=" Describe about the Debutante/Escort program *"></textarea>
                                    <span class="invalid-feedback" id="is_learn_debutantError" style="color:red"></span>
                                </div>
                            </div>
                            <input type="hidden" name="reCaptcha" id="reCapcha">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="striker_category">If you were given an opportunity to plan a project, which category would it be?*</label>
                                    <select name="striker_category" id="striker_category" class="form-control">
                                        <option value="">Select Category</option>
                                        <option value="Cultural">Cultural</option>
                                        <option value="Political">Political</option>
                                        <option value="Religious">Religious</option>
                                        <option value="Social">Social</option>
                                    </select>
                                    <span class="invalid-feedback" id="striker_categorytError" style="color:red"></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name_of_striker">Name of Striker/Strikerette who knows of your character and will recommend you. *</label>
                                    <input class="form-control valid" name="name_of_striker" id="name_of_striker"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter the name of Striker/Strikerette who knows of your character and will recommend you'"
                                        placeholder="Enter the name of Striker/Strikerette who knows of your character and will recommend you">
                                        <span class="invalid-feedback" id="name_of_strikerError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="signature_date">Electronic Signature and Date *
                                        (Type your name and add the date in the format mm/dd/yyy)</label>
                                    <input class="form-control valid" name="signature_date" id="signature_date"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Type your name and add the date in the format mm/dd/yyy'"
                                        placeholder="Type your name and add the date in the format mm/dd/yyy">
                                        <span class="invalid-feedback" id="signature_dateError" style="color:red"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="g-recaptcha" data-sitekey="{{ config('captcha.sitekey') }}"></div>
                                <div class="form-group d-none">


                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                </div>
                            </div>

                            {{--<div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name"
                                        type="text" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter your name'"
                                        placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email"
                                        type="email" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                </div>
                            </div>--}}
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" id="submitBtn" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1 card">

                    <h3 class="mt-1 text-center">Popular Posts</h3>
                    <hr>
                    {{--<div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>1100 Springhill Ave.</h3>
                            <p>36603 Mobile</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>Contact Available</h3>
                            <p>Any time</p>
                        </div>
                    </div>

                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>
                                <a class="__cf_email__" data-cfemail="mehediarif.du@gmail.com">[email&#160;protected]</a>
                            </h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>--}}
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

    $(document).ready(function(){
        $('[data-mask]').inputmask()

        $(document).on('click','#submitBtn',function(e){
            e.preventDefault();

            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var dob = $('#dob').val();
            var age = $('#age').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zip = $('#zip').val();
            var telephone = $('#telephone').val();
            var email = $('#email').val();
            var confirm_email = $('#confirm_email').val();
            var father = $('#father').val();
            var mother = $('#mother').val();
            var hschool_graduation = $('#hschool_graduation').val();
            var college_university = $('#college_university').val();
            var cgpa = $('#cgpa').val();
            var why_debutant = $('#why_debutant').val();
            var is_debutant = $('#is_debutant').val();
            var is_philosophy = $('#is_philosophy').val();
            var is_learn_debutant = $('#is_learn_debutant').val();
            var striker_category = $('#striker_category').val();
            var name_of_striker = $('#name_of_striker').val();
            var signature_date = $('#signature_date').val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            var reCaptcha = grecaptcha.getResponse();
                $('#reCapcha').val(reCaptcha)

            // (fname === '') ?  $('#fnameError').text('Enter your first name') : $('#fnameError').text('');
            // (lname === '') ?  $('#lnameError').text('Enter your last name') : $('#lnameError').text('');
            // (dob === '') ?  $('#dobError').text('Enter your date of birth') : $('#dobError').text('');
            // (address === '') ?  $('#addressError').text('Enter your address') : $('#addressError').text('');
            // (city === '') ?  $('#cityError').text('Enter your city') : $('#cityError').text('');
            // (state === '') ?  $('#stateError').text('Enter your state') : $('#stateError').text('');
            // (zip === '') ?  $('#zipError').text('Enter your zip') : $('#zipError').text('');
            // (telephone === '') ?  $('#telephoneError').text('Enter your telephone no.') : $('#telephoneError').text('');
            // (father === '') ?  $('#fatherError').text('Enter your father name ') : $('#fatherError').text('');
            // (mother === '') ?  $('#motherError').text('Enter your mother name ') : $('#motherError').text('');
            // (hschool_graduation === '') ?  $('#hschool_graduationError').text('Enter your mother name ') : $('#hschool_graduationError').text('');
            // (college_university === '') ?  $('#college_universityError').text('Enter your High School Attended and Year of Graduation name (Format Year - Year) ') : $('#college_universityError').text('');
            // // (cgpa === '') ?  $('#motherError').text('Enter your mother name ') : $('#motherError').text('');
            // (why_debutant === '') ?  $('#why_debutantError').text('Enter your College/University Currently Attending ') : $('#why_debutantError').text('');
            // (cgpa === '') ?  $('#cgpaError').text('Enter your Major, Minor, and Current GPA * ') : (isNaN(parseFloat(cgpa))) ?  $('#cgpaError').text('Enter valid cgpa in mumber formate') : $('#cgpaError').text('');
            // (why_debutant === '') ?  $('#why_debutantError').text('Describe why do you wish to become a Debutante (or Escort)? ') : $('#why_debutantError').text('');
            // (is_debutant === '') ?  $('#is_debutantError').text('Do you have an Escort (or Debutante)? If yes, please list his/her name, address, and college/university give details ') : $('#is_debutantError').text('');
            // (is_philosophy === '') ?  $('#is_philosophyError').text('Describe what is your philosophy of life?') : $('#is_philosophyError').text('');
            // (is_learn_debutant === '') ?  $('#is_learn_debutantError').text('Describe how did you learn about the Debutante/Escort program? ') : $('#is_learn_debutantError').text('');
            // (striker_category === '') ?  $('#striker_categoryError').text('Select category ') : $('#striker_categoryError').text('');
            // (name_of_striker === '') ?  $('#name_of_strikerError').text('Enter the name who knows of your character and will recommend you ') : $('#name_of_strikerError').text('');
            // (signature_date === '') ?  $('#signature_dateError').text('Enter your signature name and date') : $('#signature_dateError').text('');
            // (email === '') ?  $('#emailError').text('Enter your email') : (!emailRegex.test(email)) ?  $('#emailError').text('Enter a valid email address') : $('#emailError').text('');
            // (confirm_email === '') ?  $('#confirm_emailError').text('Re-enter your email') : (!emailRegex.test(confirm_email)) ?  $('#confirm_emailError').text('Enter a valid email address') : (email != confirm_email) ?  $('#confirm_emailError').text('Don\'t mach your email')  : $('#confirm_emailError').text('');


            // if(fname !== '' || lname !== '' || dob !== '' || age !== '' || address !== ''|| city !== '' || state !== '' || zip !== '' || telephone !== ''|| father !== '' || mother !== '' || hschool_graduation !== '' || college_university !== ''|| why_debutant !== '' || cgpa !== '' || why_debutant !== '' || is_debutant !== '' ||is_philosophy !== '' || is_learn_debutant !== '' || striker_category !== '' || name_of_striker !== ''|| signature_date !== '' || email !== '' || email === confirm_email ){
                var formData = $('#submitForm').serialize();
                $.ajax({
                    type: 'post',
                    url : "{{ route('debutante.application.store') }}",
                    data : formData,
                    success: function(response){
                        toastr.success(response.success);
                        $('#submitForm')[0].reset();
                        grecaptcha.reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            // Validation errors occurred
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            for (var key in errors) {
                                errorMessage += errors[key][0] + '<br>';
                            }

                            toastr.error(errorMessage);
                        } else {
                            toastr.error('An error occurred while processing the request.');
                            console.log(xhr);
                        }
                    }
                });
            // }
        });
    });
</script>
<script>
    $(document).ready(function() {
      $(document).on('change', '#dob', function() {
        var birthDate = $(this).val();

        // Check if a birthdate is selected
        if (birthDate) {
          // Calculate age
          var today = new Date();
          var birthdateObj = new Date(birthDate); // Corrected variable name
          var age = today.getFullYear() - birthdateObj.getFullYear();

          // Check if birthday has occurred this year
          if (
            today.getMonth() < birthdateObj.getMonth() ||
            (today.getMonth() === birthdateObj.getMonth() && today.getDate() < birthdateObj.getDate())
          ) {
            age--;
          }

          // Display the result (assuming there is an input field with the ID "calculateAge")
          $("#calculateAge").val(age);
        } else {
          // Display an error message if no birthdate is selected
          $("#result").html("Please enter your birthdate.");
        }
      });
    });
  </script>

@endsection
