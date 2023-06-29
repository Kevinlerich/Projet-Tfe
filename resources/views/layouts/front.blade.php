<!DOCTYPE html>
<html lang="fr">
<head>

  <!-- ** Basic Page Needs ** -->
  <meta charset="utf-8">
  <title>@yield('title') | Star Of Service</title>

  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Agency HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- theme meta -->
  <meta name="theme-name" content="classimax" />

  <!-- favicon -->
  <link href="{{ asset('images/logo.jpg') }}" rel="shortcut icon">

  <!--
  Essential stylesheets
  =====================================-->
  <link href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/bootstrap/bootstrap-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/slick/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/slick/slick-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@yield('styles')
</head>

<body class="body-wrapper">


<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="/">
						<img src="{{ asset('images/logo.jpg') }}" width="140px" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="ml-auto navbar-nav main-nav ">
							<li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
								<a class="nav-link" href="/">Accueil</a>
							</li>
                            <li class="nav-item {{ Request::is('services') ? 'active' : '' }}">
								<a class="nav-link" href="{{ route('services') }}">Services</a>
							</li>
                            <li class="nav-item {{ Request::is('annonces') ? 'active' : '' }}">
								<a class="nav-link" href="{{ route('annonces') }}">Annonces</a>
							</li>

						</ul>
						<ul class="mt-10 ml-auto navbar-nav">
							@guest
                            <li class="nav-item">
								<a class="nav-link login-button" href="{{ route('login') }}">Connexion</a>
							</li>
                            @endguest
                            @auth
                            <li class="nav-item">
                                @if(str_ends_with(\Illuminate\Support\Facades\Auth::user()->email, '@admin.com'))
                                    <a class="nav-link login-button" href="/admin">Administration</a>
                                @else
                                    <a class="nav-link login-button" href="{{ route('dashboard') }}">Mon espace</a>
                                @endif
							</li>
                            @endauth
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>

@yield('content')

<!--============================
=            Footer            =
=============================-->

<!-- Footer Bottom -->
<footer class="footer-bottom">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="mb-3 text-center col-lg-6 text-lg-left mb-lg-0">
        <!-- Copyright -->
        <div class="copyright">
          <p>Copyright &copy; <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script>. Designed & Developed by <a class="text-white" href="https://kevinlerich.com">Kevin Lerich</a></p>
        </div>
      </div>
      <div class="col-lg-6">
        <!-- Social Icons -->
        <ul class="text-center social-media-icons text-lg-right">
          <li><a class="fa fa-facebook" href="https://www.facebook.com/themefisher"></a></li>
          <li><a class="fa fa-twitter" href="https://www.twitter.com/themefisher"></a></li>
          <li><a class="fa fa-pinterest-p" href="https://www.pinterest.com/themefisher"></a></li>
          <li><a class="fa fa-github-alt" href="https://www.github.com/themefisher"></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Container End -->
  <!-- To Top -->
  <div class="scroll-top-to">
    <i class="fa fa-angle-up"></i>
  </div>
</footer>

<!--
Essential Scripts
=====================================-->
@if (Request::is('/'))
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endif
<script src="{{ asset('plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap-slider.js') }}"></script>
<script src="{{ asset('plugins/tether/js/tether.min.js') }}"></script>
<script src="{{ asset('plugins/raty/jquery.raty-fa.js') }}"></script>
<script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
@yield('scripts')
<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
