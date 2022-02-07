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

    //edit user post
    public function edit(Request $request, $id){
        $post = Post::find($id);
        $post->content = $request->content;
        $post->save();

        return redirect()->back();
    }

    //delete user post
    public function delete(Request $request, $id){
        $post = Post::find($id);
        $post->delete();

        return redirect()->back();
    }
}
