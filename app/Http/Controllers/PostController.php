<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        return view('index', compact('posts',));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();

        return view('create', compact('users'));
    }

    /**
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        Post::create([
            'user_id' => $request->user_selected,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),

        ]);


        return redirect()->route('post.index');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findorFail($id);
        // $posts = Post::all();
        $posts = Post::with('comments')->get();
        // $users = User::with('comments')->throw("posts")->get();
        // dd($users);
        return view('view', compact('post', 'posts'));
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $users = User::get();

        $post = Post::findorFail($id);

        return view('edit', compact('post', 'users'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findorFail($id);
        // $slug = SlugService::createSlug(Post::class, 'slug', $request->title);



        $post->update([
            'user_id' => $request->user_selected,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),
        ]);

        return redirect()->route('post.index');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findorFail($id)->delete();
        return redirect()->route('post.index');
    }

    public function restore()
    {

        $posts = Post::onlyTrashed()->get();

        return view('restore', compact('posts'));
    }


}
