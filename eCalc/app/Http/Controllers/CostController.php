<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index(){
        $c1 = 1678;$c2 = 1734;$c3 = 2014;$c4 = 2536;$c5 = 2834;$c6 = 2927;
        $l1 = 50;$l2 = 50;$l3 = 100;$l4 = 100;$l5 = 100;$l6 = '...';
        return view('cost',compact('l1','l2','l3','l4','l5','l6','c1','c2','c3','c4','c5','c6'));
    }
}
