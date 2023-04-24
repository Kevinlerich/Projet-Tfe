@extends('layouts.front')
@section('title')
    Services
@endsection
@section('content')
    <section class="ad a1H a1I[150px] a2p">
        <div class="aa">
            <div class="a8 a1K a9 ab[-16px]">
                <div class="a7 md:a2q/12 lg:a2r/12 ae">
                    <div class="aB[570px] a2s md:a2t">
                        <h1 class="
                  a1g a1A
                  dark:aI
                  a2u
                  sm:a1O
                  a2v
                ">
                            Services
                        </h1>
                        <p class="a1R aH a1S a1U">
                            Les différents services qu'offrent nos photographes
                        </p>
                    </div>
                </div>
                <div class="a7 md:a20/12 lg:a1D/12 ae">
                    <div class="a2w">
                        <ul class="a8 a9 md:a1d">
                            <li class="a8 a9">
                                <a href="/" class="a1R aH a1S a2x hover:a1W">
                                    Accueil
                                </a>
                                <span class="ah aU aV a2y aX a2z aZ a2A"></span>
                            </li>
                            <li class="a1R aH a1W">
                                Services
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
<span class="a3 a4 a5 a1Y[-1]">
<svg width="287" height="254" viewBox="0 0 287 254" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.1" d="M286.5 0.5L-14.5 254.5V69.5L286.5 0.5Z" fill="url(#paint0_linear_111:578)" />
<defs>
<linearGradient id="paint0_linear_111:578" x1="-40.5" y1="117" x2="301.926" y2="-97.1485" gradientUnits="userSpaceOnUse">
<stop stop-color="#4A6CF7" />
<stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
</linearGradient>
</defs>
</svg>
</span>
            <span class="a3 a_ a4 a1Y[-1]">
                <svg width="628" height="258" viewBox="0 0 628 258" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.1" d="M669.125 257.002L345.875 31.9983L524.571 -15.8832L669.125 257.002Z" fill="url(#paint0_linear_0:1)" />
<path opacity="0.1" d="M0.0716344 182.78L101.988 -15.0769L142.154 81.4093L0.0716344 182.78Z" fill="url(#paint1_linear_0:1)" />
<defs>
<linearGradient id="paint0_linear_0:1" x1="644" y1="221" x2="429.946" y2="37.0429" gradientUnits="userSpaceOnUse">
<stop stop-color="#4A6CF7" />
<stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
</linearGradient>
<linearGradient id="paint1_linear_0:1" x1="18.3648" y1="166.016" x2="105.377" y2="32.3398" gradientUnits="userSpaceOnUse">
<stop stop-color="#4A6CF7" />
<stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
</linearGradient>
</defs>
</svg>
</span>
        </div>
    </section>

    <section class="a1I[120px] a1J[120px]">
        <div class="aa">
            <div class="a8 a1K ab[-16px] a1x">
                @foreach($services as $service)
                <div class="a7 md:aU/3 lg:a1_/2 xl:a1_/3 ae">
                    <div class="
                ad aw
                dark:av
                a33 a13 a2p a1V
                wow
                fadeInUp
              " data-wow-delay=".1s">
                        <a href="{{ route('detail_service', $service->id) }}" class="a7 ah ad">
<span class="
                    a3
                    a34
                    a35
                    a1k
                    a1w
                    aM
                    a9
                    a1x
                    aK
                    ae
                    a2P
                    a1b
                    aI
                  ">
{{ $service->category->nom }}
</span>
                            <img src="{{ asset('storage/'.$service->image_service) }}" alt="image" class="a7" />
                        </a>
                        <div class="
                  a36
                  sm:a2Y
                  md:ai md:az
                  lg:a2Y
                  xl:ai xl:a37
                  2xl:a2Y
                ">
                            <h3>
                                <a href="{{ route('detail_service', $service->id) }}" class="
                      a1g a1A
                      dark:aI
                      a27
                      sm:a2u
                      ah a1Q
                      hover:a1W
                      dark:hover:a1W
                    ">
                                    {!! $service->nom !!}
                                </a>
                            </h3>
                            <p class="
                    aH
                    a1S
                    a1R
                    a38
                    a2E
                    a2B
                    a2z
                    a2M
                    dark:a2o dark:a2M
                  ">
                                {!! $service->description !!}
                            </p>
                            <div class="a8 a9">
                                <div class="
                      a8 a9 a39 a2O
                      xl:a3a
                      2xl:a39
                      xl:a2A
                      2xl:a2O
                      a3b a2z a2M
                      dark:a2o dark:a2M
                    ">
                                    <div class="
                        aB[40px]
                        a7
                        at[40px]
                        a1w
                        a2p
                        a2G
                      ">
                                        <img src="{{ asset('storage/'.$service->user->profile_photo_path) }}" alt="author" class="a7" />
                                    </div>
                                    <div class="a7">
                                        <h4 class="
                          a1b a1R a1h
                          dark:aI
                          a2K
                        ">
                                            Par
                                            <a href="javascript:void(0)" class="
                            a1h
                            dark:aI
                            hover:a1W
                            dark:hover:a1W
                          ">
                                                {{ $service->user->name }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="a22">
                                    <h4 class="
                        a1b a1R a1h
                        dark:aI
                        a2K
                      ">
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
            <div class="a8 a1K ab[-16px] wow fadeInUp" data-wow-delay=".15s">
                <div class="a7 ae">
                    <ul class="a8 a9 a3d a1x">
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                Prev
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                1
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                2
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                3
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    a1S
                    ae
                    a1b
                    a3h[36px]
                    a1t
                    a3i
                  ">
                                ...
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                12
                            </a>
                        </li>
                        <li class="a3e">
                            <a href="javascript:void(0)" class="
                    a8
                    a9
                    a1x
                    a13
                    a3f
                    a3g[15%]
                    hover:a1k hover:a31
                    a1p
                    hover:aI
                    a1S ae a1b a3h[36px] a1t
                  ">
                                Next
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
