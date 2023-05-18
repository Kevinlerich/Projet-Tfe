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
								<a class="nav-link" href="/">Services</a>
							</li>
                            <li class="nav-item {{ Request::is('annonces') ? 'active' : '' }}">
								<a class="nav-link" href="/">Annonces</a>
							</li>

						</ul>
						<ul class="mt-10 ml-auto navbar-nav">
							<li class="nav-item">
								<a class="nav-link login-button" href="{{ route('login') }}">Connexion</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>

<!--===============================
=            Hero Area            =
================================-->

<section class="text-center hero-area bg-1 overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Découvrez nos professionnels près de chez vous 📍 </h1>
					<p>Trouvez facilement des photographes pour votre prochain shooting.</p>
					<div class="text-center short-popular-category-list">
						<h2>Catégories les plus populaires</h2>
						<ul class="list-inline">
                            @foreach ($categories as $category)
                            <li class="list-inline-item">
								<a href="{{ route('category_service', $category->slug) }}"><i class="fa fa-bed"></i> {{ $category->nom }}</a>
                            </li>
                            @endforeach
						</ul>
					</div>

				</div>
				<!-- Advance Search -->
				<div class="advance-search">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12 align-content-center">
								<form method="get" action="{{ route('search') }}">
                                    @csrf
									<div class="form-row">
										<div class="form-group col-xl-4 col-lg-3 col-md-6">
											<input name="text" type="text" class="my-2 form-control my-lg-1" id="inputtext4"
												placeholder="What are you looking for">
										</div>
										<div class="form-group col-lg-3 col-md-6">
											<select name="category_id" class="w-100 form-control mt-lg-1 mt-md-2">
												<option>Categories</option>
												@foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->nom }}</option>
                                                @endforeach
											</select>
										</div>
										<div class="form-group col-lg-3 col-md-6">
                                            <select name="ville_id" class="w-100 form-control mt-lg-1 mt-md-2">
												<option>Villes</option>
												@foreach ($villes as $ville)
                                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                                @endforeach
											</select>										</div>
										<div class="form-group col-xl-2 col-lg-3 col-md-6 align-self-center">
											<button type="submit" class="btn btn-primary active w-100">Rechercher</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Les services disponibles</h2>
					<p>Les services disponibles</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- offer 01 -->
			<div class="col-lg-12">
				<div class="trending-ads-slide">
					@foreach ($services as $service)
                    <div class="col-sm-12 col-lg-4">
						<!-- product card -->
                        <div class="product-item bg-light">
                            <div class="card">
                                <div class="thumb-content">
                                    <!-- <div class="price">$200</div> -->
                                    <a href="{{ route('detail_service', $service->slug) }}">
                                        <img class="card-img-top img-fluid" src="{{ asset('storage/'.$service->image_service) }}" alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{ route('detail_service', $service->slug) }}">{{ $service->nom }}</a></h4>
                                    <ul class="list-inline product-meta">
                                        <li class="list-inline-item">
                                            <a href="{{ route('category_service', $service->category->slug) }}"><i class="fa fa-folder-open-o"></i>
                                                {{ $service->category->nom }}
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="category.html"><i class="fa fa-calendar"></i>{{ $service->created_at->diffForHumans() }}</a>
                                        </li>
                                    </ul>
                                    <p class="card-text">
                                        {!! $service->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</section>


<!--====================================
=            Call to Action            =
=====================================-->

<section class="call-to-action overly bg-3 section-sm">
	<!-- Container Start -->
	<div class="container">
		<div class="text-center row justify-content-md-center">
			<div class="col-md-8">
				<div class="content-holder">
					<h2>Commencez dès aujourd'hui à vous faire connaître et à développer votre activité</h2>
					<ul class="list-inline mt-30">
						<li class="list-inline-item"><a class="btn btn-main" href="{{ route('create_annonce') }}">Ajouter une annonce</a></li>
						<li class="list-inline-item"><a class="btn btn-secondary" href="{{ route('services') }}">Parcourir les services</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap-slider.js') }}"></script>
<script src="{{ asset('plugins/tether/js/tether.min.js') }}"></script>
<script src="{{ asset('plugins/raty/jquery.raty-fa.js') }}"></script>
<script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
