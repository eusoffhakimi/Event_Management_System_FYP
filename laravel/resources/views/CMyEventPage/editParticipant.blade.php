@extends('layouts.Clubmajor', ['page' => __('My Event'), 'pageSlug' => 'mevent'])

@section('content')
    @if (session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
            {{ session('alert')['message'] }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <h4 class="card-title">Participant</h4>
                        </div>
                        <div class="col-3 text-right">
                            <h4 class="card-title">{{$event->participant->count()}}/{{$event->event_capacity}}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table tablesorter" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th scope="col">Num</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                    @php
                                        $thereReceipt = $participant->payment !== null;
                                    @endphp
                                    <tr>
                                        <td>{{++$number}}</td>
                                        <td>{{$participant->student->user->name}}</td>
                                        <td>{{$participant->student->course->course_code}}</td>
                                        <td>{{$participant->student->student_phone_number}}</td>
                                        <td class="pull-right">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                @if($thereReceipt)
                                                    <a class="btn btn-info text-white px-3 mb-0 modalBtn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-receipt="{{ asset('picture/receipt/' . $participant->payment->payment_receipt) }}">View Receipt</a>
                                                @endif
                                                <form method="POST" action="{{route('CMyEventPage.deleteParticipant', $participant->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger text-white px-3 mb-0">Drop</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
                </div>
                <div class="modal-body">
                    <img class="avatar" id="receiptImage" src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('exampleModal');
            const receiptImage = document.getElementById('receiptImage');

            document.querySelectorAll('.modalBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const receiptUrl = this.getAttribute('data-receipt');
                    receiptImage.src = receiptUrl;
                    modal.style.display = 'block';
                });
            });

            // Handle modal close actions
            modal.querySelector(".btn-close").addEventListener("click", function() {
                modal.style.display = "none";
            });

            // When the user clicks anywhere outside of the modal, close it
            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
    
    <!-- Script for search functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById('inlineFormInputGroup');

            searchInput.addEventListener('input', function() {
                var searchTerm = this.value.trim().toLowerCase();
                var participantRows = document.querySelectorAll('tbody tr');

                participantRows.forEach(function(row) {
                    var name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    var courseCode = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    var phoneNumber = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                    if (name.includes(searchTerm) || courseCode.includes(searchTerm) || phoneNumber.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
