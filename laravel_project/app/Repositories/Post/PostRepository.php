<?php

namespace App\Repositories\Post;

use App\Interfaces\PostRepositoryInterface;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::with("user")->orderBy("created_at", "desc")->paginate(5);
    }

    public function getMyPosts()
    {
        $userId = auth()->user()->id;
        return Post::where("user_id",$userId)->orderBy('created_at', 'desc')->paginate(5);
    }
}