<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository)
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
        return response()->json([
            "posts" => $posts,
            'user' => $user,
        ], Response::HTTP_OK);
    }

    /**
     * 投稿から検索した結果を取得
     * @return view(home)
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = $this->postRepository->getSearchPosts($request);
        $user = auth()->user();
        return response()->json([
            'keyword' => $keyword,
            'posts' => $posts,
            'user' => $user,
        ], Response::HTTP_OK);
        
    }

    /**
     * ログインユーザーの投稿を取得
     * @return view(mypost)
     */
    public function mypost()
    {
        $posts = $this->postRepository->getMyPosts();
        return response()->json([
            'posts' => $posts,
        ], Response::HTTP_OK);
    }

    /**
     * ログインユーザーのコメントを取得
     * @return view(mycomment)
     */
    public function mycomment()
    {
        $comments = $this->commentRepository->getMyComments();
        return response()->json([
            'comments' => $comments,
        ], Response::HTTP_OK);
    }
}
