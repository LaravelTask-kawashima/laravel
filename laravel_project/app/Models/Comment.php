<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}