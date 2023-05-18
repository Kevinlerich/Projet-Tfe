@extends('layouts.front')
@section('title')
    Annonces
@endsection
@section('content')

@include('layouts.search')

<section class="section-sm">
	<div class="container">
		<div class="row">

			<div class="col-lg-9 col-md-8">
				<!-- ad listing list  -->
                @foreach($annonces as $annonce)
				<div class="mt-20 ad-listing-list">
                    <div class="p-4 row p-lg-3 p-sm-5">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-md-10">
                                    <div class="ad-listing-content">
                                        <div>
                                            <a href="{{ route('detail_annonce', $annonce->slug) }}" class="font-weight-bold">{{ $annonce->titre }}</a>
                                        </div>
                                        <ul class="mt-2 mb-3 list-inline">
                                            <li class="list-inline-item"><a href="{{ route('category_annonce', $annonce->category->slug) }}"> <i class="fa fa-folder-open-o"></i> {{ $annonce->category->titre }}</a></li>
                                            <li class="list-inline-item"><a href="{{ route('category_annonce', $annonce->category->slug) }}"><i class="fa fa-calendar"></i>{{ $annonce->created_at->diffForHumans() }}</a></li>
                                        </ul>
                                        <p class="pr-5">
                                            {!! Str::substr($annonce->description,0,10) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
			</div>
		</div>
	</div>
</section>

@endsection
