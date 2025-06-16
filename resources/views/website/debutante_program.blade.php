@extends('website.layout.master')
@section('title','Debunate Program')
@section('content')
<main>

    <div class="slider-area">
        <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="hero-caption hero-caption2">
                            <h2>Debutante Program</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="support-company-area section-padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-10">
                    <div class="support-location-img">
                        <img src="{{'frontend'}}/assets/img/gallery/Striker's_Club_about.jpg" alt>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-10">
                    <div class="right-caption">

                        <div class="section-tittle">
                            <h2>Debutante Program</h2>
                        </div>


                        <div class="support-caption">
                            <p class="mb-10">
                                For more than 85 years, the Strikers Club has formally presented young ladies to society through the Debutante Cotillion Program.  The Debutante Cotillion Program was developed to help form, mold and enhance one’s own personality in activities of social, religious, cultural and/or civic nature.  The Debutante Program is the PRIDE of the Strikers Club, Inc.

                            </p>
                            <p class="pera-top">
                                The objectives of the program are achieved through a seven-month curriculum where participants are engaged in a number of activities throughout the year that promote social etiquette, philanthropy, fiscal responsibility, and cultural awareness.  The culminating events are the Main Luncheon and Grand Cotillion Ball. These two events allow participants to demonstrate to the public the skills and knowledge that they have acquired over the seven-month span.
                            </p>
                            <a href="{{ route('about') }}" class="btn about-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="join-us-area section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="joing-details">
                        <div class="section-tittle">
                            <h2>REQUIREMENTS</h2>
                        </div>
                        <p>
                            The program is open to any young lady who has completed a minimum of one-year of post-secondary training (upcoming sophomore) and is presently attending an accredited institution of learning.

                            The Strikers Club, Inc. WILL NOT accept applicants who are married, have previously been married or engaged to be married; have a child; or have participated in activities unbecoming a prospective debutante.



                            If you are interested in the Debutante Program, click the link below for an application:
                        </p>
                        <a href="https://form.jotform.com/212704070043138" class="btn about-btn">Click Here for Debutante application</a>
                    </div>
                </div>
                <div class="offset-xl-1 col-xl-4 col-lg-4 col-md-7 col-sm-7">
                    <div class="joning-img">
                        <img src="assets/img/gallery/joining1.jpg" alt class="w-100">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5">
                    <div class="joning-img">
                        <img src="assets/img/gallery/joining2.jpg" alt class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
{{-- DEBUTANTE PROGRAM

For more than 85 years, the Strikers Club has formally presented young ladies to society through the Debutante Cotillion Program.  The Debutante Cotillion Program was developed to help form, mold and enhance one’s own personality in activities of social, religious, cultural and/or civic nature.  The Debutante Program is the PRIDE of the Strikers Club, Inc.

The objectives of the program are achieved through a seven-month curriculum where participants are engaged in a number of activities throughout the year that promote social etiquette, philanthropy, fiscal responsibility, and cultural awareness.  The culminating events are the Main Luncheon and Grand Cotillion Ball. These two events allow participants to demonstrate to the public the skills and knowledge that they have acquired over the seven-month span.

REQUIREMENTS

The program is open to any young lady who has completed a minimum of one-year of post-secondary training (upcoming sophomore) and is presently attending an accredited institution of learning.

The Strikers Club, Inc. WILL NOT accept applicants who are married, have previously been married or engaged to be married; have a child; or have participated in activities unbecoming a prospective debutante.



If you are interested in the Debutante Program, click the link below for an application:

Click Here for Debutante application --}}
@endsection
