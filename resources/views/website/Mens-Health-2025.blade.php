@extends('website.layout.master')
@section('title','Striker Mens Health 2025')
@section('content')
<main>
    <style>
        /* Flyer Section */
.flyer-section {
    padding: 2rem 0;
}

.flyer-wrapper {
    position: relative;
    width: 100%;
    margin: 0 auto;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    background: #f8f9fa; /* Fallback background */
}

.flyer-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain; /* Shows entire flyer without cropping */
    transition: transform 0.3s ease;
}

/* Interactive Enhancement */
.flyer-wrapper:hover .flyer-img {
    transform: scale(1.02);
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
    .flyer-wrapper {
        border-radius: 6px;
    }
}

@media (max-width: 768px) {
    .flyer-section {
        padding: 1.5rem 0;
    }
    .flyer-wrapper {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
}

@media (max-width: 576px) {
    .flyer-section {
        padding: 1rem 0;
    }
    .flyer-wrapper {
        border-radius: 4px;
    }
}
    </style>

    <div class="slider-area">
        <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="hero-caption hero-caption2">
                            <h2>Men's Health 2025</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<section class="flyer-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="flyer-wrapper">
                    <!-- Flyer Image with responsive attributes -->
                    <img src="{{ asset('frontend/assets/img/Strikers-Mens-Health-Flyer-2025.jpeg') }}" 
                         alt="Strikers Men's Health Flyer 2025"
                         class="img-fluid flyer-img"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection