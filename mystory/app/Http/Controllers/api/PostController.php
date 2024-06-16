<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function getAllMyPosts() // lấy tất cả các bài viết của người dùng hiện tại
    {
        $posts = Auth::user()->posts()->get();
        return response()->json(['posts' => $posts], 200);
    }
    public function getAllPostOfUser($uid){ // lấy tất cả bài viết của người dùng cụ thể
        $posts = Post::all()->where('uid',$uid);

        if (!$posts) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($posts);
    }

    public function getPostById($id){
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = new Post();
        $post->uid = Auth::id();
        $post->title = $request->title;
        $post->content = $request->content;

        // Xử lý tải lên hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts');
            $post->image = $imagePath;
        }

        $post->save();

        return response()->json(['post' => $post], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validate image if needed
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Check if the authenticated user is the owner of the post
        if ($post->uid != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $post->title = $request->title;
        $post->content = $request->content;

        // Xử lý tải lên hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts','public');
            $post->image = $imagePath;
        }

        $post->save();

        return response()->json(['post' => $post], 200);
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Check if the authenticated user is the owner of the post
        if ($post->uid != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
