<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);


        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/', $image);

        Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),
            'image' => $image,
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
        if (Storage::exists('/public/images/'. $post->image)) {
            Storage::delete('/public/images/'. $post->image);
        }
        // dd('deleted');

        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/', $image);

        Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),
            'image' => $image,
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

    public function deleteOldPosts()
    {
        // dispatch((new PruneOldPostsJob($data));

        return Queue::push(new PruneOldPostsJob());
    }
}
