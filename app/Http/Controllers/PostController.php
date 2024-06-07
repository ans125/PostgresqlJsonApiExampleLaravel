<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'metadata' => 'nullable|array',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'metadata' => $request->metadata,
        ]);

        return response()->json($post, 200);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'string|max:255',
            'metadata' => 'nullable|array',
        ]);

        $post->update([
            'title' => $request->title ?? $post->title,
            'metadata' => $request->metadata ?? $post->metadata,
        ]);

        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 200);
    }
}
