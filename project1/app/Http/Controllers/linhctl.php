<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class linhctl extends Controller
{
    public function index(){
        $name = 'Nguyen Dieu Linh';
        return view('laravel', compact('name'));
    }
}
