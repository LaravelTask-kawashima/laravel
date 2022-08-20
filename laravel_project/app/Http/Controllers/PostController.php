<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PostController extends Controller
{

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * 新規投稿ページからのリクエストをDBに保存
     * @param  PostStoreRequest $request
     * @return \Illuminate\Http\Response json
     */
    public function store(PostStoreRequest $request)
    {
        $data = $this->post->store($request);
        return response()->json([
            "data" => $data
        ],Response::HTTP_OK);
    }

    /**
     * 投稿の詳細表示
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function show(int $id)
    {
        $post = Post::with('comments')->findOrFail($id);
        if ($post) {
            return response()->json([
                "post" => $post,
            ], Response::HTTP_OK);
        }
    }

    /**
     * 投稿内容編集
     *
     * @param  App\Http\Requests\PostUpdateRequest  $inputs
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response json
     */
    public function update(PostUpdateRequest $inputs, Post $post)
    {
        $this->authorize('update', $post);
        $data = $this->post->edit($inputs, $post);
        if ($data) {
            return response()->json([
                "data" => $data
            ], Response::HTTP_OK);
        }
    }

    /**
     * 投稿削除
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response json
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();
        if ($result) {
            return response()->json([
                'message' => __('message.post.delete')
            ],
            Response::HTTP_OK);
        }
    }
}
