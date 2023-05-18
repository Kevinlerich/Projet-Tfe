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
						@foreach ($portfolio->photos as $photo)
                            <div class="my-4 product-slider-item" data-image="images/products/products-1.jpg">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$photo->chemin_photo) }}" alt="product-img">
                            </div>
                        @endforeach
					</div>
					<!-- product slider -->

					<div class="pt-5 mt-5 content">
						<ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
								 aria-selected="true">Detail du service</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
								 aria-selected="false">Specifications</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Product Description</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia laudantium beatae quod perspiciatis, neque
									dolores eos rerum, ipsa iste cum culpa numquam amet provident eveniet pariatur, sunt repellendus quas
									voluptate dolor cumque autem molestias. Ab quod quaerat molestias culpa eius, perferendis facere vitae commodi
									maxime qui numquam ex voluptatem voluptate, fuga sequi, quasi! Accusantium eligendi vitae unde iure officia
									amet molestiae velit assumenda, quidem beatae explicabo dolore laboriosam mollitia quod eos, eaque voluptas
									enim fuga laborum, error provident labore nesciunt ad. Libero reiciendis necessitatibus voluptates ab
									excepturi rem non, nostrum aut aperiam? Itaque, aut. Quas nulla perferendis neque eveniet ullam?</p>


								<p></p>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam sed, officia reiciendis necessitatibus
									obcaecati eum, quaerat unde illo suscipit placeat nihil voluptatibus ipsa omnis repudiandae, excepturi! Id
									aperiam eius perferendis cupiditate exercitationem, mollitia numquam fuga, inventore quam eaque cumque fugiat,
									neque repudiandae dolore qui itaque iste asperiores ullam ut eum illum aliquam dignissimos similique! Aperiam
									aut temporibus optio nulla numquam molestias eum officia maiores aliquid laborum et officiis pariatur,
									delectus sapiente molestiae sit accusantium a libero, eligendi vero eius laboriosam minus. Nemo quibusdam
									nesciunt doloribus repellendus expedita necessitatibus velit vero?</p>

							</div>
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">Product Specifications</h3>
								<table class="table table-bordered product-table">
									<tbody>
										<tr>
											<td>Seller Price</td>
											<td>$450</td>
										</tr>
										<tr>
											<td>Added</td>
											<td>26th December</td>
										</tr>
										<tr>
											<td>State</td>
											<td>Dhaka</td>
										</tr>
										<tr>
											<td>Brand</td>
											<td>Apple</td>
										</tr>
										<tr>
											<td>Condition</td>
											<td>Used</td>
										</tr>
										<tr>
											<td>Model</td>
											<td>2017</td>
										</tr>
										<tr>
											<td>State</td>
											<td>Dhaka</td>
										</tr>
										<tr>
											<td>Battery Life</td>
											<td>23</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
					<div class="text-center widget price">
						<h4>Price</h4>
						<p>$230</p>
					</div>
					<!-- User Profile widget -->
					<div class="text-center widget user">
						<img class="px-5 mb-5 rounded-circle img-fluid" src="images/user/user-thumb.jpg" alt="">
						<h4><a href="user-profile.html">Jonathon Andrew</a></h4>
						<p class="member-time">Member Since Jun 27, 2017</p>
						<a href="single.html">See all ads</a>
						<ul class="mt-20 list-inline">
							<li class="list-inline-item"><a href="contact-us.html" class="my-1 btn btn-contact d-inline-block btn-primary px-lg-5 px-md-3">Contact</a></li>
							<li class="list-inline-item"><a href="single.html" class="my-1 btn btn-offer d-inline-block btn-primary ml-n1 px-lg-4 px-md-3">Make an
									offer</a></li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
@endsection
