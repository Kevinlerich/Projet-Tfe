@extends('layouts.front')
@section('title')
    Accueil
@endsection

@section('content')
<section class="ad a1H aq[120px]">
    <div class="aa">
    <div class="a8 a1K ab[-16px]">
    <div class="a7 ae">
    <div class="
                    a1L aB[570px] a1M a3I
                    wow
                    fadeInUp
                  " data-wow-delay=".1s">
    <h2 class="
                      a1A
                      dark:aI
                      a1g a1O
                      sm:a1P
                      md:a24[45px]
                      a1Q
                    ">
                    Bienvenu, Welcome
    </h2>
    <p class=" a1S aH md:a1T a1U md:a1U">
        Startup, une application d'annonces et de prestation de services de photographe.

    </p>
    </div>
    </div>
    </div>
    <div class="a8 a1K ab[-16px]">
    <div class="a7 ae">
    <div class="
                    a1L aB[770px] a13 a2p
                    wow
                    fadeInUp
                  " data-wow-delay=".15s">
    <div class="ad a9 a1x">
    <img src="images/video/video.jpg" alt="video image" class="a7 a2Q a2R a2S" />
    <div class=" a3 a7 a2Q a4 a_ a8 a9 a1x">
    <a href="javascript:void(0)" class="
                          glightbox
                          as[70px]
                          at[70px]
                          a1w
                          a8
                          a9
                          a1x
                          aw
                          a3J
                          a1W
                          hover:a31
                          a1p
                        ">
    <svg width="16" height="18" viewBox="0 0 16 18" class="a26">
    <path d="M15.5 8.13397C16.1667 8.51888 16.1667 9.48112 15.5 9.86602L2 17.6603C1.33333 18.0452 0.499999 17.564 0.499999 16.7942L0.5 1.20577C0.5 0.43597 1.33333 -0.0451549 2 0.339745L15.5 8.13397Z" />
    </svg>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="a3 a1X a5 a_ a1Y[-1]">
    <img src="images/video/shape.svg" alt="shape" class="a7" />
    </div>
    </section>

    <section id="blog" class="bg-primary a1Z a1I[50px] a3A">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="a1L aB[570px] a1M a3s[100px] wow fadeInUp
              " data-wow-delay=".1s">
                        <h2 class="
                  a1A
                  dark:aI
                  a1g a1O
                  sm:a1P
                  md:a24[45px]
                  a1Q
                ">
                            Les annonces
                        </h2>
                        <p class=" a1S aH md:a1T a1U md:a1U">
                            Les différentes annonces des clients
                        </p>
                    </div>
                </div>
            </div>
            <div class="a8 a1K ab[-16px] a1x">
                @foreach($annonces as $annonce)
                    <div class="a7 md:aU/3 lg:a1_/2 xl:a1_/3 ae">
                        <div class="ad aw dark:av a33 a13 a2p a1V wowfadeInUp" data-wow-delay=".1s">
                                <a href="{{ route('detail_annonce', $annonce->slug) }}" class="a7 ah ad">
    <span class=" a3 a34 a35 a1k a1w aM a9 a1x aK ae a2P a1b aI">
    {{ $annonce->category->nom }}
    </span>
                                </a>
                                <div class=" a36 sm:a2Y md:ai md:az lg:a2Y xl:ai xl:a37 2xl:a2Y">
                                    <h3>
                                        <a href="{{ route('detail_annonce', $annonce->slug) }}" class=" a1g a1A dark:aI a27 sm:a2u ah a1Q hover:a1W dark:hover:a1W">
                                            {{ $annonce->titre }}
                                        </a>
                                    </h3>
                                    <p class=" aH a1S a1R a38 a2E a2B a2z a2M dark:a2o dark:a2M">
                                       {!! $annonce->description !!}
                                    </p>
                                    <div class="a8 a9">
                                        <div class=" a8 a9 a39 a2O xl:a3a 2xl:a39 xl:a2A 2xl:a2O a3b a2z a2M dark:a2o dark:a2M">
                                            <div class="
                            aB[40px]
                            a7
                            at[40px]
                            a1w
                            a2p
                            a2G
                          ">
                                            </div>
                                            <div class="a7">
                                                <h4 class=" a1b a1R a1h dark:aI a2K">
                                                    {{ __('Par') }}
                                                    <a href="javascript:void(0)" class=" a1h dark:aI hover:a1W dark:hover:a1W">
                                                        {{ $annonce->user->name }}
                                                    </a>
                                                </h4>
                                                <p class="a3c a1S">
                                                    {{ $annonce->user->ville }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="a22">
                                            <h4 class=" a1b a1R a1h dark:aI a2K">
                                                Date
                                            </h4>
                                            <p class="a3c a1S">{{ $annonce->created_at->format('d, M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="blog" class="bg-primary a1Z a1I[50px] a3A">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="a1L aB[570px] a1M a3s[100px] wow fadeInUp
              " data-wow-delay=".1s">
                        <h2 class="
                  a1A
                  dark:aI
                  a1g a1O
                  sm:a1P
                  md:a24[45px]
                  a1Q
                ">
                            Les services
                        </h2>
                        <p class=" a1S aH md:a1T a1U md:a1U">
                            Les différents services des photographes
                        </p>
                    </div>
                </div>
            </div>
            <div class="a8 a1K ab[-16px] a1x">
                @foreach($services as $service)
                    <div class="a7 md:aU/3 lg:a1_/2 xl:a1_/3 ae">
                        <div class="ad aw dark:av a33 a13 a2p a1V wowfadeInUp" data-wow-delay=".1s">
                                <a href="{{ route('detail_service', $service->slug) }}" class="a7 ah ad">
    <span class=" a3 a34 a35 a1k a1w aM a9 a1x aK ae a2P a1b aI">
    {{ $service->category->nom }}
    </span>
    <img src="{{ asset('storage/'.$service->image_service) }}" alt="image" class="a7" />

                                </a>
                                <div class=" a36 sm:a2Y md:ai md:az lg:a2Y xl:ai xl:a37 2xl:a2Y">
                                    <h3>
                                        <a href="{{ route('detail_service', $service->slug) }}" class=" a1g a1A dark:aI a27 sm:a2u ah a1Q hover:a1W dark:hover:a1W">
                                            {{ $service->nom }}
                                        </a>
                                    </h3>
                                    <p class=" aH a1S a1R a38 a2E a2B a2z a2M dark:a2o dark:a2M">
                                       {!! $service->description !!}
                                    </p>
                                    <div class="a8 a9">
                                        <div class=" a8 a9 a39 a2O xl:a3a 2xl:a39 xl:a2A 2xl:a2O a3b a2z a2M dark:a2o dark:a2M">
                                            <div class="
                            aB[40px]
                            a7
                            at[40px]
                            a1w
                            a2p
                            a2G
                          ">
                                            </div>
                                            <div class="a7">
                                                <h4 class=" a1b a1R a1h dark:aI a2K">
                                                    {{ __('Par') }}
                                                    <a href="javascript:void(0)" class=" a1h dark:aI hover:a1W dark:hover:a1W">
                                                        {{ $service->user->name }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="a22">
                                            <h4 class=" a1b a1R a1h dark:aI a2K">
                                                Date
                                            </h4>
                                            <p class="a3c a1S">{{ $service->created_at->format('d, M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
