<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // 1️⃣ Get all posts
    public function index()
    {
        $posts = Post::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $posts
        ], 200);
    }

    // 2️⃣ Create new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

    // 3️⃣ Get single post
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $post
        ], 200);
    }

    // 4️⃣ Update post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post updated successfully',
            'data' => $post
        ], 200);
    }

    // 5️⃣ Delete post
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
