@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="css/profile.css"> 
    
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
                        <a href="accfix.html"><button class="btn">Edit profile</button></a>
                        <a href="posts/create"><button class="btn">Create post</button></a>
                    </div>
                </div>
                <div class="item-3 item">
                    <div class="number">
                        <p><span>{{count($user->posts)}}</span> Posts</p>
                        <p><span>{{$user->countFriends()}}</span> Friends </p>
                    </div>
                </div>
                <div class="item-4 item" style="font-size: 16px;">
                    <span>{{$user->profile->bio}}</span>
                </div>
                <div class="item-5 item">
                </div>
                <div class="item-6 item">
                </div>
                <div class="item-7 item">
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
                        <i class="fa-solid fa-ellipsis" onclick="toggleOptions()"></i>
                        <div id="optionsMenu" class="options-menu">
                            <a href="#"><button type="button" >Edit</button></a>
                            <form action="/posts/{{$post->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                    <article class="post">
                        <h2 class="post-title">{{$post->title}}</h2>
                        <p class="post-content">{{$post->content}}</p>
                        @if($post->image)
                        <hr>
                        <div class="wrap-post-img">
                            <img src="{{$post->image}}" alt="" class="postimg"></div>
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
    <script>
        function toggleOptions() {
    var optionsMenu = document.getElementById("optionsMenu");
    if (optionsMenu.style.display === "block") {
        optionsMenu.style.display = "none";
    } else {
        optionsMenu.style.display = "block";
    }
}
    </script>
@endsection

