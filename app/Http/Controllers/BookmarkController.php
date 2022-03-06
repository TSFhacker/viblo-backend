<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;


class BookmarkController extends Controller
{
    //
    function mark(Request $req)
    {
        $bookmark = new Bookmark;
        $bookmark->id=$req->input('id');
        $bookmark->user_id=$req->input('user_id');
        $bookmark->save();

        return $bookmark;
    }

    function find(Request $req)
    {
        $bookmark = Bookmark::where([
            ['id', '=', $req->input('id')],
            ['user_id', '=', $req->input('user_id')],
            ])->get();

        return $bookmark;
    }

    function bookmarklist(Request $req)
    {
        $data = Bookmark::join('posts', 'posts.id', '=', 'bookmarks.id')
                            ->join('users', 'users.id', '=', 'posts.user_id')
                            ->where('bookmarks.user_id', '=', $req->input('user_id'))
                            ->orderByDesc('posts.vote')
                            ->get(['posts.id', 'posts.vote', 'posts.title', 'users.name']);
        
        return $data;
    }
}
