@extends('layouts.layout')
<link rel="stylesheet" href="/css/accfix.css">
@section('content')
<div class="body_all">
        <form action="">
            <div class="container">
                <div class="item-1 item">
                    <p>Chỉnh sửa trang cá nhân</p>
                </div>
                <div class="item-2 item">
                    <div class="profile-avatar">
                        <img src="{{$profile->avatar}}" alt="">
                        <p style="font-weight: bold;">{{$profile->username}}</p>
                        <button class="button" type="button">Change avatar</button>
                    </div>
                </div>
                <div class="item-3 item">
                    <div class="name">
                        <div class="title-name">
                            <p>Name</p> 
                        </div>
                        <div id="editableText" contenteditable="true" class="editable-text">
                            {{$profile->username}}
                        </div>
                    </div>
                </div>
                <div class="item-4 item">
                    <div class="bio">
                        <div class="title-name">
                            <p>Bio</p>
                        </div>
                        <div id="editableText" contenteditable="true" class="editable-text">
                        {{$profile->bio}}
                        </div>
                    </div>
                </div>
                <div class="item-5 item">
                    <div class="dob">
                        <div class="title-name">
                            <p>Date of Birth</p>
                        </div>
                        <div>
                            <input type="date" id="dob" name="dob" value="{{$profile->dob}}" require>
                        </div>
                    </div>
                </div>
                <div class="item-6 item">
                    <div class="sex">
                        <div class="title-name">
                            <p>Gender</p>
                        </div>
                        <select id="gender" name="gender" required>
                            <option value="male"  {{$profile->gender == 'male'? 'selected' : ''}}>male</option>
                            <option value="female" {{$profile->gender  == 'female'? 'selected' : ''}}>female</option>
                            <option value="other" {{$profile->gender == 'other'? 'selected' : ''}}>other</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit">Lưu</button>
        </form>
    </div>
@endsection