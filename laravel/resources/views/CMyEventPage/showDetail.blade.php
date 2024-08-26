@extends('layouts.Clubmajor', ['page' => __('My Event'), 'pageSlug' => 'mevent'])

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
            {{ session('alert')['message'] }}
        </div>
    @endif
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                {{-- {{dd($eventId)}} --}}
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
                        @if($eventId->club_id == auth()->user()->club->id)
                            <div class="mb-4">
                                <label class="text-white">Event Verification Attendance Codes</label>
                                <div class="input-group border-bottom border-primary">
                                    <P>{{$eventId->event_verification_code}}</P>
                                </div>
                            </div>
                        @endif
                        @php
                            $eventStartDateTime = \Carbon\Carbon::parse($eventId->event_start_date . ' ' . $eventId->event_start_time);
                        @endphp
                        @if($eventId->club_id == auth()->user()->club->id && $eventStartDateTime >= $currentDateTime)
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn bg-gradient-dark w-100" href="{{route('CMyEventPage.index')}}">Back</a> <!-- <button type="submit" class="btn bg-gradient-dark w-100">Back</button> -->
                                </div>
                                <div class="col-md-6">
                                    <form role="form" method="POST" action="{{route('CMyEventPage.blastEvent', $eventId->id)}}" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn bg-gradient-dark w-100">Blast</button> <!-- <button type="submit" class="btn bg-gradient-dark w-100">Back</button> -->
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn bg-gradient-dark w-100" href="{{route('CMyEventPage.index')}}">Back</a> <!-- <button type="submit" class="btn bg-gradient-dark w-100">Back</button> -->
                                </div>
                            </div>
                        @endif
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <a class="btn bg-gradient-dark w-100" href="{{route('CMyEventPage.index')}}">Back</a> <!-- <button type="submit" class="btn bg-gradient-dark w-100">Back</button> -->
                            </div>
                            <div class="col-md-6">
                                <form role="form" method="POST" action="{{route('CMyEventPage.blastEvent', $eventId->id)}}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-dark w-100">Blast</button> <!-- <button type="submit" class="btn bg-gradient-dark w-100">Back</button> -->
                                </form>
                            </div>
                        </div> --}}
                    </div>
            </div>
        </div>
    </div>
@endsection
