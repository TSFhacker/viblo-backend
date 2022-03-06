<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostVote;
use App\Models\Post;

class PostVoteController extends Controller
{
    //
    function add(Request $req)
    {
        $vote = new PostVote;
        $vote->post_id=$req->input('post_id');
        $vote->user_id=$req->input('user_id');
        $vote->vote=$req->input('vote');
        $vote->save();

        $sum = PostVote::where('post_votes.post_id', '=', $req->input('post_id'))
                    ->sum('post_votes.vote');
        Post::where('posts.id', '=', $req->input('post_id'))
                    ->update(['posts.vote' => $sum]);
        
        return $vote;
    }

    function find(Request $req)
    {
        $vote = PostVote::where([
            ['post_id', '=', $req->input('post_id')],
            ['user_id', '=', $req->input('user_id')],
            ])->get();

        return $vote;
    }

    function find2(Request $req)
    {
        $vote = PostVote::where([
            ['post_id', '=', $req->input('post_id')],
            ['user_id', '=', $req->input('user_id')],
            ['vote', '=', $req->input('vote')],
            ])->get();

        return $vote;
    }

    function update(Request $req)
    {
        $vote = PostVote::where([
            ['post_id', '=', $req->input('post_id')],
            ['user_id', '=', $req->input('user_id')],
            ])->update(['post_votes.vote' => $req->input('vote')]);
        
        $sum = PostVote::where('post_votes.post_id', '=', $req->input('post_id'))
            ->sum('post_votes.vote');
        Post::where('posts.id', '=', $req->input('post_id'))
            ->update(['posts.vote' => $sum]);

        return $vote;
    }
}
