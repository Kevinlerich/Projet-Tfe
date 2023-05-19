@extends('layouts.front')
@section('title')
    Accueil
@endsection

@section('content')
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
										{{-- <div class="form-group col-xl-4 col-lg-3 col-md-6">
											<input name="text" disabled type="text" class="my-2 form-control my-lg-1" id="inputtext4"
												placeholder="Que recherchez-vous ?">
										</div> --}}
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
                                            <a href="#"><i class="fa fa-calendar"></i>{{ $service->created_at->diffForHumans() }}</a>
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
                        @auth
                            @if(Auth::user()->hasRole('client'))
                            <li class="list-inline-item"><a class="btn btn-main" href="{{ route('create_annonce') }}">Ajouter une annonce</a></li>
                            @else
                            <li class="list-inline-item"><a class="btn btn-main" href="{{ route('create_service') }}">Ajouter un service</a></li>
                            @endif
                        @endauth
                        @guest
                        <li class="list-inline-item"><a class="btn btn-main" href="{{ route('create_annonce') }}">Ajouter une annonce</a></li>
                        @endguest
						<li class="list-inline-item"><a class="btn btn-secondary" href="{{ route('services') }}">Parcourir les services</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
@endsection
