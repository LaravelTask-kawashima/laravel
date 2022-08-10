<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("post.create");
    }

    /**
     * 新規投稿ページを表示
     * @return view("post.create")
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * 新規投稿ページからのレスポンスをDBに保存
     * @param  PostStoreRequest $request
     * @return view("post.create"),message
     */
    public function store(PostStoreRequest $request)
    {
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->fill($request->all())->save();
        return back()->with("message", "投稿完了しました。");
    }

    /**
     * 投稿の詳細表示
     * @param  int  $id
     * @return view("post.show"),post
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(is_null($post)){
            return redirect()->route('home')->with('message', '表示する投稿がありません');
        }
        return view("post.show", compact("post"));
    }

    /**
     * 投稿編集画面の表示
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $inputs, Post $post)
    {
        $this->authorize('update', $post);
        $post->fill($inputs->all())->save();
        return back()->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }
}
