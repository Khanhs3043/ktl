@extends('layouts.layout')
@section('content')
    <h2>Create a new post</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/posts/create" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name ='title' required >Title
        <input type="text" name ='content' required>content
        <label for="image" >Chọn ảnh:</label>
        <input type="file" id="image" name="image" >
        <button>Create</button>
    </form>

@endsection