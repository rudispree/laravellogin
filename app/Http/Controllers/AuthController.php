<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Laravel\Sanctum\PersonalAccessToken;



class AuthController extends Controller
{
    //

    // public function Login(Request $request)
    // {
    //     try {
    //         if (Auth::attempt($request->only('email', 'password'))) {
    //             $user = Auth::user();
    //             $token = $user->createToken('app')->accessToken;
    
    //             return response([
    //                 'message' => 'Login Berhasil',
    //                 'token' => $token,
    //                 'user' => $user,
    //             ], 200);
    //         }
    //     } catch (Exception $exception) {
    //         return response([
    //             'message' => $exception->getMessage(),
    //         ], 400);
    //     }
    
    //     return response([
    //         'message' => 'Invalid Email Or Password',
    //     ], 401);
    // }
    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->plainTextToken;
    
                // Extract the token without the user ID prefix
                $tokenWithoutID = explode('|', $token)[1];
    
                return response([
                    'message' => 'Login Berhasil',
                    'token' => $tokenWithoutID,
                    'user' => $user,
                ], 200);
            }
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
    
        return response([
            'message' => 'Invalid Email Or Password',
        ], 401);
    }
    
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            $token = $user->createToken('app');
    
            return response([
                'message' => 'Registrasi Berhasil',
                'token' => $token->accessToken, // Use the accessToken property directly
                'user' => $user
            ], 200);
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
    
    
    
    

}
