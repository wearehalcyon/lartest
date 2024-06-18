<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Posts page
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(9);
        $postsAll = Post::all();
        return view('posts.index', compact('posts', 'postsAll'));
    }

    // Add post action
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    // Edit post action
    public function edit(Post $post)
    {
        return response()->json($post);
    }

    // Update post action
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('updated', 'Post card was updated successfully!');
    }

    // Delete post action
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('deleted', 'Post card was deleted successfully!');
    }
}
