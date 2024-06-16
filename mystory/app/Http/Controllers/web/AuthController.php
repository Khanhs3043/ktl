<?php

namespace App\Http\Controllers\web;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
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
            
            // Create profile for the user
            $profile = Profile::create([
                'uid' => $user->id,
                'username' => $user->name,
                'avatar' => null,
                'dob' => null,
                'bio' => null,
                'gender' => null,
            ]);
    
            // Optionally, you can login the user after registration
            // Auth::login($user);
    
            // Return a view or redirect to a route
            // Example: Redirect to a dashboard route after registration
            return redirect()->route('dashboard')->with('success', 'Registration successful!');
        } catch (ValidationException $e) {
            // Handle validation errors
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
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors(['password' => 'Incorrect email or password.'])->withInput();
        }

        // Optionally, you can login the user
        // $user = Auth::user();
        // Auth::login($user);

        // Redirect to a dashboard route after successful login
        return redirect()->route('friends')->with('success', 'Login successful!');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    }
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
            // Optionally, you can login the user
            // Auth::login($user);

            // Redirect to a dashboard route after login
            return redirect()->route('dashboard')->with('success', 'Login successful!');
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

            // Create profile for the user
            $profile = Profile::create([
                'uid' => $user->id,
                'username' => $socialUser->getName(),
                'avatar' => $socialUser->getAvatar(),
                'dob' => null,
                'bio' => null,
                'gender' => null,
            ]);
        }
        
        // Optionally, you can login the user
        // Auth::login($user);

        // Redirect to a dashboard route after successful login
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }

}
