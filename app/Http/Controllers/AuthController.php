<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(UserRequest $request)
    {
        
        if (!$this->userRepository->loginUser($request->validated())) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return redirect()->route('login');
    }


}
