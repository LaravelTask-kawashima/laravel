<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

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
            "post_id" => $request->post_id,
            "user_id" => auth()->user()->id
        ]);
        return back();
    }

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->only(["comment"]));
        return back()->with('message', 'コメントを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('message', 'コメントを削除しました');
    }
}
