@extends('layouts.layout')
@section('content')
    <h1>About {{$group->name}}</h1>
    @foreach($group->members as $member)
        <p>{{$member->name}}</p>
    @endforeach
@endsection