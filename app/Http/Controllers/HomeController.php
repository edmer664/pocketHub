<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //get all posts from database then display partially on home page
        $posts = Post::all();
        return view('home', compact('posts'));
    }
}
