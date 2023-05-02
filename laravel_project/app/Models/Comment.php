<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read User $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = 
    [
        "comment",
        "post_id",
        "user_id"
    ];

    public function post()
    {
        return $this->belongsTo("App\Models\Post");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    static public function make($request)
    {
        $data = Comment::create([
            "comment"=> $request["comment"],
            "post_id" => $request["post_id"],
            "user_id" => auth()->user()->id
        ]);
        return $data;
    }

    static public function edit($request , $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->only(["comment"]));
        return $comment;
    }
}
