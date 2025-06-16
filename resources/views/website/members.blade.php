@extends('website.layout.master')
@section('title', 'Members')
@section('content')
    <main>

        <div class="slider-area">
            <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="hero-caption hero-caption2">
                                <h2>Members</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="services-area1 section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-11">

                        <div class="section-tittle text-center mb-60">
                            <h2>Our Honourable Members</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @forelse ($members as $member)



                    <div class="col-lg-4 col-md-6 col-sm-6">

                        <div class="properties pb-30">
                            <div class="properties-card">
                                <div class="properties-img">
                                    @php
                                        ($member->image !=null) ? $img = $member->image : $img = '400x600.png' ;
                                    @endphp
                                    <a href="#"><img src="{{ asset('frontend/assets/img/members/' . $img) }}" alt=""></a>

                                    {{--<div class="single-skill">
                                        <div class="bar-progress">
                                            <div id="bar1" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                                <span class="fill" data-percentage="65"></span>
                                            </div>
                                        </div>
                                    </div>--}}

                                </div>
                                <div class="wrap-wrapper">
                                    <div class="properties-caption">
                                        <h3><a href="#">{{ $member->name }}</a></h3>
                                        <p>{{"Member"}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty

                    @endforelse
                    <div class="support-caption" >
                        <a href="{{ route('about') }}" class="btn  btn-sm" style="float:right">Show More</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
