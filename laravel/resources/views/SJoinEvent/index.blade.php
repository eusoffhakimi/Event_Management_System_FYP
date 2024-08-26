@extends('layouts.Studentmajor', ['page' => __('Join Event'), 'pageSlug' => 'jevent'])

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
            {{ session('alert')['message'] }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 mb-3">
            <div class="btn-group btn-group-toggle float-left" role="group" data-toggle="buttons">
                <button type="button" class="btn btn-sm btn-primary btn-simple " id="0" value="0" onclick="toggleEventType(this)">
                    Join Event
                </button>
                <button type="button" class="btn btn-sm btn-primary btn-simple" id="2" value="2" onclick="toggleEventType(this)">
                    Preferred Event
                </button>
                <button type="button" class="btn btn-sm btn-primary btn-simple active" id="1" value="1" onclick="toggleEventType(this)">
                    All Event
                </button>
            </div>
            <div class="btn-group btn-group-toggle float-right" role="group" data-toggle="buttons">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a id="sortToggle" class="btn-sm btn-icon-only text-light dropdown-toggle" href="#" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-chevron-up" id="sortIcon"></i> <span id="sortText">Ascending</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="eventsContainer">
        @foreach($events as $event)
            @php
                $isParticipant = $event->participant->contains('student_id', auth()->user()->student->id);
                $isPreferredCategory = $event->eventcategory_id === auth()->user()->student->eventcategory_id;
            @endphp
            <div class="row event-row" data-registered-event="{{ $isParticipant ? 'true' : 'false' }}" data-event-date="{{ $event->event_start_date }}" data-event-time="{{ $event->event_start_time }}" data-event-category="{{ $isPreferredCategory ? 'true' : 'false' }}">
                <div class="col-12">
                    <div class="card">
                        <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                            <div class="card-header border-bottom pb-0">
                                <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                                    <div class>
                                        <h3 class="font-weight-semibold text-white mb-0">{{$event->event_title}}</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                        <p class="text-sm">{{date('d F Y', strtotime($event->event_start_date))}}</p>
                                    </div>
                                </div>
                                <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                                    <div class>
                                        <h3 class="font-weight-semibold text-white mb-0">{{$event->club->user->name}}</h3>
                                    </div>
                                </div>
                            </div>
                            @php
                                $eventStartDateTime = \Carbon\Carbon::parse($event->event_start_date . ' ' . $event->event_start_time);
                            @endphp
                            <div class="card-body px-0 py-0">
                                {{-- @if ($event->participant->isNotEmpty() && $event->participant->first()->event->id == auth()->user()->student->participant->event->id) --}}
                                @if ($event->participant->contains('student_id', auth()->user()->student->id))
                                    <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <a class="btn btn-success text-white px-3 mb-0" href="{{ route('SJoinEvent.showDetail', $event->id) }}">Details</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable1">Details</label> -->
                                            @if($eventStartDateTime <= $currentDateTime)
                                                <button class="btn btn-warning text-white px-3 mb-0 modalBtn" data-event-id="{{ $event->id }}">Rating</button> <!-- href="{{ route('SJoinEvent.editRating', $event->id) }}" --> <!-- <a class="btn btn-warning text-white px-3 mb-0" id="modalBtn" href="#">Rating</a> -->
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    @if ($eventStartDateTime >= $currentDateTime)
                                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <a class="btn btn-success text-white px-3 mb-0" href="{{ route('SJoinEvent.showDetail', $event->id) }}">Details</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable1">Details</label> -->
                                                <a class="btn btn-info text-white px-3 mb-0" href="{{ route('SJoinEvent.showDetail', $event->id) }}">Register</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Register</label> -->
                                            </div>
                                        </div>
                                    {{-- @else
                                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <a class="btn btn-success text-white px-3 mb-0" href="{{ route('SJoinEvent.showDetail', $event->id) }}">Details</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Details</label> -->
                                                <a class="btn btn-warning text-white px-3 mb-0" href="{{ route('SJoinEvent.editRating') }}">Rating</a> <!-- <label class="btn btn-danger text-white px-3 mb-0" for="btnradiotable2">Rating</label> -->
                                            </div>
                                        </div> --}}
                                    @endif
                                @endif
                                <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                    <div class>
                                        <h4 class="font-weight-semibold text-white mt-4">Status: {{$event->eventstatus->eventstatus_name}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Attendance Verification Code</h5>
                </div>
                <form method="post" action="{{ route('SJoinEvent.verifyEventCode') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id">
                    <div class="modal-body">
                        {{-- <div class="input-group">
                            <input style="color: black" type="number" name="code" class="form-control" placeholder="" required="required">
                        </div> --}}
                        <div class="verification-code">
                            <input type="text" name="code[]" maxlength="1" required>
                            <input type="text" name="code[]" maxlength="1" required>
                            <input type="text" name="code[]" maxlength="1" required>
                            <input type="text" name="code[]" maxlength="1" required>
                            <input type="text" name="code[]" maxlength="1" required>
                            <input type="text" name="code[]" maxlength="1" required>
                        </div>
                        <div class="text-center mt-3">
                            <small>if you do not give a rating after one hour of the program ends, your attendance will not be counted.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleEventType(button) {
            const buttons = button.parentElement.querySelectorAll('button');
            buttons.forEach(function(btn) {
            if (btn.id === '0') {
                btn.id = '0';
                btn.classList.add('active');
                btn.id = '1';
                btn.classList.remove('active');
                btn.id = '2';
                btn.classList.remove('active');
            } else if (btn.id === '1') {
                btn.id = '1';
                btn.classList.add('active');
                btn.id = '0';
                btn.classList.remove('active');
                btn.id = '2';
                btn.classList.remove('active');
            } else if (btn.id === '2') {
                btn.id = '2';
                btn.classList.add('active');
                btn.id = '0';
                btn.classList.remove('active');
                btn.id = '1';
                btn.classList.remove('active');
            }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const listeventButtons = document.querySelectorAll('.btn-group button');
        const listeventContent = document.querySelector('.card');
        const listeventRow = document.querySelectorAll('.event-row')
        console.log('Buttons:', listeventButtons);
        console.log('Content:', listeventContent);

        listeventButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const value = button.value;
                    // all events
                    if (value === '1') {
                        // listeventContent.style.display = 'block';
                        listeventRow.forEach(function(row){
                            row.style.display = 'block';
                        });
                    } else if (value === '0') {
                        // listeventContent.style.display = 'none';
                        listeventRow.forEach(function(row){
                            const registeredEvent = row.getAttribute('data-registered-event');
                            if (registeredEvent === 'true') {
                                row.style.display ='block';
                            } else {
                                row.style.display = 'none';
                            }
                        })
                    } else if (value === '2') {
                        listeventRow.forEach(function(row) {
                            const eventCategory = row.getAttribute('data-event-category');
                            if (eventCategory === 'true') {
                                row.style.display ='block';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        let ascendingOrder = true;

        // Function to toggle sorting order and update icon
        function toggleSortOrder() {
            const sortIcon = document.getElementById('sortIcon');
            ascendingOrder = !ascendingOrder;
            if (ascendingOrder) {
                sortIcon.classList.remove('fa-chevron-down');
                sortIcon.classList.add('fa-chevron-up');
                sortText.textContent = 'Ascending';
                sortEvents(true); // Sort events in ascending order
            } else {
                sortIcon.classList.remove('fa-chevron-up');
                sortIcon.classList.add('fa-chevron-down');
                sortText.textContent = 'Descending';
                sortEvents(false); // Sort events in descending order
            }
        }

        // Function to sort events based on date
        function sortEvents(ascending) {
            const eventRows = document.querySelectorAll('.event-row');
            const sortedEvents = Array.from(eventRows).sort((a, b) => {
                const dateTimeA = new Date(a.getAttribute('data-event-date') + ' ' + a.getAttribute('data-event-time'));
                const dateTimeB = new Date(b.getAttribute('data-event-date') + ' ' + b.getAttribute('data-event-time'));
                return ascending ? dateTimeA - dateTimeB : dateTimeB - dateTimeA;
            });

            // Remove existing event rows
            eventRows.forEach(row => row.remove());

            // Append sorted event rows to the container
            sortedEvents.forEach(event => {
                document.getElementById('eventsContainer').appendChild(event);
            });
        }

        // Add click event listener to the sort icon
        document.getElementById('sortToggle').addEventListener('click', function() {
            toggleSortOrder();
        });

        // Sort events initially based on ascending order
        sortEvents(true);
    </script>

    <!-- Script for search functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById('inlineFormInputGroup');

            searchInput.addEventListener('input', function() {
                var searchTerm = this.value.trim().toLowerCase();
                var eventRows = document.querySelectorAll('.event-row');

                eventRows.forEach(function(row) {
                    var eventTitle = row.querySelector('.card-header .pull-left h3').textContent.toLowerCase();
                    var eventName = row.querySelector('.card-header .pull-right h3').textContent.trim().toLowerCase();
                    var eventStatus = row.querySelector('.card-body .pull-right h4').textContent.trim().toLowerCase();


                    if (eventTitle.includes(searchTerm) || eventName.includes(searchTerm) || eventStatus.includes(searchTerm)) {
                        row.style.display = 'block';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
            const listeventRow = document.querySelectorAll('.event-row')
            const modal = document.getElementById('exampleModal');
            const eventIdInput = document.getElementById('event_id');
            const modalButtons = document.querySelectorAll('.modalBtn');

            modalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    listeventRow.forEach(function(row){
                        row.style.display = 'block';
                    });
                    const eventId = this.getAttribute('data-event-id');
                    eventIdInput.value = eventId;
                    modal.style.display = 'block';
                });
            });

            const inputs = document.querySelectorAll('.verification-code input');
            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length > 0 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

            // Handling modal close
            modal.querySelector(".btn-close").addEventListener("click", function() {
                modal.style.display = "none";
            });

            // Close modal on click outside of it
            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>

@endsection
