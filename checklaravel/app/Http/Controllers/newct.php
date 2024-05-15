<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newct extends Controller
{
    public function index (){
        $name = "Nguyen Thi Quynh Trang";
        return view('HW', compact('name'));
    }
}
