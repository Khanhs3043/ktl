@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="/css/profile.css"> 
    
    <div class="body_all">
        <div class="acc">
            <div class="container">
                <div class="item-1 item">
                    <div class="profile-avatar">
                        <img  class="avatar" src="{{$user->profile->avatar}}" alt="">
                    </div>
                </div>
                <div class="item-2 item">
                    <div class="profile-name">
                        <p style="padding-right: 20px;">{{$user->name}}</p>
                        @if(Auth::user()->isFriendWith($user->id))
                        <form action="/unfriend/{{$user->id}}" method="POST">
                            @csrf
                            <button type="submit" class="btn">Unfriend</button>
                        </form>
                        @elseif (Auth::user()->id == $user->id )
                            <div></div>
                        @elseif (Auth::user()->checkFriendRequestStatus($user->id)=='pending')
                        <form action="/cancel-request/{{$user->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn" >Request sent</button>
                        </form>
                        @else
                        <form action="/send-request/{{$user->id}}" method="post">
                            @csrf
                            <button class="btn">Add Friend</button>
                        </form>
                        @endif
                        <!-- <a href="posts/create"><button class="btn">Create post</button></a> --> 
                    </div>
                </div>
                <div class="item-3 item">
                    <div class="number">
                        <p><span>{{count($user->posts)}}</span> Posts</p>
                        <p><span>{{$user->countFriends()}}</span> Friends </p>
                    </div>
                </div>
                <div class="item-4 item" style="font-size: 16px;">
                    <span>Bio: {{$user->profile->bio? $user->profile->bio: "nothing to show"}}</span>
                    <span>Date of birth: {{$user->profile->dob? $user->profile->dob: "no infomation"}}</span>
                    <span>Gender: {{$user->profile->gender? $user->profile->gender: "no infomation"}}</span>
                </div>
            </div>
        </div>
        <div class="title_ct">
            <h3>POSTS</h3>
        </div>
        <div class="content">
            <section class="post-container">
                @if($posts && count($posts)>0)
                    @foreach ($posts as $post)
                    <div class="top-post">
                        <p class="post-date">{{$post->created_at}}</p>
                    </div>
                    <article class="post">
                        <h2 class="post-title">{{$post->title}}</h2>
                        <p class="post-content">{{$post->content}}</p>
                        @if($post->image)
                        <hr>
                        <div class="wrap-post-img">
                            <img src="/{{$post->image}}" alt="" class="postimg"></div>
                        @endif
                        <!-- <a href="#" class="read-more">{{$post->created_at}}</a> -->
                    </article>
                    @endforeach
                @else
                    <p style="text-align: center;">There are no posts yet</p>
                @endif
            </section>
        </div>
    </div>
@endsection

