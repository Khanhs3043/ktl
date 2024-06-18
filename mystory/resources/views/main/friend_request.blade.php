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
                            <button type="submit" name="status" value="accepted" class="ac">Accept</button>
                            <button type="submit" name="status" value="rejected" class="rj">Reject</button>
                        </form>
                    </div>
                </div>
        @endforeach
        </div>
    @endif
    <h1> Requests sent</h1>
    @if(isset($sentrequests))
        <div class="requests">
        @foreach($sentrequests as $request)
            
                <div class="request">
                    
                    <form action="/delete-request/{{$request->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                    
                    <div class="wrap">
                        <img src="{{$request->receiver->profile->avatar}}" alt="">
                        <div class="wrap-friend-info">
                            <p class="frname">{{$request->receiver->name}}</p>
                        </div>
                    </div>
                    <div class="wrap-btn">
                    @if($request->status == "pending")
                    <form action="/cancel-request/{{$request->receiver->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn" >pending</button>
                        </form>
                    @elseif ($request->status == "rejected")
                    <form action="/send-request/{{$request->receiver->id}}" method="post">
                        @csrf
                        <button class="rj">rejected</button>
                    </form>
                    @else 
                    <form action="">
                        <button type="button" name="status" value="{{$request->status}}" class="ac">{{$request->status}}</button>
                    </form>
                    @endif
                    
                    </div>
                </div>
        @endforeach
        </div>
    @endif
@endsection