@extends('website.layout.master')
@section('title', 'Home')
@section('content')

<style>
/* Reset and Base Styles */
.slider-container, .slider-track, .slide,
.slide-img-container, .slide-content {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Main Container */
.slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}

/* Track */
.slider-track {
    display: flex;
    transition: transform 0.5s ease;
}

/* Individual Slide */
.slide {
    min-width: 100%;
    position: relative;
}

/* Image Container - KEY FIX FOR NO CROPPING */
.slide-img-container {
    width: 100%;
    padding-top: 41.67%; /* 800/1920 = 0.4167 (your image aspect ratio) */
    position: relative;
    background: #f0f0f0; /* Fallback color */
}

/* Image - PROPER FULL IMAGE DISPLAY */
.slide-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain; /* Changed from 'cover' to 'contain' */
    object-position: center;
}

/* Content Overlay */
.slide-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.content-box {
    /* background-color: rgba(0, 0, 0, 0.7); */
    padding: 2rem;
    border-radius: 8px;
    max-width: 1200px;
    width: 90%;
    color: white;
    text-align: center;
}

.slide-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    color:white;
}

.slide-desc {
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
    color:white;
}

.slide-btn {
    display: inline-block;
    padding: 12px 30px;
    background: #C30047;
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.slide-btn:hover {
    background: #FF6378;
}

/* Navigation Arrows */
.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 1.5rem;
    cursor: pointer;
    z-index: 10;
}

.slider-prev { left: 20px; }
.slider-next { right: 20px; }

/* Responsive Adjustments */
@media (max-width: 1200px) {
    .slide-title { font-size: 2rem; }
    .slide-desc { font-size: 1rem; }
    .content-box { padding: 1.5rem; }
}

@media (max-width: 768px) {
    .slide-img-container {
        padding-top: 60%; /* Adjust aspect ratio for taller screens */
    }
    .slide-title { font-size: 1.8rem; }
    .content-box {
        width: 95%;
        padding: 1rem;
    }
}

@media (max-width: 576px) {
    .slide-img-container {
        padding-top: 70%;
    }
    .slide-title { font-size: 1.5rem; }
    .slide-desc { font-size: 0.9rem; }
    .slide-btn { padding: 10px 20px; }
    .slider-nav {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
}
</style>
    <main>

    <div class="slider-container">
        <div class="slider-track">
            @forelse ($sliders as $key => $slider)
            <div class="slide">
                <div class="slide-img-container">
                    <img src="{{ asset('frontend/assets/img/hero/' . $slider->image) }}"
                        alt="{{ $slider->title }}"
                        class="slide-img">
                </div>
                <div class="slide-content">
                    <div class="content-box">
                        <h2 class="slide-title">{{ $slider->title }}</h2>
                        <div class="slide-desc" style="color:white">{!! $slider->details !!}</div>
                        @if($slider->btn_text)
                        <a href="{{ route($slider->call_back_url) }}" class="slide-btn">
                            {{ $slider->btn_text }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="slide">
                <div class="slide-img-container">
                    <img src="{{ asset('frontend/assets/img/hero/default-slider.jpg') }}"
                        alt="Default Slider"
                        class="slide-img">
                </div>
                <div class="slide-content">
                    <div class="content-box">
                        <h2 class="slide-title">Welcome</h2>
                        <div class="slide-desc">Default slider content</div>
                        <a href="#" class="slide-btn">Learn More</a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        <button class="slider-nav slider-prev">❮</button>
        <button class="slider-nav slider-next">❯</button>
    </div>

        <div class="our-services section-padding position-relative">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-xl-7 col-lg-8 col-md-11">

                        <div class="section-tittle text-center mb-70">
                            <h2>We Serve</h2>
                            <p>Generosity Unites, Impact Ignites: Together We Make a Difference! <br>We live together.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-icon">
                                <img src="{{ asset('frontend') }}/assets/img/icon/services1.svg" alt style="width:30%">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">Community Service</a></h5>
                                <p>The Strikers have long been committed to serving the community through monetary donations
                                    and volunteer efforts, such as participation in Habitat for Humanity.

                                    ion-ios-lightbulb</p>
                                <a href="{{ route('gallery') }}" class="btn loan-btn">Gallery Show</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-icon">
                                <img src="{{ asset('frontend') }}/assets/img/icon/services3.svg" alt style="width:30%">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">Debutante Program</a></h5>
                                <p>The debutante program is designed to help form, mold and enhance one’s own personality in
                                    activities of a social, religious, cultural and/or civic nature.

                                    ion-bookmark</p>
                                <a href="{{ route('debutante.program') }}" class="btn loan-btn">Debutante Program</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-icon">
                                <img src="{{ asset('frontend') }}/assets/img/icon/services2.svg" alt style="width:30%">
                            </div>
                            <div class="services-cap">
                                <h5><a href="#">Events</a></h5>
                                <p>We do events and activities throughout the year that promote social etiquette,
                                    philanthropy, fiscal responsibility, and cultural awareness.
                                    ion-upload</p>
                                <a href="{{ route('event.calendar') }}" class="btn loan-btn">Go to Events</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="emargency-care section-img-bg2" data-background="{{ asset('frontend') }}/assets/img/gallery/section-bg2.jpg"> --}}
        <div class="emargency-care section-img-bg2"
            data-background="{{ asset('frontend') }}/assets/img/gallery/Church_Service.jpg">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-6 col-lg-8 col-md-9 col-sm-12">
                        <div class="single-emargency">
                            <div class="emargency-cap">
                                <h5><a href="#">Debutante Program</a></h5>
                                <p>The objectives of the program are achieved through a seven-month curriculum where
                                    participants are engaged in a number of activities throughout the year that promote
                                    social etiquette, philanthropy, fiscal responsibility, and cultural awareness.</p>
                                <p class="emargenc-cap"></p>
                                <a href="{{ route('debutante.program') }}" class="btn loan-btn">Go to Debutante Program</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="join-us-area section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5 col-md-10">
                        <div class="joing-details">
                            <div class="section-tittle">
                                <h2>Membership</h2>
                            </div>
                            <p>The legal definition of a charitable organization (and of charity) varies between
                                countries and in some instances regions of the country. The regulation, the tax
                                treatment, and the way.</p>
                            {{-- <a href="{{ route('debutante.application') }}" class="btn about-btn">Go to Membership</a> --}}
                            <a href="https://form.jotform.com/212704070043138" class="btn about-btn">Go to Membership</a>
                        </div>
                    </div>
                    <div class="offset-xl-1 col-xl-4 col-lg-4 col-md-7 col-sm-7">
                        <div class="joning-img">
                            <img src="{{ asset('frontend') }}/assets/img/gallery/joining1.jpg" alt class="w-100">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5">
                        <div class="joning-img">
                            <img src="{{ asset('frontend') }}/assets/img/gallery/joining2.jpg" alt class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.slider-track');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentIndex = 0;

    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlider();
    });

    // Auto-rotate (optional)
    setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }, 5000);
});
    </script>
@endsection
