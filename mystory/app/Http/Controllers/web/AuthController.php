<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $profile = Profile::create([
                'uid' => $user->id,
                'username' => $user->name, // Example: Use name as username
                'avatar' => null, // You can set a default avatar or handle it separately
                'dob' => null,//$socialUser->getDateOfBirth(), // Example: Date of birth
                'bio' => null, // Example: Biography
                'gender' => null, // Example: Gender
            ]);      

            Auth::login($user);

            return redirect()->route('home');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Invalid email format.',
                'password.required' => 'Password is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return redirect()->back()->withErrors(['password' => 'Incorrect email or password.'])->withInput();
            }

            return redirect()->route('home');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect()->route('login');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unauthorized');
        }

        // Check if the user already exists
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }

        // Check if the user exists by email
        $existingUser = User::where('email', $socialUser->getEmail())->first();
        if ($existingUser && !$existingUser->provider) {
            return redirect()->route('login')->with('error', 'Email already in use');
        }

        // Create a new user if not exists
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => '', // Empty password for OAuth users
            ]);

            Profile::create([
                'uid' => $user->id,
                'username' => $socialUser->getName(), 
                'avatar' => $socialUser->getAvatar(), 
                'dob' => null,
                'bio' => null, 
                'gender' => null, 
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
