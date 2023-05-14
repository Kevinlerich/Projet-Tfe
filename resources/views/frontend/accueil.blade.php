@extends('layouts.front')
@section('title')
    Accueil
@endsection
@section('content')
    <section id="home" class="
        ad a1H a1I[120px] a1J[110px]
        md:a1I[150px] md:a1J[120px]
        xl:a1I[180px] xl:a1J[160px]
        2xl:a1I[210px] 2xl:a1J[200px]
      ">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="a1L aB[570px] a1M wow fadeInUp" data-wow-delay=".2s">
                        <h1 class=" a1A dark:aI a1g a1O sm:a1P md:a3D a2D sm:a2D md:a2D a2v">
                            Bienvenu dans notre application
                        </h1>
                        <p class=" a1R a1T md:a27 a1U md:a1U a1S dark:aI dark:a3E a2s">
                            C'est une application de prestations de services etc....
                        </p>
                        <div class="a8 a9 a1x">
                            <a href="{{ route('services') }}" class=" aH a2P aI a1k a3q a1l hover:a2i a3F a13 a1p a1a a2j">
                                Trouver le service d'un photographe
                            </a>
                            <a href="{{ route('create_annonce') }}" class=" aH a2P a1A a1 a29 dark:aI dark:aw dark:a29 a3q a1l hover:a3G dark:hover:a3G a3F a13 a1p a1a a2j">
                                Publier une annonce
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="bg-primary a1Z a1I[120px] a3A">
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

{{--
    <section id="blog" class="bg-primary a1Z a1I[120px] a3A">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="
                a1L aB[570px] a1M a3s[100px]
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
                            Les services
                        </h2>
                        <p class=" a1S aH md:a1T a1U md:a1U">
                            Les différents services des photographes
                        </p>
                    </div>
                </div>
            </div>
            <div class="a8 a1K ab[-16px] a1x">
                <div class="a7 md:aU/3 lg:a1_/2 xl:a1_/3 ae">
                    @foreach($services as $service)
                        <div class="ad aw dark:av a33 a13 a2p a1V wowfadeInUp" data-wow-delay=".1s">
                            <a href="javascript:void(0)" class="a7 ah ad">
<span class=" a3 a34 a35 a1k a1w aM a9 a1x aK ae a2P a1b aI">
Computer
</span>
                                <img src="images/blog/blog-01.jpg" alt="image" class="a7" />
                            </a>
                            <div class=" a36 sm:a2Y md:ai md:az lg:a2Y xl:ai xl:a37 2xl:a2Y">
                                <h3>
                                    <a href="javascript:void(0)" class=" a1g a1A dark:aI a27 sm:a2u ah a1Q hover:a1W dark:hover:a1W">
                                        Best UI components for modern websites
                                    </a>
                                </h3>
                                <p class=" aH a1S a1R a38 a2E a2B a2z a2M dark:a2o dark:a2M">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras
                                    sit amet dictum neque, laoreet dolor.
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
                                            <img src="images/blog/author-01.png" alt="author" class="a7" />
                                        </div>
                                        <div class="a7">
                                            <h4 class=" a1b a1R a1h dark:aI a2K">
                                                By
                                                <a href="javascript:void(0)" class=" a1h dark:aI hover:a1W dark:hover:a1W">
                                                    Samuyl Joshi
                                                </a>
                                            </h4>
                                            <p class="a3c a1S">
                                                Graphic Designer
                                            </p>
                                        </div>
                                    </div>
                                    <div class="a22">
                                        <h4 class=" a1b a1R a1h dark:aI a2K">
                                            Date
                                        </h4>
                                        <p class="a3c a1S">15 Dec, 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
--}}
@endsection
