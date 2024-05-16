<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newct extends Controller
{
    public function index (){
        $name = "Hello Word";
        return view('HW', compact('name'));
    }
}
