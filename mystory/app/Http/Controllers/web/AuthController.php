<?php

namespace App\Http\Controllers\web;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if the user already exists
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if ($user) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // Check if the user exists by email
        $existingUser = User::where('email', $socialUser->getEmail())->first();
        if ($existingUser && !$existingUser->provider) {
            return response()->json(['message' => 'Email already in use'], 409);
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
        }

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return View('log.login');
    }

}
