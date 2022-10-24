<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{


    public function storeComment(Request $request, $id)
    {
        // $post = Post::create($request->only(['comment']));

        $posts = new Post();
        $posts->comment = $request->comment;
        $posts->save;

        $comments = Comment::where('commentable_id', $id)->pluck('comment');


        Comment::create([
            'commentable_id' => $id,
            'commentable_type' => 'App\Models\Post',
            'comment' => $request->comment,
        ]);
        return back();
    }
}
