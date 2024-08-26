@extends('layouts.Studentmajor', ['page' => __('Join Event'), 'pageSlug' => 'jevent'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                <h3 class="text-center text-white">{{$eventId->event_title}}</h3> <!-- Cyber Security - Awareness Talk -->
                <form role="form" method="POST" action="{{route('SJoinEvent.storeParticipant', $eventId->id)}}" autocomplete="off"> <!-- id="contact-form" -->
                    @csrf
                    <div class="card px-5 py-5"> <!-- card-body -->
                        {{-- <div class="mb-4">
                            <label class="text-white">Event Organizer</label>
                            <div class="input-group border-bottom border-primary">
                                <P>{{$eventId->club->user->name}}</P> <!-- NETCENTRIC -->
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Event Organizer</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->club->user->name}}</p> <!-- CDCS251 -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Organizer Phone Number</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{$eventId->club->club_phone_number}}</p> <!-- Auditorium -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4 border-bottom border-primary">
                            <label class="text-white">Event Description</label>
                            <P>{{$eventId->event_description}}</P> <!-- Assalamualaikum wbt, Salam Sejahtera, Salam UiTM Dihatiku. Sukacita dimaklumkan bahawa Club Netcentric akan mengadakan program Cyber Security - Awareness Talk. Tujuan program ini adalah untuk membimbing dan memberi perkembangan tentang industri Cyber Security -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Applicable Course</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->course->course_code}}</p> <!-- CDCS251 -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Venue</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{$eventId->event_venue}}</p> <!-- Auditorium -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Capacity</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->event_capacity}}</p> <!-- 50 -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Price</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>@if($eventId->event_price)
                                            RM {{$eventId->event_price}}
                                        @else
                                            Free
                                        @endif</p> <!-- Free -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Time</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{date('g.i A', strtotime($eventId->event_start_time))}}</p> <!-- 10.00 AM -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Time</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{date('g.i A', strtotime($eventId->event_end_time))}}</p> <!-- 12.00 PM -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Date</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{date('d F Y', strtotime($eventId->event_start_date))}}</p> <!-- 13 March 2024 -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Date</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{date('d F Y', strtotime($eventId->event_end_date))}}</p> <!-- 13 March 2024 -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Event Status</label>
                                <div class="input-group mb-4 border-bottom border-primary">
                                    <p>{{$eventId->eventstatus->eventstatus_name}}</p> <!-- Open -->
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Event Category</label>
                                <div class="input-group border-bottom border-primary">
                                    <p>{{$eventId->eventcategory->eventcategory_name}}</p> <!-- Talk Event -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {{-- {{dd($eventId->event_payment == 1)}} --}}
                                @if ($eventId->participant->contains('student_id', auth()->user()->student->id))
                                    <a class="btn bg-gradient-dark w-100" href="{{route('SJoinEvent.index')}}">Back</a>
                                @else
                                    @if ($eventId->event_payment == 1)
                                        <button type="submit" class="btn btn-fill btn-primary bg-gradient-dark w-100">Register</button>
                                    @else
                                        <button type="button" class="btn bg-gradient-dark w-100" id="modalBtn">Register</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="POST" action="{{route('SJoinEvent.storeParticipant', $eventId->id)}}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    </div>
                    <div class="modal-body">
                        <img class="avatar" src="{{ asset('picture/qr/' . $eventId->event_qr) }}" alt=""> <!-- src="{{ asset('ForDesign/resources/assets/img/QR_Eusoff .PNG') }}" -->
                        <div class="ps-2">
                            <label>Please Submit the Receipt's Screenshot</label>
                            <div class="input-group">
                                <input type="file" name="payment_receipt" required>
                            </div>
                            @error('payment_receipt')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('exampleModal');

        // Get the button that opens the modal
        var btn = document.getElementById("modalBtn");

        // When the user clicks the button, open the modal
        btn.addEventListener("click", function() {
            modal.style.display = "block";
        });

        // When the user clicks on <span> (x), close the modal
        modal.querySelector(".btn-close").addEventListener("click", function() {
            modal.style.display = "none";
        });

        // When the user clicks anywhere outside of the modal, close it
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>
@endsection
