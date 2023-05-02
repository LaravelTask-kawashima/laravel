<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * 投稿に対するコメント投稿
     * @param  CommentStoreRequest $request
     * @return \Illuminate\Http\Response json
     */
    public function store(CommentStoreRequest $request)
    {
        $data = Comment::make($request);
        if ($data) {
            return response()->json([
                "data" => $data
            ], Response::HTTP_OK);
        }
    }

    /**
     * コメントの編集
     * @param  \Illuminate\Http\CommentUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function update(CommentUpdateRequest $request, $id)
    {
        $data = Comment::edit($request, $id);
        if ($data) {
            return response()->json([
                "data" => $data
            ], Response::HTTP_OK);
        }
    }

    /**
     * コメント削除
     * @param  \Illuminate\Http\Comment $comment
     * @return \Illuminate\Http\Response json
     */
    public function destroy(Comment $comment)
    {
        $result = $comment->delete();
        if ($result) {
            return response()->json([
                'message' => __('message.comment.delete')
            ], Response::HTTP_OK);
        }
    }
}
