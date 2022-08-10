<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $posts = Post::orderBy("created_at", "desc")->paginate(5);
        $user = auth()->user();
        $total_posts = Post::get();
        return View('home',compact("posts","user","total_posts"));
    }

    public function mypost()
    {
        $user = auth()->user()->id;
        $posts = Post::where("user_id",$user)->orderBy('created_at', 'desc')->paginate(5);
        return View("mypost",compact("posts"));
    }

    public function mycomment()
    {
        $user = auth()->user()->id;
        $comments = Comment::where("user_id",$user)->orderBy("created_at", "desc")->paginate(5);
        return View("mycomment",compact("comments"));
    }
}
