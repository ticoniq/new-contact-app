<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function edit() {
        $user = auth()->user();
        return view('settings.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request) {
        $profileData = $request->handleRequest();
        $request->user()->update($profileData);
        return back()->with('message', "Account update successfully");
    }

}
