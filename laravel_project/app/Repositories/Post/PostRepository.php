<?php

namespace App\Repositories\Post;

use App\Interfaces\PostRepositoryInterface;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        $data = Post::with("user")->orderBy("created_at", "desc")->paginate(config('const.POSTS_PER_PAGE'));
        return $data;
    }

    public function getMyPosts()
    {
        $userId = auth()->user()->id;
        $data = Post::where("user_id",$userId)->orderBy('created_at', 'desc')->paginate(config('const.POSTS_PER_PAGE'));
        return $data;
    }

    public function getSearchPosts($request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();

        if(!empty($keyword)) {
            $posts = $query
                ->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }
        $data = $query->orderBy("created_at", "desc")->paginate(config('const.POSTS_PER_PAGE'));

        return $data;
    }
}