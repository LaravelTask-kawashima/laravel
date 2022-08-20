<?php

namespace App\Repositories\Comment;

use App\Interfaces\CommentRepositoryInterface;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getMyComments()
    {
        $userId = auth()->user()->id;
        
        return Comment::where("user_id",$userId)->orderBy("created_at", "desc")->paginate(config('const.POSTS_PER_PAGE'));
    }
}