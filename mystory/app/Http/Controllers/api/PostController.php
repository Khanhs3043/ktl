<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getAllPostOfUser($uid){
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
}
