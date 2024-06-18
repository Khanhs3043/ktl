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
                        <a href="profile/edit"><button class="btn">Edit profile</button></a>
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
                    <span><span class="bold">Bio:</span> {{$user->profile->bio? $user->profile->bio: "nothing to show"}}</span>
                    <span><span class="bold">Date of birth:</span> {{$user->profile->dob? $user->profile->dob: "no infomation"}}</span>
                    <span><span class="bold">Gender:</span> {{$user->profile->gender? $user->profile->gender: "no infomation"}}</span>
                </div>
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
                        <div class="wrap-options">
                        <form action="/posts/{{$post->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"><i class="fa-regular fa-trash-can delete"></i></button>
                            </form>
                            <a href="/post/edit/{{$post->id}}"><i id="icon" class="fa-solid fa-edit edit"></i></a>
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
        document.addEventListener('DOMContentLoaded', function () {
            const myIcon = document.getElementById('icon');
            const myList = document.getElementById('optionsMenu');

            myIcon.addEventListener('click', function (event) {
                const rect = myIcon.getBoundingClientRect();
                const x = rect.left + window.scrollX;
                const y = rect.top + window.scrollY + myIcon.offsetHeight;

                myList.style.left = `${x}px`;
                myList.style.top = `${y}px`;
                myList.style.display = 'block';
            });

            document.addEventListener('click', function (event) {
                if (!myIcon.contains(event.target) && !myList.contains(event.target)) {
                    myList.style.display = 'none';
                }
            });
        });
    </script>
@endsection

