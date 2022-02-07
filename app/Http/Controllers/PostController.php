<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

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

    //show post
    public function show(Request $request, $id){
        $post = Post::find($id);
        $author = $post->author_id;
        $user = User::find($author);
        $avatar_path = $user->avatar_path;
        $post->author_avatar = $avatar_path;
        // retrieve post comments from comments table
        $comments = Comment::where('post_id', $id)->get();
        return view('post', compact('post', 'comments'));
    }

    // add comment to post
    public function addComment(Request $request, $id){
        $comment = new Comment();
        $comment->post_id = $id;
        $comment->author_id = $request->user()->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

}
