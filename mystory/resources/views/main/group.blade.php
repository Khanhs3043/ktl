@extends('layouts.layout')
@section('content')
    <h1>Group</h1>
    <div class="options">
        <p class="option"> Created groups </p>
        <p class="option"> Groups </p>
    </div>
    @if($mygroups)
        @foreach($mygroups as $mygroup)
            <div class="mygroup">
                <p class="mg-name">{{$mygroup->name}}</p>
                <p class="mg-date">{{$mygroup->created_at}}</p>
            </div>
        @endforeach
    @endif
@endsection