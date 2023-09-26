@extends('layouts.front')
@section('title')
    Annonces
@endsection
@section('content')

@include('layouts.search_annonce')
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="product-grid-list">
                    <div class="row mt-30">
                        @foreach($annonces as $annonce)
                            <div class="col-lg-4 col-md-6">
                                <!-- product card -->
                                <div class="product-item bg-light">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="{{ route('detail_annonce', $annonce->slug) }}">{{ $annonce->titre }}</a></h4>
                                            <ul class="list-inline product-meta">
                                                <li class="list-inline-item">
                                                    <a href="{{ route('category_annonce', $annonce->category->slug) }}"><i class="fa fa-folder-open-o"></i>{{ $annonce->category->nom }}</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ route('category_annonce', $annonce->category->slug) }}"><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($annonce->date_announce)->format('d-m-Y') }}</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ route('category_annonce', $annonce->category->slug) }}"><i class="fa fa-location-arrow"></i>{{ $annonce->ville->nom }}</a>
                                                </li>
                                            </ul>
                                            <p class="card-text">{!! Str::substr($annonce->description,0,10) !!}</p>

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
