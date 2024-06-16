@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="css/profile.css"> 
    <h1>{{Auth::user()->name}}</h1>
    <img  class="avatar" src="{{Auth::user()->profile->avatar}}" alt="">
    <img  class="avatar" src="images/ava.jpg" alt="">
@endsection