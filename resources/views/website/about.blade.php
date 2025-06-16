@extends('website.layout.master')
@section('title', 'About Us')
@section('content')
    <main>

        <div class="slider-area">
            <div class="slider-height2 slider-bg4 hero-overly d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="hero-caption hero-caption2">
                                <h2>About Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="support-company-area section-padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="right-caption">

                            <div class="section-tittle">
                                <h2>History of the Organization</h2>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="support-caption">
                                        <p class="mb-10">
                                            The Strikers Social Club was organized in November of 1933 and consisted of nine original members. The charter members were: Emanuel Carter (first president), Norman Hall, Edgar Harris, Herbert Jones, Fred Lymon, Leslie Malone, Lindsey Steel, Clarence Wallace and Robert Wilson.
                                        </p>
                                        <p class="pera-top">The first social event was a breakfast dance held on Christmas Day, 1933, at the Community House on Davis Avenue. After this affair, the membership rose to fifteen. In April of 1934, the club presented its first annual ball. The theme was, “A Night Under the South East Alabama Annual Conference.” The club members were dressed in costumes representing various kinds of fish. The ladies were dressed in evening gowns of colors to match their partners’ (members) costumes.</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-10">
                                    <div class="support-location-img">
                                        <img src="{{'frontend'}}/assets/img/abt1.jpg" alt>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-10">
                                <div class="support-location-img">
                                    <img src="{{'frontend'}}/assets/img/abt2.jpg" alt>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-10">
                                <p class="mb-10">
                                    In 1934, The Strikers Social Club was asked to join the Smart and Thrifty Club (Ladies Club) in sponsoring a Mardi Gras parade. After much planning, the Strikers Club, Incorporated, the Smart and Thrifty Club and the Chaffeur Social Club united to sponsor the first African-American Carnival Parade. The community stirred about in zero degree weather on Fat Tuesday night to partake of the parade. Following the parade, a coronation was held. King Winston Allen crowned Ruby Morgan as the first African-American Queen of Mardi Gras.
                                </p>
                                <p class="pera-top">In 1936, The Strikers Club, Inc. presented its first African-American Debutante Ball. At one minute after midnight, fourteen young ladies were introduced to the Azalea City Social Circle at the Gomez Auditorium.</p>
                                <p class="mb-10">
                                    The debutante program continued to flourish as it sought to encourage higher education and provide training to young ladies on civic, social and religious topics. The organization was vanguard in several arenas. Strikers Club, Inc. was the first organization to sponsor a ball in ILA Hall. It was also the first black organization to require Costume de Rigueur for all male guests.
                                </p>
                            </div>
                        </div>
                                <p class="pera-top">The members of the Strikers Club, Inc. remain socially conscious and participate in many activities to benefit the community. Some of the club’s civic activities include:</p>

                                <p > -- Joining the NAACP in 1934 to support an anti-lynch law</p>
                                <p > -- Donating a bus for mentally challenged children</p>
                                <p > -- Making generous contributions to the YMCA building fund</p>
                                <p > -- Serving as one of the original supporters of the Gulf Federal Savings and Loan Commonwealth National Bank</p>
                                <p > -- Sponsoring the Ebony Fashion Show</p>
                                <p > -- Sponsoring a hat show for the community </p>
                                <p >The club’s public service and community involvement continue today.</p>

                                <a href="{{ route('debutante.program') }}" class="btn about-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
