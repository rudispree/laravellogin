<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class UserController extends Controller
{
    use HasApiTokens, Notifiable;

    public function User()
    {
        return Auth::user();
    }
    // public function User()
    // {
    //     $user = Auth::user();
    //     $token = $user->currentAccessToken();

    //     return response()->json(['user' => $user, 'token' => $token]);
    // }
}
