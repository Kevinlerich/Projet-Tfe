@extends('layouts.front')
@section('title')
    {{ __('Créer un compte') }}
@endsection
@section('content')

    <section class="ad a1H a1I[180px] a1J[120px]">
        <div class="aa">
            <div class="a8 a1K ab[-16px]">
                <div class="a7 ae">
                    <div class="aB[500px] a1L a1k a1Z dark:av a13 a47 sm:a3B[60px]">
                        <h3 class="a1g a1A dark:aI a2u sm:a1O a30 a1M">
                            {{ __('Créez votre compte') }}
                        </h3>
                        <p class="a1R aH a1S a2F a1M">
                            {{ __('C est totalement gratuit et super facile') }}
                        </p>

                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="a23">
                                <label for="name" class="ah a1b a1R a1h dark:aI a30">
                                    {{ __('Nom complet') }}
                                </label>
                                <input type="text" name="name" required placeholder="Saisissez votre nom complet" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>

                            <div class="a23">
                                <label for="name" class="ah a1b a1R a1h dark:aI a30">
                                    {{ __('Ville') }}
                                </label>
                                <input type="text" name="ville" placeholder="Saisissez votre ville" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>

                            <div class="a23">
                                <label for="telephone" class="ah a1b a1R a1h dark:aI a30">
                                    {{ __('Telephone') }}
                                </label>
                                <input type="tel" name="telephone" placeholder="Saisissez votre telephone" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>
                            <div class="a23">
                                <label for="email" class="ah a1b a1R a1h dark:aI a30">
                                    Email
                                </label>
                                <input type="email" name="email" required placeholder="Saisissez votre Email" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>

                            <div class="a23">
                                <label for="email" class="ah a1b a1R a1h dark:aI a30">
                                    {{ __('Type utilisateur') }}
                                </label>
                                <select name="role" required class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                                    <option value="" selected disabled>Sélectionner un rôle</option>
                                    <option value="2">Photographe</option>
                                    <option value="3">Client</option>
                                </select>
                            </div>
                            <div class="a23">
                                <label for="password" class="ah a1b a1R a1h dark:aI a30">
                                    Votre mot de passe
                                </label>
                                <input type="password" name="password" required placeholder="Entrez votre mot de passe" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>

                            <div class="a23">
                                <label for="password" class="ah a1b a1R a1h dark:aI a30">
                                    Confirmez votre mot de passe
                                </label>
                                <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Entrez votre mot de passe" class="a7 a3l a3m dark:a3w[#242B51] a13 a33 dark:a1n a1i az a1S aH a3x a3o focus-visible:aE focus:a3p"/>
                            </div>
                            <div class="a8 a23">
                                <label for="checkboxLabel" class="a8 a1r a1S a1b a1R a48">
                                    <div class="ad">
                                        <input type="checkbox" id="checkboxLabel" class="a1B" name="terms" required/>
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
<path
    d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
    fill="#3056D3" stroke="#3056D3" stroke-width="0.4"/>
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
                    " type="submit">
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
                <mask id="mask0_95:1005" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="1440"
                      height="969">
                    <rect width="1440" height="969" fill="#090E34"/>
                </mask>
                <g mask="url(#mask0_95:1005)">
                    <path opacity="0.1" d="M1086.96 297.978L632.959 554.978L935.625 535.926L1086.96 297.978Z"
                          fill="url(#paint0_linear_95:1005)"/>
                    <path opacity="0.1" d="M1324.5 755.5L1450 687V886.5L1324.5 967.5L-10 288L1324.5 755.5Z"
                          fill="url(#paint1_linear_95:1005)"/>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_95:1005" x1="1178.4" y1="151.853" x2="780.959" y2="453.581"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4A6CF7"/>
                        <stop offset="1" stop-color="#4A6CF7" stop-opacity="0"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_95:1005" x1="160.5" y1="220" x2="1099.45" y2="1192.04"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4A6CF7"/>
                        <stop offset="1" stop-color="#4A6CF7" stop-opacity="0"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
@endsection
