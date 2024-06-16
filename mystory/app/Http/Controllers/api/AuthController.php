<?php

namespace App\Http\Controllers\Api;

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
            $profile = $user->profile;
            $profile = Profile::create([
                'uid' => $user->id,
                'username' => $user->name, // Example: Use name as username
                'avatar' => null, // You can set a default avatar or handle it separately
                'dob' => null,//$socialUser->getDateOfBirth(), // Example: Date of birth
                'bio' => null, // Example: Biography
                'gender' => null, // Example: Gender
            ]);      
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'profile'=> $profile,
                'token' => $token,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
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
                return response()->json(['errors' => $validator->errors()], 422);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['errors' => ['password' => 'Incorrect email or password.']], 422);
            }

            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    // public function handleProviderCallback($provider)
    // {
    //     try {
    //         $socialUser = Socialite::driver($provider)->stateless()->user();
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     // Check if the user already exists
    //     $user = User::where('provider', $provider)
    //                 ->where('provider_id', $socialUser->getId())
    //                 ->first();

    //     if ($user) {
    //         $token = $user->createToken('Personal Access Token')->plainTextToken;
    //         return response()->json([
    //             'user' => $user,
    //             'token' => $token,
    //         ], 200);
    //     }

    //     // Check if the user exists by email
    //     $existingUser = User::where('email', $socialUser->getEmail())->first();
    //     if ($existingUser && !$existingUser->provider) {
    //         return response()->json(['message' => 'Email already in use'], 409);
    //     }

    //     // Create a new user if not exists
    //     if (!$user) {
    //         $user = User::create([
    //             'name' => $socialUser->getName(),
    //             'email' => $socialUser->getEmail(),
    //             'provider' => $provider,
    //             'provider_id' => $socialUser->getId(),
    //             'password' => '', // Empty password for OAuth users
    //         ]);

    //         $profile = $user->profile;

    //         if (!$profile) {
    //             // If profile does not exist, create a new Profile
    //             $profile = Profile::create([
    //                 'uid' => $user->id,
    //                 'username' => $socialUser->getName(), // Example: Use name as username
    //                 // Optional fields can be left null or set as needed
    //                 'avatar' => $socialUser->getAvatar(), // You can set a default avatar or handle it separately
    //                 'dob' => null,//$socialUser->getDateOfBirth(), // Example: Date of birth
    //                 'bio' => null, // Example: Biography
    //                 'gender' => null, // Example: Gender
    //             ]);
    //         }

    //     }
        
    //     $token = $user->createToken('Personal Access Token')->plainTextToken;

    //     return response()->json([
    //         'user' => $user,
    //         // 'profile'=> $profile,
    //         'token' => $token,
    //     ], 200);
    // }
}
