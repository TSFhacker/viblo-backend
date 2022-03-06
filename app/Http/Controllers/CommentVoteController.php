<?php

namespace App\Http\Controllers;
use App\Models\CommentVote;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    function add(Request $req)
    {
        $vote = new CommentVote;
        $vote->comment_id=$req->input('comment_id');
        $vote->user_id=$req->input('user_id');
        $vote->vote=$req->input('vote');
        $vote->save();

        $sum = CommentVote::where('comment_votes.comment_id', '=', $req->input('comment_id'))
                    ->sum('comment_votes.vote');
        Comment::where('comments.cmtid', '=', $req->input('comment_id'))
                    ->update(['comments.vote' => $sum]);
        
        return $vote;
    }

    function find(Request $req)
    {
        $vote = CommentVote::where([
            ['comment_id', '=', $req->input('comment_id')],
            ['user_id', '=', $req->input('user_id')],
            ])->get();

        return $vote;
    }

    function find2(Request $req)
    {
        $vote = CommentVote::where([
            ['comment_id', '=', $req->input('comment_id')],
            ['user_id', '=', $req->input('user_id')],
            ['vote', '=', $req->input('vote')],
            ])->get();

        return $vote;
    }

    function update(Request $req)
    {
        $vote = CommentVote::where([
            ['comment_id', '=', $req->input('comment_id')],
            ['user_id', '=', $req->input('user_id')],
            ])->update(['comment_votes.vote' => $req->input('vote')]);
        
        $sum = CommentVote::where('comment_votes.comment_id', '=', $req->input('comment_id'))
            ->sum('comment_votes.vote');
        Comment::where('comments.cmtid', '=', $req->input('comment_id'))
            ->update(['comments.vote' => $sum]);

        return $vote;
    }
}
