<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CProfilePageController extends Controller
{
    public function edit()
    {
        // $club = auth()->user()->club;
        // dd($club);
        return view('CProfilePage.edit');
    }

    public function updateProfile(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->with('alert', ['type' => 'success', 'message' => 'Profile successfully updated']);
    }

    public function updatePassword(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('alert', ['type' => 'success', 'message' => 'Password successfully updated.']);
    }

    public function updatePicture(Request $request, Club $club)
    {
        $request->validate([
            'club_picture' => ['required'],
        ]);

        if($request->hasFile('club_picture'))
        {
            if ($club->club_picture)
            {
                unlink(base_path('../public_html/picture/club/' . $club->club_picture));
            }
            $clubPicture = time().'.'.$request->club_picture->extension();
            $request->club_picture->move(base_path('../public_html/picture/club'), $clubPicture);
            auth()->user()->club->update(['club_picture' => $clubPicture]);
        }

        return back()->with('alert', ['type' => 'success', 'message' => 'Picture successfully updated.']);
    }

    public function updateDetail(Request $request)
    {
        $request->validate([
            'club_phone_number' => ['required', 'string', 'max:11'],
        ]);

        auth()->user()->club->update(['club_phone_number' => $request->club_phone_number]);

        return back()->with('alert', ['type' => 'success', 'message' => 'Details successfully updated.']);
    }
}
