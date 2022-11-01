<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __invoke()
    {
        return [
            'user' => auth()->user()
        ];
    }

    public function storeComment(Request $request, $id)
    {

        Comment::create([
            'commentable_id' => $id,
            'commentable_type' => 'App\Models\Post',
            'comment' => $request->comment,
        ]);
        return back();
    }
}
