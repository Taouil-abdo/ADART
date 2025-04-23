<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\web\ForgotPassword;

class ForgotPasswordController extends Controller
{
    public function Index()
    {
        return view('Auth.forgetPassword');
    }

    public function submitForgotPasswordForm(ForgotPassword $request)
{
    // dd($request->all());
    try {
       Log::info('Password reset request for: ' . $request->email);

        $token = Str::random(64);

        // Remove existing token for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Insert new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('Auth.sendPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Password');
        });

        Log::info('Reset password email sent to: ' . $request->email);
        Session::flash('link_success', 'Reset Link Sent Successfully!');

        return redirect()->back();
    } catch (\Exception $e) {
        Log::error('Error sending password reset email: ' . $e->getMessage());
        Session::flash('link_error', 'An error occurred while processing your request.');

        return redirect()->back();
    }
}

    public function showResetPasswordForm($token)
    {
        $data = DB::table('password_reset_tokens')->where('token', $token)->first();
        $email = $data->email;
        
        return view('Auth.forgetpasswordform', ['email'=>$email,'token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        try {
            $updatePassword = DB::table('password_reset_tokens')
                ->where(['email' => $request->email,'token' => $request->token,])->first();

            if (! $updatePassword) {
                return back()->withInput()->with('error_message', 'Invalid token!');
            }

            $user = User::query()->where('email', $request->email)
                ->update(['password' => Hash::make($request->new_password)]);

            DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

            $userRole = User::query()->where('email',$request->email)->first();
          
            return redirect('/')->with('register_success', 'Your password has been changed!');
            


        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());

        }
    }
}