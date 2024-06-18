<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    public function index() // Lấy tất cả các bài viết của người dùng hiện tại
    {
        $posts = Auth::user()->posts()->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function userPosts($uid) // Lấy tất cả bài viết của người dùng cụ thể
    {
        $posts = Post::where('uid', $uid)->get();

        if (!$posts) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }
        return view('posts.user_posts', ['posts' => $posts]);
    }

    public function show($id) // Lấy bài viết theo ID
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }
        return redirect('/home');
    }

    public function create() // Hiển thị form tạo bài viết
    {
        return view('main.create_post');
    }

    public function store(Request $request) // Lưu bài viết mới
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->uid = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;

        // Xử lý tải lên hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("public/posts");
            // $post->image = "storage/app".$imagePath;
            $post->image = "storage/posts/".basename($imagePath);
        }

        $post->save();

        return redirect('home')->with('success', 'Post created successfully.');
    }

    public function edit($id) // Hiển thị form chỉnh sửa bài viết
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }

        return view('main.edit_post', ['post' => $post]);
    }

    public function update(Request $request, $id) // Cập nhật bài viết
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }

        // Check if the authenticated user is the owner of the post
        if ($post->uid != Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized']);
        }

        $post->title = $request->title;
        $post->content = $request->content;

        // Xử lý tải lên hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect('/home')->with('success', 'Post updated successfully.');
    }

    public function destroy($id) // Xóa bài viết
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->withErrors(['message' => 'Post not found']);
        }

        // Check if the authenticated user is the owner of the post
        if ($post->uid != Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized']);
        }

        $post->delete();

        return redirect('/home')->with('success', 'Post deleted successfully.');
    }
}
