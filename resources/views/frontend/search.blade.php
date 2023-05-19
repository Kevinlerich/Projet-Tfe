@extends('layouts.front')
@section('title')
    Services
@endsection
@section('content')
@include('layouts.search')

<section class="section-sm">
	<div class="container">
		<div class="row">
			{{-- <div class="col-lg-3 col-md-4">
				<div class="category-sidebar">
					<div class="widget category-list">
                        <h4 class="widget-header">Toutes les Categories</h4>
                        <ul class="category-list">
                            @foreach ($categories as $category)
                                <li><a href="category.html">{{ $category->nom }} <span>{{ $category->services->count() }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="widget category-list">
                        <h4 class="widget-header">Villes</h4>
                        <ul class="category-list">
                            @foreach($villes as $ville)
                                <li><a href="category.html">{{ $ville->nom }} <span>{{ $ville->services->count() }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>

				</div>
			</div> --}}
			<div class="col-lg-9 col-md-8">
{{-- 				<div class="category-search-filter">
					<div class="row">
						<div class="text-center col-md-6 text-md-left">
							<strong>Short</strong>
							<select>
								<option>Most Recent</option>
								<option value="1">Most Popular</option>
								<option value="2">Lowest Price</option>
								<option value="4">Highest Price</option>
							</select>
						</div>
					</div>
				</div> --}}
				<div class="product-grid-list">
					<div class="row mt-30">
                        @foreach($services as $service)
						<div class="col-lg-4 col-md-6">
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
                                                <a href="{{ route('category_service', $service->category->slug) }}"><i class="fa fa-folder-open-o"></i>{{ $service->category->nom }}</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ route('category_service', $service->category->slug) }}"><i class="fa fa-calendar"></i>{{ $service->created_at->diffForHumans() }}</a>
                                            </li>
                                        </ul>
                                        <p class="card-text">{!! Str::substr($service->description,0,10) !!}</p>

                                    </div>
                                </div>
                            </div>
						</div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
@endsection
