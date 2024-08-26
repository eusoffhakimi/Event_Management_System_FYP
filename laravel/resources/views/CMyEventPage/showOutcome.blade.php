@extends('layouts.Clubmajor', ['page' => __('My Event'), 'pageSlug' => 'mevent'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                <h3 class="text-center text-white">Event Outcome</h3>
                    <div class="card px-5 py-5"> <!-- card-body -->
                        <div class="mb-4">
                            <label class="text-white">Event Title</label>
                            <div class="input-group border-bottom border-primary">
                                <P>{{$eventId->event_title}}</P>
                            </div>
                        </div>
                        <div class="form-group mb-4 border-bottom border-primary">
                            <label class="text-white">Event Description</label>
                            <P>{{$eventId->event_description}}</P> <!-- Assalamualaikum wbt, Salam Sejahtera, Salam UiTM Dihatiku. Sukacita dimaklumkan bahawa Club Netcentric akan mengadakan program Understanding Blockchain Ecosystem. Tujuan program ini adalah untuk membimbing dan memberi perkembangan tentang industri Blockchain. Untuk pembayaran, sila bayar diakaun tersebut, 151213250665 - Maybank Eusoff -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Applicable Course</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->course->course_code}}</p> <!-- Open -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Venue</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{$eventId->event_venue}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Capacity</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->event_capacity}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Price</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>@if($eventId->event_price)
                                        RM {{$eventId->event_price}}
                                        @else
                                            Free
                                        @endif</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Time</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{date('g.i A', strtotime($eventId->event_start_time))}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Time</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{date('g.i A', strtotime($eventId->event_end_time))}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Date</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{date('d F Y', strtotime($eventId->event_start_date))}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Date</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{date('d F Y', strtotime($eventId->event_end_date))}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Event Status</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->eventstatus->eventstatus_name}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Event Category</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{$eventId->eventcategory->eventcategory_name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Event Rating</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    @if($ratingExists)
                                        <P>{{number_format($meanRating, 2)}}</P>
                                    @else
                                        <P>Participant do not submit rating</P>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Event Verification Attendance Codes</label>
                                <div class="input-group border-bottom border-primary">
                                    <P>{{$eventId->event_verification_code}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn bg-gradient-dark w-100" href="{{route('CMyEventPage.index')}}">Back</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
