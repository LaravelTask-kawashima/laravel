@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">投稿編集</h1>
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form method="post" action="{{route('post.update',$post)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" class="form-control" 
                    value="{{old('title', $post->title)}}" id="title" placeholder="タイトルを入力してください">
                </div>

                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{old('body', $post->body)}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</div>
    
@endsection