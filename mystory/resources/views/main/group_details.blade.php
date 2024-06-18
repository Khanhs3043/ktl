@extends('layouts.layout')
<link rel="stylesheet" href="/css/group.css"> 
@section('content')
    
    <div class="creator">
        <h1 style="color:white">About {{$group->name}}</h1>
        <div class="creator-ava">
            <img src="{{$group->creator->profile->avatar}}" alt="">
        </div>
        <p class="">Creator: {{$group->creator->name}}</p>
    </div>
    @if($group->creator->id == Auth::user()->id)
    <button class="addmember-btn"><i class="fa-solid fa-plus"></i> Add member</button> 
    <div class="edit-group edit-group2" >
        <div class="close-btn">close</div>
        <form method="POST" action="/groups/update/{{$group->id}}">
        @csrf
        <p>Group name</p>
        <input type="text" required name="name" value="{{$group->name}}">
        <p>Add members</p>
        <div class="wrap-friend">
            @php $nonMemberFriends = false; @endphp
            @foreach(Auth::user()->friends() as $friend)
                @if(!$group->members()->where('uid', $friend->id)->exists())
                    @php $nonMemberFriends = true; @endphp
                    <div class="efriend">
                        <div class="friend-info">
                            <img src="{{$friend->profile->avatar}}" alt="" class="avatar">
                            <div class="wrap-info-text">
                                <p>{{$friend->name}}</p> 
                                <p class="friend-email">{{$friend->email}}</p>
                            </div>
                        </div>
                        <input type="checkbox" value="{{$friend->id}}" name="members[]">
                    </div>
                @endif
            @endforeach
            @if(!$nonMemberFriends)
                <p>No friend to add</p>
            @endif
        </div>
        <button type="submit" class="submit-btn">Update</button>
    </form>
    </div>
    @endif
    <p class="titleformembers">Members</p> 
    @foreach($group->members as $member)
        <a href="/profile/{{$member->id}}" style="width:85%" >
        <div class="wrap-members">
            <div class="member-avatar"><img src="{{$member->profile->avatar}}" alt=""></div>
            <p>{{$member->name}}</p>
            <p class="member-email">({{$member->email}})</p>
            @if($group->creator->id == Auth::user()->id)
            <form action="/group/remove_member/{{$group->id}}/{{$member->id}}" method="post">@csrf<button>delete</button></form>
            @endif
        </div>
        </a>

    @endforeach
    
    <script>
        const addmemberBtn = document.querySelector('.addmember-btn');
        const editarea =  document.querySelector('.edit-group2');
        const closeBtn = document.querySelector('.close-btn');
        addmemberBtn.onclick = function(){
            console.log(editarea);
            editarea.classList.add('show');
        };
        closeBtn.onclick = function(){
            console.log('close');
            editarea.classList.remove('show');
        };
    </script>
@endsection