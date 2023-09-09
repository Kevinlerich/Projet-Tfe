@extends('layouts.front')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
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
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Categorie<a href="{{ route('category_service', $service->category->slug) }}">{{ $service->category->nom }}</a></li>
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Lieu<a href="{{ route('category_service', $service->category->slug) }}">{{ $service->ville->nom }}</a></li>
						</ul>
					</div>

					<!-- product slider -->
					<div class="product-slider">
                        @if ($portfolio?->photos != null)
                            @foreach ($portfolio?->photos as $photo)
                                <div class="my-4 product-slider-item" data-image="{{ asset('storage/portfolios/'.$photo->chemin_photo) }}">
                                    <img class="img-fluid w-100" src="{{ asset('storage/portfolios/'.$photo->chemin_photo) }}" alt="product-img">
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

{{--@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
                        editable: true,
                        events: {!! $disponibilities !!},
                        displayEventTime: false,
                        editable: true,
                        eventRender: function (event, element, view) {
                            if (event.allDay === 'true') {
                                    event.allDay = true;
                            } else {
                                    event.allDay = false;
                            }
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            var message = prompt('Votre message:');
                            if (message) {
                                var photographe_id = {{$service->user->id}};
                                var service_id = {{$service->id}};
                                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                $.ajax({
                                    url: SITEURL + "/fullcalenderAjax",
                                    data: {
                                        photographe_id: photographe_id,
                                        service_id: service_id,
                                        message: message,
                                        start: start,
                                        end: end,
                                        type: 'add'
                                    },
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("Rendez-vous créer avec succès !!!");

                                        calendar.fullCalendar('renderEvent',
                                            {
                                                id: data.id,
                                                start: start,
                                                end: end,
                                                allDay: allDay
                                            },true);

                                        calendar.fullCalendar('unselect');
                                    }
                                });
                            }
                        },
                        eventDrop: function (event, delta) {
                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                            $.ajax({
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                    photographe_id: photographe_id,
                                    service_id: service_id,
                                    message: message,
                                    start: start,
                                    end: end,
                                    id: event.id,
                                    type: 'update'
                                },
                                type: "POST",
                                success: function (response) {
                                    displayMessage("Rendez vous mis à jour avec succès");
                                }
                            });
                        },
                        eventClick: function (event) {
                            var deleteMsg = confirm("Voulez-vous vraiment supprimé ce rendez-vous?");
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: SITEURL + '/fullcalenderAjax',
                                    data: {
                                            id: event.id,
                                            type: 'delete'
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('removeEvents', event.id);
                                        displayMessage("Rendez vous supprimé avec succès");
                                    }
                                });
                            }
                        }

                    });

        });

        /*------------------------------------------
        --------------------------------------------
        Toastr Success Code
        --------------------------------------------
        --------------------------------------------*/
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

    </script>
@endsection--}}
