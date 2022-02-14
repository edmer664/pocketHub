<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        //get all posts from database then display on home page
        $posts = Post::all();
        //sort the posts from newest to oldest 
        $posts = $posts->sortByDesc('created_at');
        // get post author avatar
        foreach($posts as $post){
            $author = $post->author_id;
            $user = User::find($author);
            $avatar_path = $user->avatar_path;
            $post->author_avatar = $avatar_path;
            $post->first_name = $user->first_name;
            $post->last_name = $user->last_name;
            $post->user = $user;
        }
        return view('home', compact('posts'));
    }
}
