<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class HomeController extends Controller
{
    private PostRepositoryInterface $postRepository;

    /**
     * 
     * @return view(home)
     */
    public function __construct(PostRepositoryInterface $postRepository,CommentRepositoryInterface $commentRepository) 
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * 投稿データ取得
     * @return view(home)
     */
    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        $user = auth()->user();
        $total_posts = Post::get();
        return View('home', compact("posts", "user", "total_posts"));
    }

    /**
     * ログインユーザーの投稿を取得
     * @return view(mypost)
     */
    public function mypost()
    {
        $posts = $this->postRepository->getMyPosts();
        return View("mypost", compact("posts"));
    }

    /**
     * ログインユーザーのコメントを取得
     * @return view(mycomment)
     */
    public function mycomment()
    {
        $comments = $this->commentRepository->getMyComments();
        return View("mycomment", compact("comments"));
    }
}
