<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $id) {
        $comment = new Comment(["post_id"=>$id, "user_id"=>Auth::user()->id, "comment"=>$request->input("comment")]);
        $comment->save();

        return redirect("/posts/$id");
    }
}
