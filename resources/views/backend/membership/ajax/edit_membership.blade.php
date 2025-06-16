<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="fname">First Name*</label>
                    <input class="form-control valid" name="fname" id="fname"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your first name'"
                        placeholder="Enter your first name" value="{{ $membership->fname }}">
                    <span class="invalid-feedback" id="fnameError" style="color:red"></span>
                </div>
            </div>
            <input type="hidden" name="memberId" value="{{ $membership->id }}" id="memberId">
            <div class="col-6">
                <div class="form-group">
                    <label for="lname">Last Name*</label>
                    <input class="form-control valid" name="lname" id="lname"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your last name'"
                        placeholder="Enter your last name" value="{{ $membership->lname }}">
                    <span class="invalid-feedback" id="lnameError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-md-12 d-flex " >
                <div class="form-group col-md-6" >
                    <label for="dob">Date of Birth* </label>
                    <input class="form-control valid" name="dob" id="editDob"
                        type="date" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your brthe date Formate(MM/DD/YYYY)'"
                        placeholder="Enter your birth date" style="width:90% !important" value="{{ $membership->dob }}">
                    <span class="invalid-feedback" id="dobError" style="color:red" ></span>
                </div>
                <div class="form-group col-md-6" style="margin-right: 10%">
                    <label for="age">Age*</label>
                    <input class="form-control valid" name="age" type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'See your age'"
                        placeholder="See your age" disabled id="editCalculateAge" value="{{ $membership->age }}">
                    <span class="invalid-feedback" id="ageError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="address">Address*</label>
                    <input class="form-control valid" name="address" id="address"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your address'"
                        placeholder="Enter your address" value="{{ $membership->address }}">
                    <span class="invalid-feedback" id="addressError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="city">City*</label>
                    <input class="form-control valid" name="city" id="city"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your city'"
                        placeholder="Enter your city" value="{{ $membership->city }}">
                    <span class="invalid-feedback" id="cityError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="state">State*</label>
                    <input class="form-control valid" name="state" id="state"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your state'"
                        placeholder="Enter your state" value="{{ $membership->state }}">
                    <span class="invalid-feedback" id="stateError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="zip">Zip Code*</label>
                    <input class="form-control valid" name="zip" id="zip"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your zip'"
                        placeholder="Enter your zip" value="{{ $membership->zip }}">
                    <span class="invalid-feedback" id="zipError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input class="form-control valid" name="email" id="email"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your email'"
                        placeholder="Enter your email" value="{{ $membership->email }}">
                    <span class="invalid-feedback" id="emailError" style="color:red"  ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="confirm_email">Confirm Email*</label>
                    <input class="form-control valid" name="confirm_email" id="confirm_email"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your confirm email'"
                        placeholder="Enter your confirm email">
                        <span class="invalid-feedback" id="confirm_emailError" style="color:red"></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="telephone">Telephone*</label>
                    <input class="form-control valid" name="telephone" id="telephone"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your telephone Format(000 000-0000 )'"
                        data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $membership->telephone }}">
                    <span class="invalid-feedback" id="telephoneError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="marital">Marital Status*</label>
                    <select name="marital" id="marital" class="form-control">
                        <option value="">--Choose Any--</option>
                        <option value="Married" @selected( $membership->marital == 'Married')>Married</option>
                        <option value="Single" @selected( $membership->marital == 'Single')>Single</option>
                    </select>
                    {{-- <input class="form-control valid" name="marital" id="marital"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your marital status'"
                        placeholder="Enter your marital status">--}}
                        <span class="invalid-feedback" id="maritalError" style="color:red"></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="spouse">Spouse Name</label>
                    <input class="form-control valid" name="spouse" id="spouse"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your spouse name'"
                        placeholder="Enter your spouse name" value="{{ $membership->spouse }}">
                        <span class="invalid-feedback" id="spouseError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="spouse_dob">Spouse Date of Birth *</label>
                    <input class="form-control valid" name="spouse_dob" id="spouse_dob"
                        type="date" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your high school attend and year of graduation'"
                        placeholder="Enter your high school attend and year of graduation"  value="{{ $membership->spouse_dob }}">
                    <span class="invalid-feedback" id="spouse_dobError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="educational_background">Educational Background</label>
                    <input class="form-control valid" name="educational_background" id="educational_background"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your College /University currently attending'"
                        placeholder="Enter your College /University currently attending" value="{{ $membership->educational_background }}">
                    <span class="invalid-feedback" id="educational_backgroundError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input class="form-control valid" name="occupation" id="occupation"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter your current occupation'"
                        placeholder="Enter your current occupation" value="{{ $membership->occupation }}">
                    <span class="invalid-feedback" id="occupationError" style="color:red" ></span>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="religious_affiliation">Religious Affiliation</label>
                    <input class="form-control valid" name="religious_affiliation" id="religious_affiliation"
                    type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your religious affiliation'"
                    placeholder="Enter your religious affiliation" value="{{ $membership->religious_affiliation }}">
                <span class="invalid-feedback" id="religious_affiliationError" style="color:red" ></span>

                    {{-- <textarea class="form-control w-100" name="religious_affiliation" id="religious_affiliation" cols="30" rows="6"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe why do you wish to become a Debutante (or Escort)'" placeholder=" Describe why do you wish to become a Debutante (or Escort)"></textarea>--}}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="hobbies">Hobbies, Intersests</label>
                    <input class="form-control valid" name="hobbies" id="hobbies"
                    type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your hobbies, interests'"
                    placeholder="Enter your hobbies, interests" value="{{ $membership->hobbies }}">
                    {{-- <textarea class="form-control w-100" name="is_debutant" id="hobbies" cols="30" rows="6"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your hobbies'></textarea> --}}
                        <span class="invalid-feedback" id="hobbiesError" style="color:red" ></span>
                    </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="other_affiliations">Other Affiliations</label>
                    <textarea class="form-control w-100" name="other_affiliations" id="other_affiliations" cols="30" rows="3"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe other affiliations'" placeholder="Describe other affiliations">{{ $membership->other_affiliations }}</textarea>
                        <span class="invalid-feedback" id="other_affiliationsError" style="color:red"></span>
                    </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="why_desire">Why do you desire to become a member of the Strikers Club Inc?</label>
                    <textarea class="form-control w-100" name="why_desire" id="why_desire" cols="30" rows="3"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Describe Why desire to become a member of the Strikers Club Inc'" placeholder=" Describe Why desire to become a member of the Strikers Club Inc">{{ $membership->why_desire }}</textarea>
                    <span class="invalid-feedback" id="why_desireError" style="color:red"></span>
                </div>
            </div>
            {{-- <div class="col-12">
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
            </div> --}}

            <div class="col-12">
                <div class="form-group">
                    <label for="name_of_striker">Name of Striker who knows of your character and will recommend you. *</label>
                    <input class="form-control valid" name="name_of_striker" id="name_of_striker"
                        type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter the name of Striker who knows of your character and will recommend you'"
                        placeholder="Enter the name of Striker who knows of your character and will recommend you" value="{{ $membership->name_of_striker }}">
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
                        placeholder="Type your name and add the date in the format mm/dd/yyy" value="{{ $membership->signature_date }}">
                        <span class="invalid-feedback" id="signature_dateError" style="color:red"></span>
                </div>
            </div>
    </div>
</div>
