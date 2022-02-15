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
    // show edit post form
    public function showEditForm($id){
        $post = Post::find($id);
        return view('post.edit', compact('post'));
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
        // if post is null redirect to home page
        if(!$post){
            return redirect()->route('home');
        }
        $author = $post->author_id;
        $user = User::find($author);
        // retrieve post comments from comments table
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        // add user to comments
        foreach($comments as $comment){
            $comment->user = User::find($comment->user_id);
        }
        return view('post', compact('post', 'comments','user'));
    }

    // add comment to post
    public function addComment(Request $request, $id){
        $comment = new Comment();
        $comment->post_id = $id;
        $comment->user_id = $request->user()->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

    // edit comment
    public function editComment(Request $request, $id){
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

    // delete comment
    public function deleteComment(Request $request, $id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back();
    }
}
