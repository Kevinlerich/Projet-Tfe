@extends('layouts.front')
@section('title')
    Créer un compte
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
                        Créez votre compte
                    </h3>
                    <p class="
                  a1R
                  aH
                  a1S
                  a2F
                  a1M
                ">
                        C'est totalement gratuit et super facile
                    </p>
                    <button class="
                  a7
                  a8
                  a9
                  a1x
                  a44
                  aw
                  dark:a3w[#242B51]
                  a1S
                  hover:a1W
                  dark:a1S
                  aH a1R
                  dark:hover:aI
                  a13 a33
                  dark:a1n
                  a2E
                ">
<span class="a2A">
<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_95:967)">
<path d="M20.0001 10.2216C20.0122 9.53416 19.9397 8.84776 19.7844 8.17725H10.2042V11.8883H15.8277C15.7211 12.539 15.4814 13.1618 15.1229 13.7194C14.7644 14.2769 14.2946 14.7577 13.7416 15.1327L13.722 15.257L16.7512 17.5567L16.961 17.5772C18.8883 15.8328 19.9997 13.266 19.9997 10.2216" fill="#4285F4" />
<path d="M10.2042 20.0001C12.9592 20.0001 15.2721 19.1111 16.9616 17.5778L13.7416 15.1332C12.88 15.7223 11.7235 16.1334 10.2042 16.1334C8.91385 16.126 7.65863 15.7206 6.61663 14.9747C5.57464 14.2287 4.79879 13.1802 4.39915 11.9778L4.27957 11.9878L1.12973 14.3766L1.08856 14.4888C1.93689 16.1457 3.23879 17.5387 4.84869 18.512C6.45859 19.4852 8.31301 20.0005 10.2046 20.0001" fill="#34A853" />
<path d="M4.39911 11.9777C4.17592 11.3411 4.06075 10.673 4.05819 9.99996C4.0623 9.32799 4.17322 8.66075 4.38696 8.02225L4.38127 7.88968L1.19282 5.4624L1.08852 5.51101C0.372885 6.90343 0.00012207 8.4408 0.00012207 9.99987C0.00012207 11.5589 0.372885 13.0963 1.08852 14.4887L4.39911 11.9777Z" fill="#FBBC05" />
<path d="M10.2042 3.86663C11.6663 3.84438 13.0804 4.37803 14.1498 5.35558L17.0296 2.59996C15.1826 0.901848 12.7366 -0.0298855 10.2042 -3.6784e-05C8.3126 -0.000477834 6.45819 0.514732 4.8483 1.48798C3.2384 2.46124 1.93649 3.85416 1.08813 5.51101L4.38775 8.02225C4.79132 6.82005 5.56974 5.77231 6.61327 5.02675C7.6568 4.28118 8.91279 3.87541 10.2042 3.86663Z" fill="#EB4335" />
</g>
<defs>
<clipPath id="clip0_95:967">
<rect width="20" height="20" fill="white" />
</clipPath>
</defs>
</svg>
</span>
                        S'inscrire avec Google
                    </button>
                    <div class="a8 a9 a1x a23">
<span class="
                    aj
                    sm:ah
                    aB[60px] a7 at[1px] a3f
                  "></span>
                        <p class="
                    a7
                    a37
                    a1S
                    a1M
                    aH
                    a1R
                  ">
                            Ou bien, inscrivez-vous avec votre Email
                        </p>
                        <span class="
                    aj
                    sm:ah
                    aB[60px] a7 at[1px] a3f
                  "></span>
                    </div>
                    <form>
                        <div class="a23">
                            <label for="name" class="
                      ah a1b a1R a1h
                      dark:aI
                      a30
                    ">
                                Nom complet
                            </label>
                            <input type="text" name="name" placeholder="Saisissez votre nom complet" class="
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
                            <label for="email" class="
                      ah a1b a1R a1h
                      dark:aI
                      a30
                    ">
                                Email
                            </label>
                            <input type="email" name="email" placeholder="Saisissez votre Email" class="
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
                            <input type="password" name="password" placeholder="Entrez votre mot de passe" class="
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
                        <div class="a8 a23">
                            <label for="checkboxLabel" class="
                      a8
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
                          a2G a4a
                        ">
<span class="a15">
<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4" />
</svg>
</span>
                                    </div>
                                </div>
                                <span>
En créant un compte, vous acceptez les
<a href="javascript:void(0)" class="a1W hover:a2T">
Conditions générales d'utilisation
</a>
et notre
<a href="javascript:void(0)" class="a1W hover:a2T">
Politique de confidentialité
</a>
</span>
                            </label>
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
                    ">
                                S'inscrire
                            </button>
                        </div>
                    </form>
                    <p class="
                  a1R aH a1S a1M
                ">
                        Vous utilisez déjà Startup ?
                        <a href="signin.html" class="a1W hover:a2T">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="a3 a5 a4 a1Y[-1]">
        <svg width="1440" height="969" viewBox="0 0 1440 969" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0_95:1005" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="1440" height="969">
                <rect width="1440" height="969" fill="#090E34" />
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
