@extends('layouts.layout')
<link rel="stylesheet" href="/css/group.css"> 
@section('content')
<div class="edit-group">
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
    <script src="/js/group.js"></script>
@endsection