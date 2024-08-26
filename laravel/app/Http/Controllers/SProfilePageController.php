<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Http\Requests\Auth\SProfileRequest;
use App\Models\Eventcategory;
use App\Models\Hobby;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SProfilePageController extends Controller
{
    public function edit()
    {
        // $student = auth()->user()->student;

        // dd($student);

    // if ($student) {
    //     $courseName = $student->course->course_name ?? '';
    //     dd($courseName);
    // } else {
    //     // Handle case where there is no associated student record
    //     dd("No student record found for the authenticated user.");
    // }
        $eventcategories = Eventcategory::all(); // Fetch all eventcategories from the database
        $hobbies = Hobby::all(); // Fetch all hobbies from the database

        return view('SProfilePage.edit', compact('eventcategories','hobbies'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        // $user = auth()->user();
        // $validatedData = $request->validated();
        // User::where('id', $user->id)->update($validatedData);

        return back()->with('alert', ['type' => 'success', 'message' => 'Profile successfully updated.']);
    }

    /**
     * Update the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('alert', ['type' => 'success', 'message' => 'Password successfully updated.']);
    }

    /**
     * Update the picture
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePicture(Request $request, Student $student)
    {
        $request->validate([
            'student_picture' => ['required'],
        ]);
        // $picture = auth()->user()->student->student_picture;
        // dd($picture);
        if($request->hasFile('student_picture'))
        {
            // $picture = auth()->user()->student->student_picture;
            // dd($picture);
            if($student->student_picture)
            {
                unlink(base_path('../public_html/picture/student/' . $student->student_picture));
            }
            $studentPicture = time().'.'.$request->student_picture->extension();
            $request->student_picture->move(base_path('../public_html/picture/student'), $studentPicture);
            // $picture = auth()->user()->student->student_picture;
            // dd($picture);
            auth()->user()->student->update(['student_picture' => $studentPicture]);
        }

        return back()->with('alert', ['type' => 'success', 'message' => 'Picture successfully updated.']);
    }

    /**
     * Update the details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDetail(Request $request)
    {
        $request->validate([
            'student_phone_number' => ['required', 'string', 'max:11'],
            'eventcategory_id' => ['required'],
            'hobby_id' => ['required'],
        ]);

        auth()->user()->student->update($request->all());

        return back()->with('alert', ['type' => 'success', 'message' => 'Details successfully updated.']);
    }
}
