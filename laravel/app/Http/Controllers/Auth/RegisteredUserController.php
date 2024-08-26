<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Course;
use App\Models\Eventcategory;
use App\Models\Hobby;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::all(); // Fetch all courses from the database
        // dd($courses);
        $eventcategories = Eventcategory::all(); // Fetch all eventcategories from the database
        $hobbies = Hobby::all(); // Fetch all hobbies from the database
        return view('auth.register', compact('courses','eventcategories','hobbies'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->validate([ //Validate Request Student
            'student_matric' => ['required', 'string', 'max:10', 'unique:student'],
            'course_id' => ['required'],
            'student_phone_number' => ['required', 'string', 'max:11'],
            'eventcategory_id' => ['required'],
            'hobby_id' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 0,
        ]);

        event(new Registered($user));

        Auth::login($user);

        Student::create([ //Create row of Student Information
            'student_matric' => $request-> student_matric,
            'course_id' => $request-> course_id,
            'student_phone_number' => $request-> student_phone_number,
            'eventcategory_id' => $request-> eventcategory_id,
            'hobby_id' => $request-> hobby_id,
            'user_id' => auth()->id(),
        ]);

        // Club::create([
        //     'club_phone_number' => $request-> student_phone_number,
        //     'user_id' =>auth()->id(),
        // ]);

        return redirect(RouteServiceProvider::STUDENT);
    }
}
