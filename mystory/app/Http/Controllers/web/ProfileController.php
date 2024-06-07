<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
    {
        $response = Http::get("https://fluffy-umbrella-pv5g5rv6gr7frj9p-8000.app.github.dev/api/profile");
        $userdata = $response->json(); 
        return view('main.profile',compact('userdata'));
    }
}
