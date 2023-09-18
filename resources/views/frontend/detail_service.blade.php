@extends('layouts.front')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('title')
    Detail service
@endsection

@section('content')


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
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Categorie<a href="{{ route('category_service', $service->category->slug) }}">{{ $service?->category->nom }}</a></li>
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Lieu<a href="{{ route('category_service', $service->category->slug) }}">{{ $service?->ville->nom }}</a></li>
						</ul>
					</div>

					<!-- product slider -->
					<div class="product-slider">
                        @if (isset($portfolio->photos))
                            @foreach ($portfolio->photos as $photo)
                                <div class="my-4 product-slider-item" data-image="{{ asset('storage/portfolios/'.$photo?->chemin_photo) }}">
                                    <img class="img-fluid w-100" src="{{ asset('storage/portfolios/'.$photo?->chemin_photo) }}" alt="portfolio">
                                </div>
                            @endforeach
                        @else
                            <div class="my-4 product-slider-item" data-image="{{ asset('storage/'.$service?->image_service) }}">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$service?->image_service) }}" alt="service">
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
						<h2>Lieux de travail préférés</h2>
                         @auth
                             @foreach($lieux as $lieu)
                                 <p>{{ $lieu->province?->nom }}</p>
                             @endforeach
                         @endauth
					</div>
					<!-- User Profile widget -->
					<div class="text-center widget user">
						<h4><a href="#">{{ $service->user->name }}</a></h4>
						<p class="member-time">Membre {{ $service->user->created_at->diffForHumans() }}</p>
						<p class="member-time">
                            @auth
                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('client'))
                                    @if(count($favoris)>0)
                                        <a class="btn btn-danger btn-sm" onclick="event.preventDefault();
                                                document.getElementById('del-category-{{ $favoris[0] }}').submit();">
                                            Retirer des favoris
                                        </a>
                                        <form action="{{route('retirer_favoris', $favoris[0])}}" method="POST" id="del-category-{{$favoris[0]}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                    <a href="{{ route('ajouter_favoris', $service->user_id) }}" class="btn btn-success btn-sm">Ajouter aux favoris</a>
                                    @endif
                                @endif
                            @endauth
                        </p>
					</div>
                    <div class="widget disclaimer">
                        @auth
                            @if ($service->user_id != Auth::user()->id)
                                @auth
                                <h5 class="widget-header">Laisser un message</h5>
                                    <form action="{{ route('contact_service') }}" method="post">
                                        @csrf
                                        <!-- Message -->
                                        <div class="form-group mb-30">
                                            <input type="hidden" name="to_id" value="{{ $service->user->id }}">
                                            <label for="message">Message</label>
                                            <textarea id="message" class="form-control" name="message" rows="8" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-transparent">Laisser mon message</button>
                                    </form>
                                @endauth

                            @endif
                        @endauth
                    </div>
                    @guest
                        <h4>Connectez-vous pour contacter ce photographe</h4>
                    @endguest
				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
@endsection

@section('scripts')
<script type="text/javascript">


        /*------------------------------------------
        --------------------------------------------
        Toastr Success Code
        --------------------------------------------
        --------------------------------------------*/
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

    </script>
@endsection
