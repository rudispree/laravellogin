<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\User;
use App\Mail\ForgetMail;
use Illuminate\Http\Request;
use App\Http\Requests\ForgetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Laravel\Sanctum\PersonalAccessToken; 

class ForgetController extends Controller
{
    public function forgetPassword(ForgetRequest $request)
    {
        $email = $request->email;

        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'Email Invalid'
            ], 401);
        }

        $token = rand(10, 100000);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            // Send email
            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message' => 'Reset Password Mail sent to your email',
            ], 200);
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

}