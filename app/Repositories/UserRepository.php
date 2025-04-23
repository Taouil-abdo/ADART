<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    // public function registerUser(array $data)
    // {
    //     return User::create([
    //         'fullname' => $data['fullname'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'status' => $data['status'] ?? 'active',
    //         'profile_img' => $data['profile_img'] ?? null,
    //         'birthday' => $data['birthday'] ?? null,
    //         'address' => $data['address'] ?? null,
    //         'age' => $data['age'] ?? null,
    //         'school_level' => $data['school_level'] ?? null,
    //         'date_joined' => $data['date_joined'] ?? null,
    //         'date_detached' => $data['date_detached'] ?? null,
    //         'urgent_contact' => $data['urgent_contact'] ?? null,
    //         're_status' => $data['re_status'] ?? null,
    //         'school' => $data['school'] ?? null,
    //         'health_condition' => $data['health_condition'] ?? null,
    //         'disease_type' => $data['disease_type'] ?? null,
    //         'role_id' => $data['role_id'],
    //     ]);
    // }

    public function loginUser(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }
        return null;
    }


}
