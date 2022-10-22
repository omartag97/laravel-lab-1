<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', compact('posts'));
    }

    public function create()
    {
        $users = User::get();
        return view('create', compact('users'));
    }

    public function store(Request $request)
    {
        Post::create([
            'user_id' => $request->user_selected,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->route('post.index');
    }

    public function edit(Request $request, $id)
    {
        $post = Post::findorFail($id);
        return view('edit', compact('post'));
    }

    public function update(Request $request , $id)
    {
        $post = Post::findorFail($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('post.index');
    }

    public function show(Request $request, $id)
    {
        $post = Post::findorFail($id);
        return view('view', compact('post'));
    }

    public function delete($id){
        Post::findorFail($id)->delete();
        return redirect()->route('post.index');

    }
}
