<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    //

    function addPost(Request $req)
    {
        $post = new Post;
        $post->title=$req->input('title');
        $post->slug=$req->input('slug');
        $post->content=$req->input('content');
        $post->user_id=$req->input('user_id');
        $post->vote=$req->input('vote');
        $post->save();

        return $post;
    }

    function list()
    {
        return Post::join('users', 'users.id', '=', 'posts.user_id')
        ->orderByDesc('posts.vote')
        ->get(['users.name', 'posts.*']);
    }

    function getPost($post_id)
    {
        return Post::find($post_id);
    }
}
