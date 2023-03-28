@extends('layouts.front')
@section('title')
    Se connecter
@endsection
@section('content')
    <section class="ad a1H a1I[180px] a1J[120px]">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="
                aB[500px] a1L a1k a1Z
                dark:av
                a13 a47
                sm:a3B[60px]
              ">
                        <h3 class="
                  a1g a1A
                  dark:aI
                  a2u
                  sm:a1O
                  a30 a1M
                ">
                            Connectez-vous à votre compte
                        </h3>
                        <p class="
                  a1R
                  aH
                  a1S
                  a2F
                  a1M
                ">
                            Connectez-vous à votre compte pour accéder à nos services.
                        </p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="a23">
                                <label for="email" class="
                      ah a1b a1R a1h
                      dark:aI
                      a30
                    ">
                                    Votre Email
                                </label>
                                <input type="email" name="email" placeholder="Entrer votre Email" class="
                      a7 a3l a3m
                      dark:a3w[#242B51]
                      a13 a33
                      dark:a1n
                      a1i
                      az
                      a1S
                      aH
                      a3x
                      a3o
                      focus-visible:aE
                      focus:a3p
                    " />
                            </div>
                            <div class="a23">
                                <label for="password" class="
                      ah a1b a1R a1h
                      dark:aI
                      a30
                    ">
                                    Votre mot de passe
                                </label>
                                <input type="password" name="password" placeholder="Enter your Password" class="
                      a7 a3l a3m
                      dark:a3w[#242B51]
                      a13 a33
                      dark:a1n
                      a1i
                      az
                      a1S
                      aH
                      a3x
                      a3o
                      focus-visible:aE
                      focus:a3p
                    " />
                            </div>
                            <div class="a8 a9 ac a23">
                                <div>
                                    <label for="checkboxLabel" class="
                        a8
                        a9
                        a1r
                        a1S
                        a1b
                        a1R
                        a48
                      ">
                                        <div class="ad">
                                            <input type="checkbox" id="checkboxLabel" class="a1B" />
                                            <div class="
                            box
                            a8
                            a9
                            a1x
                            a1D
                            a1E
                            a1c
                            a3l
                            a2z
                            a49
                            dark:a2o dark:a2M
                            a2G
                          ">
<span class="a15">
<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4" />
</svg>
</span>
                                            </div>
                                        </div>
                                        Se souvenir de moi
                                    </label>
                                </div>
                                <div>
                                    <a href="{{ route('password.request') }}" class="
                        a1W a1b a1R
                        hover:a2T
                      ">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
                            </div>
                            <div class="a2E">
                                <button class="
                      a7
                      a8
                      a9
                      a1x
                      aH
                      a1R
                      aI
                      a1k
                      a3q
                      a1m
                      hover:a1n hover:a2i
                      a1p a1a a2j a13
                    " type="submit">
                                    Se connecter
                                </button>
                            </div>
                        </form>
                        <p class="
                  a1R aH a1S a1M
                ">
                            Vous avez déjà un compte ?
                            <a href="{{ route('register') }}" class="a1W hover:a2T">
                                Créer un compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="a3 a4 a5 a1Y[-1]">
            <svg width="1440" height="969" viewBox="0 0 1440 969" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_95:1005" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="1440" height="969">
                    <rect with="1440" height="969" fill="#090E34" />
                </mask>
                <g mask="url(#mask0_95:1005)">
                    <path opacity="0.1" d="M1086.96 297.978L632.959 554.978L935.625 535.926L1086.96 297.978Z" fill="url(#paint0_linear_95:1005)" />
                    <path opacity="0.1" d="M1324.5 755.5L1450 687V886.5L1324.5 967.5L-10 288L1324.5 755.5Z" fill="url(#paint1_linear_95:1005)" />
                </g>
                <defs>
                    <linearGradient id="paint0_linear_95:1005" x1="1178.4" y1="151.853" x2="780.959" y2="453.581" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4A6CF7" />
                        <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
                    </linearGradient>
                    <linearGradient id="paint1_linear_95:1005" x1="160.5" y1="220" x2="1099.45" y2="1192.04" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4A6CF7" />
                        <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
@endsection
