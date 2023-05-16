@extends('layouts.front')
@section('title')
    Detail annonce
@endsection
@section('content')
    <section class="a1I[180px] a1J[120px]">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 lg:a2q/12 ae">
                    <div>
                        <h2 class=" a1g a1A dark:aI a1O sm:a1P a2D sm:a2D a23">
                            {{ $annonce->titre }}
                        </h2>
                        <div class=" a8 a1K a9 ac a2L a1V a2B a2z a2M dark:a2o dark:a2M">
                            <div class="a8 a1K a9">
                                <div class="a8 a9 a2N a2v">
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
                                        <h4 class=" aH a1R a1S a2K">
                                            Par
                                            <a href="javascript:void(0)" class="a1S hover:a1W">
                                                {{ $annonce->user->name }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="a8 a9 a2v">
                                    <p class=" a8 a9 aH a1S a1R a2O">
<span class="a2A">
<svg width="15" height="15" viewBox="0 0 15 15" class="a26">
<path d="M3.89531 8.67529H3.10666C2.96327 8.67529 2.86768 8.77089 2.86768 8.91428V9.67904C2.86768 9.82243 2.96327 9.91802 3.10666 9.91802H3.89531C4.03871 9.91802 4.1343 9.82243 4.1343 9.67904V8.91428C4.1343 8.77089 4.03871 8.67529 3.89531 8.67529Z" />
<path d="M6.429 8.67529H5.64035C5.49696 8.67529 5.40137 8.77089 5.40137 8.91428V9.67904C5.40137 9.82243 5.49696 9.91802 5.64035 9.91802H6.429C6.57239 9.91802 6.66799 9.82243 6.66799 9.67904V8.91428C6.66799 8.77089 6.5485 8.67529 6.429 8.67529Z" />
<path d="M8.93828 8.67529H8.14963C8.00624 8.67529 7.91064 8.77089 7.91064 8.91428V9.67904C7.91064 9.82243 8.00624 9.91802 8.14963 9.91802H8.93828C9.08167 9.91802 9.17727 9.82243 9.17727 9.67904V8.91428C9.17727 8.77089 9.08167 8.67529 8.93828 8.67529Z" />
<path d="M11.4715 8.67529H10.6828C10.5394 8.67529 10.4438 8.77089 10.4438 8.91428V9.67904C10.4438 9.82243 10.5394 9.91802 10.6828 9.91802H11.4715C11.6149 9.91802 11.7105 9.82243 11.7105 9.67904V8.91428C11.7105 8.77089 11.591 8.67529 11.4715 8.67529Z" />
<path d="M3.89531 11.1606H3.10666C2.96327 11.1606 2.86768 11.2562 2.86768 11.3996V12.1644C2.86768 12.3078 2.96327 12.4034 3.10666 12.4034H3.89531C4.03871 12.4034 4.1343 12.3078 4.1343 12.1644V11.3996C4.1343 11.2562 4.03871 11.1606 3.89531 11.1606Z" />
<path d="M6.429 11.1606H5.64035C5.49696 11.1606 5.40137 11.2562 5.40137 11.3996V12.1644C5.40137 12.3078 5.49696 12.4034 5.64035 12.4034H6.429C6.57239 12.4034 6.66799 12.3078 6.66799 12.1644V11.3996C6.66799 11.2562 6.5485 11.1606 6.429 11.1606Z" />
<path d="M8.93828 11.1606H8.14963C8.00624 11.1606 7.91064 11.2562 7.91064 11.3996V12.1644C7.91064 12.3078 8.00624 12.4034 8.14963 12.4034H8.93828C9.08167 12.4034 9.17727 12.3078 9.17727 12.1644V11.3996C9.17727 11.2562 9.08167 11.1606 8.93828 11.1606Z" />
<path d="M11.4715 11.1606H10.6828C10.5394 11.1606 10.4438 11.2562 10.4438 11.3996V12.1644C10.4438 12.3078 10.5394 12.4034 10.6828 12.4034H11.4715C11.6149 12.4034 11.7105 12.3078 11.7105 12.1644V11.3996C11.7105 11.2562 11.591 11.1606 11.4715 11.1606Z" />
<path d="M13.2637 3.3697H7.64754V2.58105C8.19721 2.43765 8.62738 1.91189 8.62738 1.31442C8.62738 0.597464 8.02992 0 7.28906 0C6.54821 0 5.95074 0.597464 5.95074 1.31442C5.95074 1.91189 6.35702 2.41376 6.93058 2.58105V3.3697H1.31442C0.597464 3.3697 0 3.96716 0 4.68412V13.2637C0 13.9807 0.597464 14.5781 1.31442 14.5781H13.2637C13.9807 14.5781 14.5781 13.9807 14.5781 13.2637V4.68412C14.5781 3.96716 13.9807 3.3697 13.2637 3.3697ZM6.6677 1.31442C6.6677 0.979841 6.93058 0.716957 7.28906 0.716957C7.62364 0.716957 7.91042 0.979841 7.91042 1.31442C7.91042 1.649 7.64754 1.91189 7.28906 1.91189C6.95448 1.91189 6.6677 1.6251 6.6677 1.31442ZM1.31442 4.08665H13.2637C13.5983 4.08665 13.8612 4.34954 13.8612 4.68412V6.45261H0.716957V4.68412C0.716957 4.34954 0.979841 4.08665 1.31442 4.08665ZM13.2637 13.8612H1.31442C0.979841 13.8612 0.716957 13.5983 0.716957 13.2637V7.16957H13.8612V13.2637C13.8612 13.5983 13.5983 13.8612 13.2637 13.8612Z" />
</svg>
</span>
                                        {{ $annonce->created_at->format('d, M Y') }}
                                    </p>

                                </div>
                            </div>
                            <div class="a2v">
<span class=" a1k a1w aM a9 a1x aK ae a2P a1b aI">
{{ $annonce->category->nom }}
</span>
                            </div>
                        </div>
                        <div>
                            <p class=" a1R a1S aH sm:a1T lg:aH xl:a1T sm:a1U lg:a1U xl:a1U a1U a1V">
                                {!! $annonce->description !!}
                            </p>

                        </div>
                    </div>
                </div>
                <div class="a7 lg:a20/12 ae">

                    <div class="
                ad
                a1H
                a13
                a1k
                a3g[3%]
                dark:a29
                a2Y
                sm:a3t
                lg:a2Y
                xl:a3t
                wow
                fadeInUp
              " data-wow-delay=".2s
              ">
                        <h3 class=" a1A dark:aI a1g a2u a2D a1Q">
                            Contactez l'annonceur
                        </h3>
                        <p class=" a1R aH a1S a1U a3u a2F a2B a2z a3v dark:a2o dark:a3v">
                            Ecrire à l'annonceur
                        </p>
                        @auth
                            <form route="{{ route('contact_annonce') }}" method="post">
                                @csrf
                                <input type="hidden" name="destinataire_id" value="{{ $annonce->user_id }}">
                                <input type="hidden" name="objet" value="{{ $annonce->titre }}" class="
                    a7
                    a3l
                    a2z
                    a2M
                    dark:a2o
                    dark:a2M
                    dark:a3w[#242B51]
                    a13
                    a1i
                    az
                    a1R
                    a1S
                    aH
                    a3x
                    a3o
                    focus-visible:aE
                    focus:a3p focus:a3y
                    a1Q
                  " />
                  <label for="contenu" class=" a1A dark:aI a1g a2u a2D a1Q">Votre message ici</label>

                                <textarea name="contenu" class="
                    a7
                    a3l
                    a2z
                    a2M
                    dark:a2o
                    dark:a2M
                    dark:a3w[#242B51]
                    a13
                    a1i
                    az
                    a1R
                    a1S
                    aH
                    a3x
                    a3o
                    focus-visible:aE
                    focus:a3p focus:a3y
                    a1Q
                  " ></textarea>

                                <input type="submit" value="Envoyer" class=" a7 a3l a3p a1k a13 a1i az a1R aI aH a1M a3o a1r focus-visible:aE hover:a1n hover:a2i a1p a3z a2j a1Q" />
                                <p class=" aH a1S a1M a1R a1U">
                                    Pas de spam guarantie.
                                </p>
                            </form>
                        @endauth
                        @guest
                            <p>Connectez-vous afin de contacter cet annonceur.</p>
                        @endguest
                        <div class="a3 a4 a5 a1Y[-1]">
                            <svg width="370" height="596" viewBox="0 0 370 596" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_88:141" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="370" height="596">
                                    <rect width="370" height="596" rx="2" fill="#1D2144" />
                                </mask>
                                <g mask="url(#mask0_88:141)">
                                    <path opacity="0.15" d="M15.4076 50.9571L54.1541 99.0711L71.4489 35.1605L15.4076 50.9571Z" fill="url(#paint0_linear_88:141)" />
                                    <path opacity="0.15" d="M20.7137 501.422L44.6431 474.241L6 470.624L20.7137 501.422Z" fill="url(#paint1_linear_88:141)" />
                                    <path opacity="0.1" d="M331.676 198.309C344.398 204.636 359.168 194.704 358.107 180.536C357.12 167.363 342.941 159.531 331.265 165.71C318.077 172.69 318.317 191.664 331.676 198.309Z" fill="url(#paint2_linear_88:141)" />
                                    <g opacity="0.3">
                                        <path d="M209 89.9999C216 77.3332 235.7 50.7999 258.5 45.9999C287 39.9999 303 41.9999 314 30.4999C325 18.9999 334 -3.50014 357 -3.50014C380 -3.50014 395 4.99986 408.5 -8.50014C422 -22.0001 418.5 -46.0001 452 -37.5001C478.8 -30.7001 515.167 -45 530 -53" stroke="url(#paint3_linear_88:141)" />
                                        <path d="M251 64.9999C258 52.3332 277.7 25.7999 300.5 20.9999C329 14.9999 345 16.9999 356 5.49986C367 -6.00014 376 -28.5001 399 -28.5001C422 -28.5001 437 -20.0001 450.5 -33.5001C464 -47.0001 460.5 -71.0001 494 -62.5001C520.8 -55.7001 557.167 -70 572 -78" stroke="url(#paint4_linear_88:141)" />
                                        <path d="M212 73.9999C219 61.3332 238.7 34.7999 261.5 29.9999C290 23.9999 306 25.9999 317 14.4999C328 2.99986 337 -19.5001 360 -19.5001C383 -19.5001 398 -11.0001 411.5 -24.5001C425 -38.0001 421.5 -62.0001 455 -53.5001C481.8 -46.7001 518.167 -61 533 -69" stroke="url(#paint5_linear_88:141)" />
                                        <path d="M249 40.9999C256 28.3332 275.7 1.79986 298.5 -3.00014C327 -9.00014 343 -7.00014 354 -18.5001C365 -30.0001 374 -52.5001 397 -52.5001C420 -52.5001 435 -44.0001 448.5 -57.5001C462 -71.0001 458.5 -95.0001 492 -86.5001C518.8 -79.7001 555.167 -94 570 -102" stroke="url(#paint6_linear_88:141)" />
                                    </g>
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_88:141" x1="13.4497" y1="63.5059" x2="81.144" y2="41.5072" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_88:141" x1="28.1579" y1="501.301" x2="8.69936" y2="464.391" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint2_linear_88:141" x1="338" y1="167" x2="349.488" y2="200.004" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint3_linear_88:141" x1="369.5" y1="-53" x2="369.5" y2="89.9999" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint4_linear_88:141" x1="411.5" y1="-78" x2="411.5" y2="64.9999" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint5_linear_88:141" x1="372.5" y1="-69" x2="372.5" y2="73.9999" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint6_linear_88:141" x1="409.5" y1="-102" x2="409.5" y2="40.9999" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" />
                                        <stop offset="1" stop-color="white" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
