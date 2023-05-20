@extends('layouts.front')
@section('title')
    Detail annonce
@endsection

@section('content')
@include('layouts.search')

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
				@auth
                @if ($annonce->user_id != Auth::user()->id)
                <div class="block comment">
					@auth
                    <h4>Laisser un message</h4>
					<form action="{{ route('contact_annonce') }}" method="post">
                        @csrf
						<!-- Message -->
						<div class="form-group mb-30">
                            <input type="hidden" name="destinataire_id" value="{{ $annonce->user->id }}">
                            <input type="hidden" name="objet" value="{{ $annonce->id }}">
							<label for="message">Message</label>
							<textarea class="form-control" name="message" id="message" rows="8" required></textarea>
						</div>
						<button type="submit" class="btn btn-transparent">Laisser mon message</button>
					</form>
                    @endauth

				</div>
                @endif
                @endauth
                @guest
                        <h4>Connectez-vous pour contacter cet annonceur</h4>
                    @endguest
			</div>
		</div>
	</div>
</section>

@endsection
