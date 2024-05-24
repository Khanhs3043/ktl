<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newct extends Controller
{
    public function index (){
        $name = "Hello Word từ Controller";
        return view('HW', compact('name'));
    }
}
