<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Throwable;

class PostController extends Controller
{

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * 新規投稿ページからのリクエストをDBに保存
     * @param  PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        try {
            $this->post->store($request);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            back()->with("message", "投稿失敗しました。");
        }
        return back()->with("message", "投稿完了しました。");
    }

    /**
     * 投稿の詳細表示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Log::error($e);
            return redirect()->route('home')->with('message', '表示する投稿がありません');
        }
        return view("post.show", compact("post"));
    }

    /**
     * 投稿編集画面の表示
     * 
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * 投稿内容編集
     *
     * @param  App\Http\Requests\PostUpdateRequest  $inputs
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $inputs, Post $post)
    {
        $this->authorize('update', $post);
        $this->post->edit($inputs, $post);
        return back()->with('message', '投稿を更新しました');
    }

    /**
     * 投稿削除
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }
}
