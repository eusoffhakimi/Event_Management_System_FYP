@extends('layouts.Clubmajor', ['page' => __('My Event'), 'pageSlug' => 'mevent'])

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
            {{ session('alert')['message'] }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 mb-2">
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('CMyEventPage.create') }}"> Add New Event</a>
            </div>
            <div class="btn-group btn-group-toggle float-right" role="group" data-toggle="buttons">
                <button type="button" class="btn btn-sm btn-primary btn-simple" id="0" value="0" onclick="toggleEventType(this)">
                    My Event
                </button>
                <button type="button" class="btn btn-sm btn-primary btn-simple active" id="1" value="1" onclick="toggleEventType(this)">
                    All Event
                </button>
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <!-- <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
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

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">Understanding Blockchain Ecosystem</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">24 December 2023</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="{{ route('CMyEventPage.showOutcome') }}">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">Cyber Security - Awareness Talk</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">13 March 2024</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="{{ route('CMyEventPage.showDetail') }}">Details</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable1">Details</label> -->
                                <a class="btn btn-info text-white px-3 mb-0" href="{{ route('CMyEventPage.edit') }}">Edit</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Edit</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="{{ route('CMyEventPage.editParticipant') }}">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable3">Participant</label> -->
                                <a class="btn btn-danger text-white px-3 mb-0" href="#">Delete</a> <!-- <label class="btn btn-danger text-white px-3 mb-0" for="btnradiotable4">Delete</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Open</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @php
        $perPage = 4;
        $pageEvents = $events->chunk($perPage);
        $filteredEvents = $events->where('club_id', auth()->user()->club->id);
        $filterPageEvents = $filteredEvents->chunk($perPage);
        $currentPage = request()->get('page', 1);
        $page = $pageEvents; // Initially set to all events
    @endphp --}}
    <div id="eventsContainer">
        @foreach($events as $event) <!-- $page[$currentPage - 1] -->
            {{-- @php
                $encodedClubId = base64_encode($event->club_id); // Untuk encode dekat inspect devtools
                $displayStyle = ($event->club_id == auth()->user()->club->id) ? 'block' : 'none';
            @endphp --}}
            {{-- @if ($event->club_id == auth()->user()->club->id) --}}
            {{-- {{dd(auth()->user()->club->id == $event->club_id)}} --}}
                <div class="row event-row" data-club-id="{{$event->club_id}}" data-event-date="{{ $event->event_start_date }}" data-event-time="{{ $event->event_start_time }}" style="display: block;">
                    {{-- <div class="row"> --}}
                        <div class="col-12">
                            <div class="card">
                                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                                    <div class="card-header border-bottom pb-0">
                                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                                            <div class>
                                                <h3 class="font-weight-semibold text-white mb-0">{{$event->event_title}}</h3> <!-- font-weight-semibold text-lg mb-0 --> <!-- / {{$event->participant->count()}} -->
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
                                        @if ($event->club_id != auth()->user()->club->id)
                                            <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                    <a class="btn btn-success text-white px-3 mb-0" href="{{ route('CMyEventPage.showDetail', $event->id) }}">Details</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable1">Details</label> --> <!-- , [event => $event->id] -->
                                                </div>
                                            </div>
                                        @else
                                            @if($eventStartDateTime >= $currentDateTime)
                                                <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <a class="btn btn-success text-white px-3 mb-0" href="{{ route('CMyEventPage.showDetail', $event->id) }}">Details</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable1">Details</label> --> <!-- , [event => $event->id] -->
                                                        <a class="btn btn-info text-white px-3 mb-0" href="{{ route('CMyEventPage.edit', $event->id) }}">Edit</a> <!-- <label class="btn btn-white px-3 mb-0" for="btnradiotable2">Edit</label> -->
                                                        <a class="btn btn-warning text-white px-3 mb-0" href="{{ route('CMyEventPage.editParticipant', $event->id) }}">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable3">Participant</label> -->
                                                        <form method="POST" action="{{route('CMyEventPage.deleteEvent', $event->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger text-white px-3 mb-0">Delete</button> <!-- <label class="btn btn-danger text-white px-3 mb-0" for="btnradiotable4">Delete</label> -->
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <a class="btn btn-success text-white px-3 mb-0" href="{{ route('CMyEventPage.showOutcome', $event->id) }}">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                                        <a class="btn btn-warning text-white px-3 mb-0" href="{{ route('CMyEventPage.editParticipant', $event->id) }}">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                                                    </div>
                                                </div>
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
                    {{-- </div> --}}
                </div>
            {{-- @endif --}}
        @endforeach
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    @for ($i = 1; $i <= count($page); $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('CMyEventPage.index', ['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div> --}}

    <script>
        function toggleEventType(button) {
            const buttons = button.parentElement.querySelectorAll('button');
            buttons.forEach(function(btn) {
            if (btn.id === '1') {
                btn.id = '1';
                btn.classList.add('active');
                btn.id = '0';
                btn.classList.remove('active');
            } else if (btn.id === '0') {
                btn.id = '0';
                btn.classList.add('active');
                btn.id = '1';
                btn.classList.remove('active');
            }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const listeventButtons = document.querySelectorAll('.btn-group button');
            console.log('Buttons:', listeventButtons);

            const eventRows = document.querySelectorAll('.event-row');
            console.log('Row:', eventRows);

            listeventButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const value = button.value;
                    if (value === '1') {
                        eventRows.forEach(function(row) {
                            row.style.display = 'block';
                        });

                    } else {
                        eventRows.forEach(function(row) {
                            const clubId = row.getAttribute('data-club-id');
                            if (clubId == '{{ auth()->user()->club->id }}') {
                                row.style.display ='block';
                            } else {
                                row.style.display = 'none';
                            }
                        });

                    }
                })
            })
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

@endsection
