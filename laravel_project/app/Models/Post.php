<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable =
    [
        "title",
        "body",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function comments()
    {
        return $this->hasMany("App\Models\Comment");
    }

    public function store($request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request['title'],
            'body' => $request['body']
        ]);
        return $post;
    }

    public function edit($inputs, $post)
    {
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->update();
        return $post;
    }
}
