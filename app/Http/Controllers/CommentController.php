<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    function create(Request $req)
    {
        $cmt = new Comment;
        $cmt->post_id=$req->input('post_id');
        $cmt->user_id=$req->input('user_id');
        $cmt->content=$req->input('content');
        $cmt->vote=$req->input('vote');
        $cmt->save();

        $data = Comment::join('users', 'users.id', '=', 'comments.user_id')
                        ->where('comments.cmtid', '=', $cmt->cmtid)
                        ->get(['users.name', 'comments.*']);

        return $data;
    }

    function show(Request $req)
    {
        $data = Comment::join('users', 'users.id', '=', 'comments.user_id')
                        ->where('comments.post_id', '=', $req->input('post_id'))
                        ->orderByDesc('comments.vote')
                        ->get(['users.name', 'comments.*']);

        return $data;
                        
    }
}
