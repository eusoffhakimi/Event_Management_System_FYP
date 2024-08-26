<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Course;
use App\Models\Event;
use App\Models\Eventcategory;
use App\Models\Eventstatus;
use App\Models\Participant;
use App\Models\Rating;
use App\Models\Student;
use App\Notifications\TelegramNotification;
use App\Services\CollaborativeFilteringRecommenderSystem;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\URL;
use Telegram\Bot\FileUpload\InputFile;

class CMyEventPageController extends Controller
{
    public function index()
    {
        // $check = auth()->user()->club->event;
        // dd($check);
        $events = Event::all();
        // $check = auth()->user()->club->event;
        // dd($events);
        // $events = auth()->user()->club->event;
        $currentDateTime = Carbon::now();
        // dd($currentDateTime);

        // Update event statuses
        foreach ($events as $event) {
            $eventStartDateTime = Carbon::parse($event->event_start_date . ' ' . $event->event_start_time);
            $eventEndDateTime = Carbon::parse($event->event_end_date . ' ' . $event->event_end_time);

            // Event is starting or full, update its status
            if ($event->participant->count() >= $event->event_capacity || $eventStartDateTime <= $currentDateTime) {
                $event->update(['eventstatus_id' => 2]);
            }

            // Delete participants with participant_present = 0 if event ended more than an hour ago (addHour())
            if ($eventEndDateTime->addMinutes(10)->lessThanOrEqualTo($currentDateTime)) {
                $participantsToDelete = Participant::where('participant_present', 0)
                                                    ->where('event_id', $event->id)
                                                    ->get();
                foreach ($participantsToDelete as $participant) {
                    $participant->delete();
                }
            }
        }

        // // Update event statuses
        // foreach ($events as $event) {
        //     $eventStartDateTime = Carbon::parse($event->event_start_date . ' ' . $event->event_start_time);
        //     if ($event->participant->count() >= $event->event_capacity || $eventStartDateTime <= $currentDateTime) {
        //         // Event is starting or full, update its status
        //         $event->update(['eventstatus_id' => 2]);
        //     }
        // }

        // Now, retrieve the events again after updating their statuses
        // $events = Event::all();
        $events = Event::orderBy('event_start_date')
                   ->orderBy('event_start_time')
                   ->get();

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

        return view('CMyEventPage.index', compact('events', 'currentDateTime'));
    }

    public function create()
    {
        // $check = auth()->user()->club->id;
        // dd($check);
        $courses = Course::all(); // Fetch all courses from the database
        $eventstatus = Eventstatus::all(); // Fetch all eventstatus from the database
        $eventcategories = Eventcategory::all(); // Fetch all eventcategories from the database
        return view('CMyEventPage.create', compact('courses','eventstatus','eventcategories'));
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'event_title' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string', 'max:65534'],
            'course_id' => ['required'],
            'event_venue' => ['required', 'string', 'max:255'],
            'event_capacity' => ['required', 'integer'],
            'event_payment' => ['required'],
            'event_start_time' => ['required'],
            'event_end_time' => ['required'],
            'event_start_date' => ['required'],
            'event_end_date' => ['required'],
            'eventstatus_id' => ['required'],
            'eventcategory_id' => ['required'],
        ]);

        $event_payment = $request->input('event_payment') == '1' ? true : false;

        if ($request->hasFile('event_qr'))
        {
            $qrPicture = time().'.'.$request->event_qr->extension();
            $request->event_qr->move(base_path('../public_html/picture/qr'), $qrPicture);
        }
        else
        {
            $qrPicture = null;
        }
        
        if ($request->hasFile('event_poster'))
        {
            $posterPicture = time().'.'.$request->event_poster->extension();
            $request->event_poster->move(base_path('../public_html/picture/poster'), $posterPicture);
        }
        else
        {
            $posterPicture = null;
        }

        // Generate a unique 6-digit verification code
        do {
            $event_verification_code = mt_rand(100000, 999999);
        } while (Event::where('event_verification_code', $event_verification_code)->exists());

        // dd($event_verification_code);

        $event = Event::create([
            'club_id' => auth()->user()->club->id,
            'event_title' => $request-> event_title,
            'event_description' => $request-> event_description,
            'event_poster' => $posterPicture,
            'course_id' => $request-> course_id,
            'event_venue' => $request-> event_venue,
            'event_capacity' => $request-> event_capacity,
            'event_payment' => $event_payment,
            'event_price' => $request-> event_price,
            'event_qr' => $qrPicture,
            'event_start_time' => $request-> event_start_time,
            'event_end_time' => $request-> event_end_time,
            'event_start_date' => $request-> event_start_date,
            'event_end_date' => $request-> event_end_date,
            'eventstatus_id' => $request-> eventstatus_id,
            'eventcategory_id' => $request-> eventcategory_id,
            'event_verification_code' => $event_verification_code,
        ]);
        
        // Send the Poster picture as a photo to Telegram
        if ($event->event_poster) {
            $photoPath = base_path('../public_html/picture/poster/' . $event->event_poster);
            $photo = InputFile::create($photoPath);

            Telegram::sendPhoto([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'photo' => $photo,
            ]);
        }

        // Generate the URL for the event details page
        $eventUrl = URL::route('SJoinEvent.showDetail', ['eventId' => $event->id]);

        // $event->notify(new TelegramNotification($event));
        $text = "New Event Created! \n".
                "Organizer: ".auth()->user()->name."\n".
                "Title Event: ".$request->event_title."\n".
                "Applicable Course: ".$event->course->course_name."\n".
                "Event Date: ".$event->event_start_date."\n".
                "Event Status: ".$event->eventstatus->eventstatus_name."\n".
                "Details: <a href=\"$eventUrl\">Click here to view details</a>";

        Telegram::sendMessage([
            "chat_id"=>env('TELEGRAM_CHANNEL_ID', ''),
            "parse_mode"=>"HTML",
            "text"=>$text
        ]);

        session()->flash('alert', ['type' => 'success', 'message' => 'An event successfully created']);
        return redirect()->route('CMyEventPage.index');
    }

    public function edit(Event $eventId)
    {
        $courses = Course::all(); // Fetch all courses from the database
        $eventstatus = Eventstatus::all(); // Fetch all eventstatus from the database
        $eventcategories = Eventcategory::all(); // Fetch all eventcategories from the database
        return view('CMyEventPage.edit', compact('eventId', 'courses', 'eventstatus', 'eventcategories'));
    }

    public function updateEvent(Event $event, Request $request)
    {
        $request->validate([
            'event_title' => ['required', 'string', 'max:255'],
            'event_description' => ['required', 'string', 'max:65534'],
            'course_id' => ['required'],
            'event_venue' => ['required', 'string', 'max:255'],
            'event_capacity' => ['required', 'integer'],
            'event_payment' => ['required'],
            'event_start_time' => ['required'],
            'event_end_time' => ['required'],
            'event_start_date' => ['required'],
            'event_end_date' => ['required'],
            'eventstatus_id' => ['required'],
            'eventcategory_id' => ['required'],
        ]);

        $event_payment = $request->input('event_payment') == '1' ? true : false;

        if ($request->hasFile('event_qr'))
        {
            if ($event->event_qr)
            {
                unlink(base_path('../public_html/picture/qr/' . $event->event_qr));
            }
            $qrPicture = time().'.'.$request->event_qr->extension();
            $request->event_qr->move(base_path('../public_html/picture/qr'), $qrPicture);
        }
        else
        {
            $qrPicture = null;
        }
        
        if ($request->hasFile('event_poster'))
        {
            if ($event->event_poster)
            {
                unlink(base_path('../public_html/picture/poster/' . $event->event_poster));
            }
            $posterPicture = time().'.'.$request->event_poster->extension();
            $request->event_poster->move(base_path('../public_html/picture/poster'), $posterPicture);
        }
        else
        {
            $posterPicture = null;
        }

        $event->update([
            'club_id' => auth()->user()->club->id,
            'event_title' => $request-> event_title,
            'event_description' => $request-> event_description,
            'event_poster' => $posterPicture,
            'course_id' => $request-> course_id,
            'event_venue' => $request-> event_venue,
            'event_capacity' => $request-> event_capacity,
            'event_payment' => $event_payment,
            'event_price' => $request-> event_price,
            'event_qr' => $qrPicture,
            'event_start_time' => $request-> event_start_time,
            'event_end_time' => $request-> event_end_time,
            'event_start_date' => $request-> event_start_date,
            'event_end_date' => $request-> event_end_date,
            'eventstatus_id' => $request-> eventstatus_id,
            'eventcategory_id' => $request-> eventcategory_id,
        ]);
        
        // Send the Poster picture as a photo to Telegram
        if ($event->event_poster) {
            $photoPath = base_path('../public_html/picture/poster/' . $event->event_poster);
            $photo = InputFile::create($photoPath);

            Telegram::sendPhoto([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'photo' => $photo,
            ]);
        }

        // Generate the URL for the event details page
        $eventUrl = URL::route('SJoinEvent.showDetail', ['eventId' => $event->id]);

        // $event->notify(new TelegramNotification($event));
        $text = "Something Is Updated, Please Check The Details Again! \n".
                "Organizer: ".auth()->user()->name."\n".
                "Title Event: ".$request->event_title."\n".
                "Applicable Course: ".$event->course->course_name."\n".
                "Event Date: ".$event->event_start_date."\n".
                "Event Status: ".$event->eventstatus->eventstatus_name."\n".
                "Details: <a href=\"$eventUrl\">Click here to view details</a>";

        Telegram::sendMessage([
            "chat_id"=>env('TELEGRAM_CHANNEL_ID', ''),
            "parse_mode"=>"HTML",
            "text"=>$text
        ]);

        session()->flash('alert', ['type' => 'success', 'message' => 'An event successfully updated']);
        return redirect()->route('CMyEventPage.index');
    }

    public function editParticipant(Event $event)
    {
        // dd($event->event_title);
        $participants = Participant::where('event_id', $event->id)
                                    ->get();

        $number = 0;

        return view('CMyEventPage.editParticipant', compact('event', 'participants', 'number'));
    }

    public function deleteParticipant(Participant $participant)
    {
        // dd($participant->id);
        $participant->delete();

        return back()->with('alert', ['type' => 'success', 'message' => 'A participant successfully drop']);
    }

    public function showDetail(Event $eventId)
    {
        // dd($event);

        $currentDateTime = Carbon::now();

        return view('CMyEventPage.showDetail', compact('eventId', 'currentDateTime'));
    }

    public function blastEvent(Event $event)
    {
        // Send the Poster picture as a photo to Telegram
        if ($event->event_poster) {
            $photoPath = base_path('../public_html/picture/poster/' . $event->event_poster);
            $photo = InputFile::create($photoPath);

            Telegram::sendPhoto([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'photo' => $photo,
            ]);
        }
        
        // Generate the URL for the event details page
        $eventUrl = URL::route('SJoinEvent.showDetail', ['eventId' => $event->id]);

        // $event->notify(new TelegramNotification($event));
        $text = "We Are Blasting Again, Do Not Forget to Join Us and Check The Details Again! \n".
                "Organizer: ".auth()->user()->name."\n".
                "Title Event: ".$event->event_title."\n".
                "Applicable Course: ".$event->course->course_name."\n".
                "Event Date: ".$event->event_start_date."\n".
                "Event Status: ".$event->eventstatus->eventstatus_name."\n".
                "Details: <a href=\"$eventUrl\">Click here to view details</a>";

        Telegram::sendMessage([
            "chat_id"=>env('TELEGRAM_CHANNEL_ID', ''),
            "parse_mode"=>"HTML",
            "text"=>$text
        ]);
        
        return back()->with('alert', ['type' => 'success', 'message' => 'The event successfully blasted']);
    }

    public function showOutcome(Event $eventId)
    {
        $participantIds = $eventId->participant->pluck('id');

        $totalRating = 0;
        $totalParticipants = 0;
        foreach ($participantIds as $participantId) {
            $rating = Rating::where('participant_id', $participantId)->value('rating_event');

            if ($rating !== null) {
                $totalRating += $rating;
                $totalParticipants++;
            }
        }

        $meanRating = $totalParticipants > 0 ? $totalRating / $totalParticipants : 0;

        $ratingExists = false;
        foreach ($participantIds as $participantId) {
            if ($eventId->participant->find($participantId)->rating()->exists()) {
                $ratingExists = true;
                break;
            }
        }
        // dd($ratingExists);

        return view('CMyEventPage.showOutcome', compact('eventId', 'ratingExists', 'meanRating'));
    }

    public function deleteEvent(Event $eventId)
    {
        $participantsNeedToDelete = Participant::where('participant_present', 0)
                                                ->where('event_id', $eventId->id)
                                                ->get();
        // dd($participantsNeedToDelete);
        foreach ($participantsNeedToDelete as $participant) {
            $participant->delete();
        }

        // dd($eventId->id);
        $eventId->delete();

        // $event->notify(new TelegramNotification($event));
        $text = "This Event will be CANCELED OUT. We Are Really Sorry. \n".
                "Any Problem, Please Contact Us \n".
                "Organizer: ".auth()->user()->name."\n".
                "Title Event: ".$eventId->event_title."\n".
                "Organizer: ".auth()->user()->club->club_phone_number;

        Telegram::sendMessage([
            "chat_id"=>env('TELEGRAM_CHANNEL_ID', ''),
            "parse_mode"=>"HTML",
            "text"=>$text
        ]);

        session()->flash('alert', ['type' => 'success', 'message' => 'An event successfully deleted']);
        return redirect()->route('CMyEventPage.index');
    }

    protected $recommenderSystem;

    public function __construct(CollaborativeFilteringRecommenderSystem $recommenderSystem)
    {
        $this->recommenderSystem = $recommenderSystem;
    }

    public function resultCollaborative()
    {
        // The authenticated club's ID
        $club = Club::find(auth()->user()->club->id);

        // Get top 5 events recommended by collaborative filtering
        $topEvents = $this->recommenderSystem->suggestTopEvents($club);

        $events = Event::whereIn('id', array_keys($topEvents))->get();

        // Calculating the mean rating for each event. Result: This will calculate the mean rating for each event and store it in an array $currentEventMeanRating, keyed by the event ID.
        $currentEventMeanRating = [];
        $currentTotalParticipants = [];
        $currentTotal3RatingAboveParticipants = [];
        foreach ($events as $event) {
            $totalRating = 0;
            $totalParticipants = 0;
            foreach ($event->participant as $participant) {
                $rating = $participant->rating->rating_event ?? null;
                if ($rating !== null) {
                    $totalRating += $rating;
                    $totalParticipants++;
                }
            }
            $currentTotalParticipants[$event->id] = $totalParticipants;
            $currentEventMeanRating[$event->id] = $totalParticipants > 0 ? $totalRating / $totalParticipants : 0;
            $currentTotal3RatingAboveParticipants[$event->id] = $this->recommenderSystem->calculateEventScore($event);
        }

        $eventLabels = $events->pluck('event_title')->toArray();
        $eventRatings = array_values($currentEventMeanRating);
        $eventParticipants = array_values($currentTotalParticipants);
        $event3RatingAboveParticipants = array_values($currentTotal3RatingAboveParticipants);

        // Calculate mean rating for current event
        // Loop through each event in $events and access its participant relationship. Result: Collect all participant IDs from all events in $events
        // $participantIds = [];
        // foreach ($events as $event) {
        //     $participantIds = array_merge($participantIds, $event->participant->pluck('id')->toArray());
        // }

        // $eventParticipants = array_values($participantIds);

        $topEventCategories = $this->recommenderSystem->TopEventCategories();

        // Prepare arrays to return with event categories and their counts separately
        $names = [];
        $counts = [];

        foreach ($topEventCategories as $category) {
            $names[] = $category->eventcategory_name;
            $counts[] = $category->student_count;
        }

        $eventCategoryLabel = $names;
        $eventCategoryCount = $counts;
        // dd($eventCategoryCount);

        $topEventCategoriesList = $this->recommenderSystem->recommendationEventCategories();
        // dd($topEventCategoriesList);
        $recommendedCategories = Eventcategory::whereIn('id', array_keys($topEventCategoriesList))->get();
        // dd($recommendedCategories);

        return view('CMyEventPage.resultCollaborative', compact('topEvents', 'events', 'currentEventMeanRating', 'eventLabels', 'eventRatings', 'eventParticipants', 'event3RatingAboveParticipants', 'eventCategoryLabel', 'eventCategoryCount', 'topEventCategoriesList', 'recommendedCategories'));
    }

    public function updateTele()
    {
        dd(Telegram::bot());
        $updates = Telegram::getUpdates();

        dd($updates);
    }
}
