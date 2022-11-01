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

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().Str::random(30).'.'.$image->getClientOriginalExtension();
            $destPath = public_path('/images');
            $image->move($destPath,$name);
            $imagePath = 'images/' .$name;
        }

        Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index');

    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findorFail($id);
        $posts = Post::with('comments')->get();
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

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().Str::random(30).'.'.$image->getClientOriginalExtension();
            $destPath = public_path('/images');
            $image->move($destPath,$name);
            $imagePath = 'images/' .$name;
        }

        $post->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->title, '-'),
            'image' => $imagePath,
        ]);


        return redirect()->route('posts.index');

    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findorFail($id)->delete();
        return redirect()->route('posts.index');
    }

    public function archive()
    {

        $posts = Post::onlyTrashed()->get();

        return view('restore', compact('posts'));
    }

    public function restore($id)
    {
        Post::withTrashed()->find($id)->restore();

        return back();
    }

    public function restoreAll(Request $request)
    {


        Post::onlyTrashed()->restore();

        return back();
    }

    public function deleteOldPosts()
    {
        // dispatch((new PruneOldPostsJob($data));

        return Queue::push(new PruneOldPostsJob());


    }
}
