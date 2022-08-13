<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * 投稿に対するコメント投稿
     * @param  CommentStoreRequest $request
     * @return void
     */
    public function store(CommentStoreRequest $request)
    {
        Comment::create([
            "comment"=> $request["comment"],
            "post_id" => $request["post_id"],
            "user_id" => auth()->user()->id
        ]);
        return back();
    }

    /**
     * コメントの編集画面表示
     * @param  \Illuminate\Http\Comment $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    /**
     * コメントの編集
     * @param  \Illuminate\Http\CommentUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, $id)
    {
        Comment::edit($request,$id);
        return back()->with('message', 'コメントを更新しました');
    }

    /**
     * コメント削除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('message', 'コメントを削除しました');
    }
}
