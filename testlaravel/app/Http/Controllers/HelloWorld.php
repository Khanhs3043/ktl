<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HelloWorld extends Controller
{
    public function index(){
        $title = "Hello World!";
        return View('helloworld',compact('title'));
    }
}
