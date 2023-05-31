@extends('layouts.front')
@section('title')
    Detail annonce
@endsection

@section('content')

<section class="blog single-blog section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<article class="single-post">
					<h2>{{ $annonce->titre }}</h2>
					<ul class="list-inline">
						<li class="list-inline-item">par <a href="#">{{ $annonce->user->name }}</a></li>
						<li class="list-inline-item">{{ $annonce->created_at->diffForHumans() }}</li>
					</ul>
					<p>{!! $annonce->description !!}</p>

					<ul class="social-circle-icons list-inline">
						<li class="text-center list-inline-item"><a class="fa fa-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('detail_annonce', $annonce->slug) }}"></a></li>
						<li class="text-center list-inline-item"><a class="fa fa-twitter" target="_blank" href="https://twitter.com/share?url={{ route('detail_annonce', $annonce->slug) }}"></a></li>
						<li class="text-center list-inline-item"><a class="fa fa-linkedin" target="_blank" href="https://www.linkedin.com/share?url={{ route('detail_annonce', $annonce->slug) }}"></a></li>
					</ul>
				</article>

			</div>
		</div>
	</div>
</section>

@endsection
