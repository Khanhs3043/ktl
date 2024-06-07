<?php

namespace App\Http\Controllers\api;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class GoogleAuthController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // $user = User::create([
        //     'name' => 'Nguyễn Thị Xuân Khánh',
        //     'email' => 'Khánh@example.com',
        //     'password' => Hash::make('12345678'),
        // ]);

        // Profile::create([
        //     'uid' => $user->id,
        //     'username' => 'Khanhs3043',
        //     'avatar' => 'https://pixlr.com/images/index/ai-image-generator-one.webp',
        //     'dob' => '2003-01-01',
        //     'bio' => 'This is a bio',
        //     'gender' => 'Male',
        // ]);

        return response()->json(['user' => $user]);
    }

}
