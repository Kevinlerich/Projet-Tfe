@extends('layouts.front')

@section('title')
    Detail service
@endsection

@section('content')

@include('layouts.search')

<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-lg-8">
				<div class="product-details">
					<h1 class="product-title">{{ $service->nom }}</h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> Par <a href="#">{{ $service->user->name }}</a></li>
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Categorie<a href="{{ route('category_service', $service->category->slug) }}">{{ $service->category->nom }}</a></li>
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Lieu<a href="{{ route('category_service', $service->category->slug) }}">{{ $service->ville->nom }}</a></li>
						</ul>
					</div>

					<!-- product slider -->
					<div class="product-slider">
                        @if ($portfolio?->photos != null)
                            @foreach ($portfolio?->photos as $photo)
                                <div class="my-4 product-slider-item" data-image="{{ asset('storage/'.$photo->chemin_photo) }}">
                                    <img class="img-fluid w-100" src="{{ asset('storage/'.$photo->chemin_photo) }}" alt="product-img">
                                </div>
                            @endforeach
                        @else
                            <div class="my-4 product-slider-item" data-image="{{ asset('storage/'.$service->image_service) }}">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$service->image_service) }}" alt="product-img">
                            </div>
                        @endif
					</div>
					<!-- product slider -->

					<div class="pt-5 mt-5 content">
						<ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">Detail du service</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Description</h3>
								<p>{!! $service->description !!} <p>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
					 <div class="text-center widget price">
						{{--<h4>Price</h4>
						<p>$230</p> --}}
					</div>
					<!-- User Profile widget -->
					<div class="text-center widget user">
						<h4><a href="user-profile.html">{{ $service->user->name }}</a></h4>
						<p class="member-time">Membre depuis {{ $service->user->created_at->diffForHumans() }}</p>
						<ul class="mt-20 list-inline">
							<li class="list-inline-item"><a href="{{ route('contact_service', $service->id) }}" class="my-1 btn btn-contact d-inline-block btn-primary px-lg-5 px-md-3">Contact</a></li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
@endsection
