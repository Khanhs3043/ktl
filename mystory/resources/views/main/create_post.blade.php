@extends('layouts.layout')
@section('content')
<link rel="stylesheet" href="/css/create_post.css"> 
    <h2 class="main-title">Create a new post</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/posts/create" method="post" enctype="multipart/form-data" class="form">
        @csrf
        <label for="title" class="label">Title</label>
        <input class="post-title" type="text" name ='title' placeholder="type something..." required>
        <label for="content"  class="label">Content</label>
        <textarea id="content" name="content" class="post-content" placeholder="type something..." required></textarea><br><br>
        <label class="label" for="image" >Chọn ảnh:</label>
        <input class="choose-image" type="file" id="image" name="image" >
        <button class="create-btn">Create</button>
    </form>

@endsection