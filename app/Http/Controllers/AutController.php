<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function resetPassword()
    {
        return view('Auth.resetPassword');
    }

    // =========== login user ===========

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if ($user->roles()->exists() && $user->roles()->first()->name === 'Admin') {
                    return redirect()->route('Admin.index');
                } elseif ($user->roles()->exists() && $user->roles()->first()->name === 'suAdmin') {
                    return redirect()->route('home');
                }else {
                    return back()->with('fail', 'No role found for this user');
                }
            } else {
                return back()->with('fail', 'Password is incorrect');
            }
        } else {
            return back()->with('fail', 'No user found for this email');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
    
    public function assignRole($role){
        $user = User::find(session('user_id'));
        if(!$user){
            return redirect()->route('login')->with('error', 'User not found.');
        }
        if($user->roles()->count() > 0){
            return redirect()->back()->with('error', 'User already has a role.');
        }

        $user->roles()->attach($role);

        session()->forget('user_id');
        return redirect(route('login'));
    }


}