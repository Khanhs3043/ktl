@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="/css/friend_request.css"> 
    <h1>Friend requests</h1>
    @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    @if(isset($requests))
        <div class="requests">
        @foreach($requests as $request)
            
                <div class="request">
                    <div class="wrap">
                        <img src="{{$request->sender->profile->avatar}}" alt="">
                        <div class="wrap-friend-info">
                            <p class="frname">{{$request->sender->name}}</p>
                        </div>
                    </div>
                    <div class="wrap-btn">
                    <form action="/request/respond/{{ $request->id }}" method="POST">
                            @csrf
                            <button type="submit" name="status" value="accepted">Accept</button>
                            <button type="submit" name="status" value="rejected">Reject</button>
                        </form>
                    </div>
                </div>
        @endforeach
        </div>
       
    @else
        <p>Total: 0</p>
        <p>No friends to show</p>
    @endif

    
@endsection