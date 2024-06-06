<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function index(){
        $c1 = 1678;$c2 = 1734;$c3 = 2014;$c4 = 2536;$c5 = 2834;$c6 = 2927;
       return view('calc',compact('c1','c2','c3','c4','c5','c6'));
    }
    public function calc(Request $request){
        $request->validate([
            'kWh' => 'required|numeric|min:0',
        ]);
        $kWh = $request->input('kWh');
        $l1 = $l2 = $l3 = $l4 = $l5 = $l6 = $cost = $total = $tax = 0;
        $c1 = 1678;$c2 = 1734;$c3 = 2014;$c4 = 2536;$c5 = 2834;$c6 = 2927;
        
    if ($kWh >= 0) {
        if ($kWh <= 50) {
            $l1 = $kWh;
        } elseif ($kWh <= 100) {
            $l1 = 50;
            $l2 = $kWh - 50;
        } elseif ($kWh <= 200) {
            $l1 = $l2 = 50;
            $l3 = $kWh - 100;
        } elseif ($kWh <= 300) {
            $l1 = $l2 = 50;
            $l3 = 100;
            $l4 = $kWh - 200;
        } elseif ($kWh <= 400) {
            $l1 = $l2 = 50;
            $l3 = $l4 = 100;
            $l5 = $kWh - 300;
        } elseif ($kWh > 400) {
            $l1 = $l2 = 50;
            $l3 = $l4 = $l5 = 100;
            $l6 = $kWh - 400;
        }
    } else {
        $cost = -1;
        $total = -1;
    }

    $cost = $l1 * $c1 + $l2 * $c2 + $l3 * $c3 + $l4 * $c4 + $l5 * $c5 + $l6 * $c6;
    $tax = round($cost*1.1,3);
    $total = round($cost * 1.1, 3);       
    return view('calc',compact('total','cost','tax','l1','l2','l3','l4','l5','l6','c1','c2','c3','c4','c5','c6'));
    }
}
