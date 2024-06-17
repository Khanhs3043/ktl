@extends('layouts.layout')
<link rel="stylesheet" href="/css/group.css"> 
@section('content')
    <h1>My Groups</h1>
    <div class="options">
        <p class="option op1"> Created groups </p>
        <div class="space"></div>
        <p class="option op2"> Groups </p>
        <div class="space"></div>
        <div class="create"><i class="fa-solid fa-plus"></i></div>
    </div>
    <div class="wrap-gr">
    <div class="group group1 active">
        @if($mygroups)
            @foreach($mygroups as $mygroup)
                <div class="mygroup">
                    <p class="mg-name">{{$mygroup->name}}</p>
                    <p class="mg-other">Created at: {{$mygroup->created_at}}</p>
                    <p class="mg-other">{{$mygroup->memberscount()}} members</p>
                    <form action="/groups/delete/{{$mygroup->id}}" method="post">
                        @csrf
                        <button class="gr-btn btn-trash"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    
                    <button class="gr-btn btn-edit"><i class="fa-solid fa-edit"></i></button>
                </div>
            @endforeach
        @endif
    </div>
    <div class="group group2">
        @if($groups)
            @foreach($groups as $group)
                <div class="group">
                    <p class="mg-name">{{$group->name}}</p>
                    <p class="mg-other">Created at: {{$group->created_at}}</p>
                    <p class="mg-other">{{$group->memberscount}} members</p>
                </div>
            @endforeach
        @endif
    </div>
    </div>
    <div class="create-group">
        <form method="post" action="/groups/create">
            @csrf
            <p>Group name</p>
            <input type="text" require name="name">
            <div class="close-btn">close</div>
            <button class="submit-btn">Create</div>
        </form>
    </div>
    <script src="/js/group.js"></script>
@endsection