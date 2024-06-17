@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="/css/friend.css"> 
    <h1>Friend</h1>
    @if(isset($friends))
        <p>Total: {{count($friends)}}</p>
        <div class="friends">
        @foreach($friends as $friend)
                <a href="/profile/{{$friend->id}}">
                <div class="friend">
                    <img src="{{$friend->profile->avatar}}" alt="">
                    <div class="wrap-friend-info">
                        <p class="frname">{{$friend->name}}</p>
                        <p class="fremail">{{$friend->email}}</p>
                    </div>
                </div>
                </a>
        @endforeach
        </div>
       
    @else
        <p>Total: 0</p>
        <p>No friends to show</p>
    @endif

    
@endsection