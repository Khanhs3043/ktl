@extends('layouts.layout')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/search.css"> 
@section('content')
    <h1>Find friends</h1>
    <div class="container mt-5">
    <!-- <p class="text-center mb-4">Find friends</p> -->
    <form action="/search" method="POST" class="form-inline justify-content-center">
        @csrf
        <div class="form-group mb-2">
            <input type="text" name="query" class="form-control" placeholder="enter name or email" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2 ml-2">Tìm kiếm</button>
    </form>
    

    <div class="search-list">
    @if(isset($users))
        @foreach($users as $user)
            <a href="/profile/{{$user->id}}">
            <div class="user-frame">
                <div class="wrap-user-info">
                @if ($user->profile && $user->profile->avatar)
                    <img src="{{ $user->profile->avatar}}" alt="User Avatar">
                @else
                    <img src="https://t3.ftcdn.net/jpg/05/53/79/60/360_F_553796090_XHrE6R9jwmBJUMo9HKl41hyHJ5gqt9oz.jpg" alt="Default Avatar">
                @endif
                <div class="wrap-user-info-text">
                    <p class="name">{{$user->name}}</p>
                    <p class="email">{{$user->email}}</p>
                </div>
                </div>
                <div class="friends">
                    @if(Auth::user()->isFriendWith($user->id))
                        <button type="button" class="fr-btn isfr">Friend</button>
                    @elseif (Auth::user()->checkFriendRequestStatus($user->id)=='pending')
                    <form action="/cancel-request/{{$user->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="fr-btn sent" >Request sent</button>
                    </form>
                    @elseif($user->id == Auth::user()->id)
                    <button class="fr-btn notfr" type="button">It's me</button>
                    @else 
                    <form action="/send-request/{{$user->id}}" method="post">
                        @csrf
                        <button class="fr-btn notfr">Add Friend</button>
                    </form>
                    @endif
                </div> 
            </div>
            </a>
        @endforeach
    @else 
        <p style="text-align: center; width: 100%">no user found</p>
    @endif
    </div>
</div>
@endsection