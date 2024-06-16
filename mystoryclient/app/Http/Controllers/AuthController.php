<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
class AuthController extends Controller
{

   public function login(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    try {
        // Gọi API để đăng nhập
        $response = Http::post('https://fluffy-umbrella-pv5g5rv6gr7frj9p-8000.app.github.dev/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // Xử lý kết quả trả về từ API
        if ($response->successful()) {
            return redirect()->intended('/friends'); // Thay '/dashboard' bằng route bạn muốn
        } else {
            return back()->withErrors(['message' => 'Invalid credentials.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['message' => 'Login failed. Please try again.']);
    }
   }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return View('log.login');
    }

}
