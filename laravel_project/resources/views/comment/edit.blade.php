@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">コメント編集</h1>
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form method="post" action="{{route('comment.update',$comment)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="comment">本文</label>
                    <textarea name="comment" class="form-control" id="comment_body" cols="30" rows="10">{{old('comment', $comment->comment)}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</div>
    
@endsection