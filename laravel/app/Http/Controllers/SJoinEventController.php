<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\Rating;
use Carbon\Carbon;

class SJoinEventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        // $check = auth()->user()->student->participant->event_id;
        // dd($check);
        $currentDateTime = Carbon::now();
        // dd($currentDateTime);
        $currentStudent = auth()->user()->student->id;

        // Update event statuses
        foreach ($events as $event) {
            $eventStartDateTime = Carbon::parse($event->event_start_date . ' ' . $event->event_start_time);
            $eventEndDateTime = Carbon::parse($event->event_end_date . ' ' . $event->event_end_time);

            // Event is starting or full, update its status
            if ($event->participant->count() >= $event->event_capacity || $eventStartDateTime <= $currentDateTime) {
                $event->update(['eventstatus_id' => 2]);
            }

            // Delete participants with participant_present = 0 if event ended more than an hour ago
            if ($eventEndDateTime->addMinutes(10)->lessThanOrEqualTo($currentDateTime)) {
                $participantsToDelete = Participant::where('participant_present', 0)
                                                    ->where('event_id', $event->id)
                                                    ->get();
                foreach ($participantsToDelete as $participant) {
                    $participant->delete();
                }
            }
        }

        // // Find participants with participant_present = 0 and event ended more than an hour ago
        // $participantsToDelete = Participant::where('participant_present', 0)
        //                                     ->whereHas('event', function ($query) use ($currentDateTime) {
        //                                         $query->where('event_end_time', '<', $currentDateTime->subHour());
        //                                     })
        //                                     ->get();

        // // Delete the found participants
        // foreach ($participantsToDelete as $participant) {
        // $participant->delete();
        // }

        // // Reset the $currentDateTime after modifying it
        // $currentDateTime = Carbon::now();

        // Fetch events based on course and event status
        $events = Event::where(function ($query) {
                            $query->where('course_id', 1)
                                  ->orWhere('course_id', auth()->user()->student->course_id);
                        })
                        ->where('eventstatus_id', 1)
                        ->orWhere(function($query) use ($currentStudent) {
                            $query->where('eventstatus_id', 2)
                                  ->whereIn('id', function($subQuery) use ($currentStudent) {
                                    $subQuery->select('event_id')
                                             ->from('participant')
                                             ->where('student_id', $currentStudent)
                                             ->where('deleted_at', null);
                                  });
                        })
                        ->orderBy('event_start_date')
                        ->orderBy('event_start_time')
                        ->get();

        return view('SJoinEvent.index', compact('events', 'currentDateTime'));
    }

    public function verifyEventCode(Request $request)
    {
        $eventId = $request->input('event_id');
        $event = Event::where('id', $eventId)->first();

        if (!$event) {
            session()->flash('alert', ['type' => 'danger', 'message' => 'Event not found']);
            return redirect()->route('SJoinEvent.index');
        }

        $inputCode = implode('', $request->input('code'));

        // dd($inputCode);

        if ($inputCode == $event->event_verification_code) {
            // dd($inputCode);
            return redirect()->route('SJoinEvent.editRating', [$eventId]);
        } else {
            session()->flash('alert', ['type' => 'danger', 'message' => 'Wrong Verification Codes']);
            return redirect()->route('SJoinEvent.index');
        }
    }

    public function showDetail(Event $eventId)
    {
        return view('SJoinEvent.showDetail', compact('eventId'));
    }

    public function storeParticipant(Event $event, Request $request)
    {
        $currentDateTime = Carbon::now();

        $eventStartDateTime = Carbon::parse($event->event_start_date . ' ' . $event->event_start_time);

        if ($eventStartDateTime <= $currentDateTime) {
            session()->flash('alert', ['type' => 'danger', 'message' => 'Unsuccessfully join an event because the event is ongoing or ended']);
            return redirect()->route('SJoinEvent.index');
        }

        $currentCourseStudent = auth()->user()->student->course->id;

        if ($currentCourseStudent == $event->course_id || $event->course_id == 1) {
            if ($event->event_payment == 1) {
                Participant::create([
                    'participant_present' => 0,
                    'student_id' => auth()->user()->student->id,
                    'event_id' => $event->id,
                    'payment_id' => null,
                ]);
            } else {
                $request->validate([
                    'payment_receipt' => ['required'],
                ]);

                if ($request->hasFile('payment_receipt'))
                {
                    $receiptPicture = time().'.'.$request->payment_receipt->extension();
                    $request->payment_receipt->move(base_path('../public_html/picture/receipt'), $receiptPicture);
                }

                $payment = Payment::create([
                    'payment_receipt' => $receiptPicture,
                ]);

                Participant::create([
                    'participant_present' => 0,
                    'student_id' => auth()->user()->student->id,
                    'event_id' => $event->id,
                    'payment_id' => $payment->id,
                ]);
            }

            session()->flash('alert', ['type' => 'success', 'message' => 'Successfully join an event']);
            return redirect()->route('SJoinEvent.index');
        } else {
            session()->flash('alert', ['type' => 'danger', 'message' => 'Unsuccessfully join an event because wrong course code']);
            return redirect()->route('SJoinEvent.index');
        }



    }

    public function editRating(Event $eventId)
    {
        $participantId = Participant::where('event_id', $eventId->id)
                                     ->where('student_id', auth()->user()->student->id)
                                     ->value('id');

        $ratingExists = Rating::where('participant_id', $participantId)->exists();

        $ratingValue = Rating::where('participant_id', $participantId)
                              ->value('rating_event');
        // dd($ratingValue);
        return view('SJoinEvent.editRating', compact('eventId', 'ratingExists', 'ratingValue'));
    }

    public function storeRating(Event $event, Request $request)
    {
        $request->validate([
            'rating_event' => ['required']
        ]);

        // Retrieve the participant record for the authenticated user and the given event
        $participant = Participant::where('event_id', $event->id)
                                  ->where('student_id', auth()->user()->student->id)
                                  ->first();

        // Check if the participant exists
        if ($participant) {
            // Update the participant_present field to 1
            $participant->participant_present = 1;
            $participant->save();

            // dd($participant);
            // Create the rating for the participant
            Rating::create([
                'rating_event' => $request->rating_event,
                'participant_id' => $participant->id,
            ]);


            return back()->with('alert', ['type' => 'success', 'message' => 'You successfully submitted your rating']);
        } else {
            return back()->with('alert', ['type' => 'danger', 'message' => 'Participant not found']);
        }
    }
}
