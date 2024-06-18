@extends('layouts.layout')
<link rel="stylesheet" href="accfix.css">
@section('content')
<div class="body_all">
        <form action="">
            <div class="container">
                <div class="item-1 item">
                    <p>Chỉnh sửa trang cá nhân</p>
                </div>
                <div class="item-2 item">
                    <div class="profile-avatar">
                        <img src="money.jpg" alt="">
                        <p style="font-weight: bold;">Quynh Trang</p>
                        <button class="button">Đổi ảnh</button>
                    </div>
                </div>
                <div class="item-3 item">
                    <div class="name">
                        <div class="title-name">
                            <p>Tên</p> 
                        </div>
                        <div id="editableText" contenteditable="true" class="editable-text">
                            Quynh Trang
                        </div>
                    </div>
                </div>
                <div class="item-4 item">
                    <div class="bio">
                        <div class="title-name">
                            <p>Bio</p>
                        </div>
                        <div id="editableText" contenteditable="true" class="editable-text">
                            Bio
                        </div>
                    </div>
                </div>
                <div class="item-5 item">
                    <div class="dob">
                        <div class="title-name">
                            <p>Date of Birth</p>
                        </div>
                        <div>
                            <input type="date" id="dob" name="dob" required>
                        </div>
                    </div>
                </div>
                <div class="item-6 item">
                    <div class="sex">
                        <div class="title-name">
                            <p>Gender</p>
                        </div>
                        <select id="gender" name="gender" required>
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit">Lưu</button>
        </form>
    </div>
@endsection