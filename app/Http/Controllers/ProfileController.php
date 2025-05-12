<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        if (!$profile) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
        }
        return view('Profile.profile', compact('profile'));
    }

    // public function edit($id)
    // {
    //     $profile = Profile::findOrFail($id);
    //     return view('Profile.edit', compact('profile'));
    // }

    public function update(Request $request, $id)
{
    // dd($request);
    $validatedData = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        // 'password' => 'nullable|string|min:8',
    ]);

    $profile = User::findOrFail($id);

    // Only hash and include the password if it is provided
    if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($request->password);
    } else {
        unset($validatedData['password']); // Remove password from the update data
    }

    $profile->update($validatedData);

    return redirect()->route('profile', $profile->id)->with('success', 'Profile updated successfully.');
}
}