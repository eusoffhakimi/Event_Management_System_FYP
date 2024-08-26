@extends('layouts.Clubmajor', ['page' => __('My Event'), 'pageSlug' => 'mevent'])

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                <h3 class="text-center text-white">Create New Event</h3>
                <form role="form" method="POST" action="{{route('CMyEventPage.storeEvent')}}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card px-5 py-5"> <!-- card-body -->
                        <div class="mb-4">
                            <label class="text-white">Event Title</label>
                            <div class="input-group">
                                <input type="text" name="event_title" class="form-control" placeholder="" required="required">
                            </div>
                            @error('event_title')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-white">Event Description</label>
                            <textarea name="event_description" class="form-control" id="message" rows="4" required="required"></textarea>
                            @error('event_description')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="text-white">Event Poster</label>
                            <div class="input-group">
                                <input type="file" name="event_poster">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Applicable Course</label>
                                <div class="input-group mb-4">
                                    <select name="course_id" class="form-control" required="required">
                                        <option value="">-- Choose Course --</option>
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Venue</label>
                                <div class="input-group">
                                    <input type="text" name="event_venue" class="form-control" placeholder="" aria-label="" required="required">
                                </div>
                                @error('event_venue')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Capacity</label>
                                <div class="input-group mb-4">
                                    <input type="number" name="event_capacity" class="form-control" placeholder="" aria-label="" required="required">
                                </div>
                                @error('event_capacity')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Payment</label>
                                <div class="input-group mb-4">
                                    <div class="btn-group" role="group" aria-label="Payment Options">
                                        <button type="button" class="btn btn-sm" value="0" onclick="toggleButtonClass(this)">Paid</button>
                                        <button type="button" class="btn btn-sm" value="1" onclick="toggleButtonClass(this)">Free</button>
                                    </div>
                                    <div style="display: none;">
                                        <input type="hidden" name="event_payment" class="form-control">
                                    </div>
                                </div>
                                @error('event_payment')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="payment" style="display: none">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-white">Price</label>
                                    <div class="input-group mb-4">
                                        <input type="number" name="event_price" class="form-control" placeholder="" aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-2">
                                    <label class="text-white">QR Picture</label>
                                    <div class="input-group">
                                        <input type="file" name="event_qr">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Time</label>
                                <div class="input-group mb-4">
                                    <input type="time" name="event_start_time" class="form-control" value="" aria-label="" required="required">
                                </div>
                                @error('event_start_time')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Time</label>
                                <div class="input-group">
                                    <input type="time" name="event_end_time" class="form-control" value="" aria-label="" required="required">
                                </div>
                                @error('event_end_time')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Start Date</label>
                                <div class="input-group mb-4">
                                    <input type="date" name="event_start_date" class="form-control" placeholder="" aria-label="" required="required">
                                </div>
                                @error('event_start_date')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">End Date</label>
                                <div class="input-group">
                                    <input type="date" name="event_end_date" class="form-control" placeholder="" aria-label="" required="required">
                                </div>
                                @error('event_end_date')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="text-white">Event Status</label>
                                <div class="input-group mb-4">
                                    <select name="eventstatus_id" class="form-control" required="required">
                                        <option value="">-- Choose Status --</option>
                                        @foreach($eventstatus as $eventstatus)
                                            <option value="{{$eventstatus->id}}">{{$eventstatus->eventstatus_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('eventstatus_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label class="text-white">Event Category</label>
                                <div class="input-group">
                                    <select name="eventcategory_id" class="form-control" required="required">
                                        <option value="">-- Choose Category --</option>
                                        @foreach($eventcategories as $eventcategory)
                                            <option value="{{$eventcategory->id}}">{{$eventcategory->eventcategory_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('eventcategory_id')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-gradient-dark w-100">Create Event</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentButtons = document.querySelectorAll('.btn-group button');
            const paymentContent = document.querySelector('.payment');
            const hiddenInput = document.querySelector('input[name="event_payment"]');
            const paymentInputs = paymentContent.querySelectorAll('input[type="number"], input[type="file"]');
            const qrInput = document.querySelector('input[name="event_qr"]');

            paymentButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const value = button.value;
                    // const inputs = paymentContent.querySelectorAll('input[type="number"], input[type="file"]');
                    if (value === '1') {
                        paymentContent.style.display = 'none';
                        paymentInputs.forEach(function(input) {
                            input.removeAttribute('required');
                            input.value = null;
                        });
                        hiddenInput.value = 1;
                        if (qrInput.value !== '') { // If a file is uploaded for QR
                            qrInput.value = ''; // Clear QR input value
                        }
                    } else {
                        paymentContent.style.display = 'block';
                        paymentInputs.forEach(function(input) {
                            input.setAttribute('required', 'required');
                        });
                        hiddenInput.value = 0;
                    }
                });
            });
        });
    </script>
    <script>
        function toggleButtonClass(button) {
            // Remove the 'btn-primary' class from all buttons
            document.querySelectorAll('.btn-group button').forEach(function(btn) {
                btn.classList.remove('btn-primary');
            });

            // Add 'btn-primary' class to the clicked button
            button.classList.add('btn-primary');
        }
    </script>
@endsection
