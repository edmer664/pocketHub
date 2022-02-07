<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // create user post
    public function create( Request $request){
        $post = new Post();
        $post->author_id = $request->user()->id;
        $post->content = $request->content;
        $post->save();

        return redirect()->back();
    }
}
