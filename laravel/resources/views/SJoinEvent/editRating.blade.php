@extends('layouts.Studentmajor', ['page' => __('Join Event'), 'pageSlug' => 'jevent'])

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
            {{ session('alert')['message'] }}
        </div>
    @endif
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                <h3 class="text-center text-white">{{$eventId->event_title}}</h3>
                <div class="card px-5 py-5"> <!-- card-body -->
                    <div class="mb-4">
                        <label class="text-white">Event Organizer</label>
                        <div class="input-group border-bottom border-primary">
                            <P>{{$eventId->club->user->name}}</P>
                        </div>
                    </div>
                    <div class="form-group mb-4 border-bottom border-primary">
                        <label class="text-white">Event Description</label>
                        <P>{{$eventId->event_description}}</P>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-white">Applicable Course</label>
                            <div class="input-group mb-4 border-bottom border-primary">
                                <p>{{$eventId->course->course_code}}</p>
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
                    @if($ratingExists)
                        <div class="mb-4">
                            <label class="text-white">Event Rating</label>
                            <div class="input-group border-bottom border-primary">
                                <P>{{$ratingValue}}/5</P>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn bg-gradient-dark w-100" href="{{route('SJoinEvent.index')}}">Back</a>
                            </div>
                        </div>
                    @else
                        <form role="form" method="POST" action="{{route('SJoinEvent.storeRating', $eventId->id)}}" autocomplete="off"> <!-- id="contact-form" -->
                            @csrf
                            <div class="mb-4">
                                <label class="text-white">Event Rating</label>
                                <div class="input-group">
                                    {{-- <input type="number" class="form-control" placeholder="" aria-label=""> --}}
                                    <select name="rating_event" class="form-control" required="required">
                                        <option value="">-- Choose Scale Rating --</option>
                                        <option value="1">1 - Poor</option>
                                        <option value="2">2 - Unsatisfactory</option>
                                        <option value="3">3 - Satisfactory</option>
                                        <option value="4">4 - Very Satisfactory</option>
                                        <option value="5">5 - Outstanding</option>
                                    </select>
                                    @error('rating_event')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-dark w-100">Submit Rating</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
