<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //get all posts from database then display on home page
        $posts = Post::all();
        //sort the posts from newest to oldest 
        $posts = $posts->sortByDesc('created_at');
        return view('home', compact('posts'));
    }
}
