<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    

    public function loginUser(array $credentials)
    {

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return redirect()->route('dashboard')->with('token', $token);
    }


}
