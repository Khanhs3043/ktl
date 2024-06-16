@extends('layouts.layout')
@section('content')
    <h1>{{Auth::user()->name}}</h1>
    <div class="body_all">
        <div class="acc">
            <div class="container">
                <div class="item-1 item">
                    <div class="profile-avatar">
                        <img src="money.jpg" alt="">
                    </div>
                </div>
                <div class="item-2 item">
                    <div class="profile-name">
                        <p style="padding-right: 20px;">Quynh Trang</p>
                        <button class="btn"><a href="accfix.html">Chỉnh sửa trang cá nhân</a></button>
                        <button class="btn"><a href="">Thêm bài viết</a></button>
                    </div>
                </div>
                <div class="item-3 item">
                    <div class="number">
                        <p><span>2</span> bài viết</p>
                        <p><span>3</span> bạn bè</p>
                    </div>
                </div>
                <div class="item-4 item" style="font-size: 16px;">
                    <span>Hai Phong</span>
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
            <h3>BÀI VIẾT</h3>
        </div>
        <div class="content">
            <section class="post-container">
                <article class="post">
                    <h2 class="post-title">Sample Post 1</h2>
                    <p class="post-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus eros in lorem efficitur, sed molestie neque ultrices.</p>
                    <a href="#" class="read-more">Read more</a>
                </article>
                <article class="post">
                    <h2 class="post-title">Sample Post 2</h2>
                    <p class="post-content">Integer fermentum diam vel nisi tempus, id bibendum metus tempor. Nullam in lectus vel dolor viverra commodo.</p>
                    <a href="#" class="read-more">Read more</a>
                </article>
            </section>
        </div>
    </div>
@endsection
