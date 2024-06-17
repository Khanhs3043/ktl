@extends('layouts.layout')
<link rel="stylesheet" href="/css/group.css"> 
@section('content')
<div class="edit-group">
        <form method="post" action="/groups/update/{{$group->id}}">
            @csrf
            <p>Group name</p>
            <input type="text" require name="name" value="{{$group->name}}">
            <p>Add members</p>
            <div class="wrap-friend">
                @foreach(Auth::user()->friends() as $friend)
                <div class="efriend">
                    <div class="friend-info">
                        <p>{{$friend->name}}</p> 
                        <p class="friend-email">{{$friend->email}}</p>
                    </div>
                    <input type="checkbox" value="{{$friend->id}}" name="members[]">
                </div>
                @endforeach
            </div>
            <button class="submit-btn">Update</div>
        </form>
    </div>
    <script src="/js/group.js"></script>
@endsection