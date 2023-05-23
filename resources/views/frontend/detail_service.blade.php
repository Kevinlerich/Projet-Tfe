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
						{{--<h4>Price</h4>
						<p>$230</p> --}}
					</div>
					<!-- User Profile widget -->
					<div class="text-center widget user">
						<h4><a href="user-profile.html">{{ $service->user->name }}</a></h4>
						<p class="member-time">Membre {{ $service->user->created_at->diffForHumans() }}</p>
						{{-- <ul class="mt-20 list-inline">
                            @auth
                            @if ($service->user_id != auth()->user()->id)
                            <li class="list-inline-item"><a href="{{ route('contact_service', $service->id) }}" class="my-1 btn btn-contact d-inline-block btn-primary px-lg-5 px-md-3">Contact</a></li>
                            @endif
                            @endauth
                            @guest
                            <li class="list-inline-item">Connectez-vous pour contacter</li>
                            @endguest
						</ul> --}}
					</div>
                    <div class="widget disclaimer">
						<h5 class="widget-header">Prise de rendez-vous</h5>
						@auth
                        @if ($service->user_id != auth()->user()->id)
                        <div class="form-group">
                            <label for="date_appointment">Date de rendez vous</label>
                            <input id="date_appointment" type="date" min="<?php echo date("Y-m-d"); ?>" name="date_appointment"
                                   onchange="dateChange(this.value)" class="form-control">
                        </div>

                        <div id="schedule"></div>
                        <div class="form-group">
                            <div id="button_submit"></div>
                        </div>
                        @else

                        @endif
                        @endauth
                        @guest
                            Connectez-vous pour prendre rendez-vous.
                        @endguest
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
                                    <input type="hidden" name="destinataire_id" value="{{ $service->user->id }}">
                                    <input type="hidden" name="objet" value="{{ $service->id }}">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" name="contenu" id="contenu" rows="8" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-transparent">Laisser mon message</button>
                            </form>
                        @endauth

                    @endif
                        @endauth
                    </div>
                    @guest
                    <h4>Connectez-vous pour contacter cet annonceur</h4>
                @endguest
				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    function dateChange(date_appointment) {
        //$("#loading").show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{route('available.schedule')}}",
            data: {date: date_appointment},
            success: function (data) {
                $('#schedule').html('')
                if (data.length !== 0) {
                    let html1 = '<div class="form-group">' +
                        '<label for="schedule">Plage Horaire</label>' +
                        '<select name="schedule_id" id="schedule" class="form-control">'

                    let html2 = ''
                    data.forEach(function (current) {
                        console.log(html2)
                        html2 = html2 + '<option value="' + current.id + '">' + current.start + ' - ' + current.end + '</option>'
                    })

                    let html3 = '</select> </div>'
                    let html4 = '<button id="takeRdv" type="submit" class="form-control btn btn-primary">Prendre le rendez vous</button>'

                    $('#schedule').html('' + html1 + html2 + html3)
                    $("#button_submit").html(html4)
                } else {
                    alert("Pas de plage Horaire disponible à cette date")
                    $('#statut_select').val("RDV à planifier").change()
                }

                $("#loading").hide();

            }
        });
    }
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
    $("#date_appointment").on('change', dateChange);
    $("#button_submit").on('click', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var date_appointment = $("#date_appointment").val();
        var schedule = $("#schedule_id").val();
        var photographe_id = {{$service->user->id}};
        var service_id = {{ $service->id }};
        $.ajax({
            type: "POST",
            url: "{{route('store_rdv')}}",
            data: {
                date_appointment: date_appointment,
                schedule: schedule,
                photographe_id: photographe_id,
                service_id: service_id
            },
            success: function (data) {
                displayMessage('Rendez-vous pris avec succès');
            }
        });
    })
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar').fullCalendar({
                    editable: false,
                    events: {!! $disponibilities !!},
                    displayEventTime: false,
                    editable: false,
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
                        if(allDay.isBefore(moment())){
                            $("#calendar").fullCalendar('unselect');
                            return false;
                        }
                        var message = prompt('Votre message:');
                        if (message) {
                            var photographe_id = {{$service->user->id}};
                            var service_id = {{ $service->id }};
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
                            /*if(event.isBefore(moment())){
                                $("#calendar").fullCalendar('unselect');
                            } else {*/
                                var message = prompt('Votre message:');
                            if (message) {
                                var photographe_id = {{$service->user->id}};
                                var service_id = {{ $service->id }};
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
                                                event: event
                                            },true);

                                        calendar.fullCalendar('unselect');
                                    }
                                });
                            }
                        }
                        /* calendar.fullCalendar('unselect');
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
                        } */
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
@endsection
