@extends("layouts.app")
@section("content")
<div class="p-1 mb-1 bg-secondary text-white">投稿</div>
<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3">
            投稿者：{{$post->user->name}}
        </div>
        <h4>{{ $post->title }}</h4> <span class="ml-auto">
            @if(auth()->user()->id === $post->user_id)
            <a href="{{route('post.edit', $post)}}"><button class="btn btn-primary">編集</button></a>
            @endif
        </span>
        <span class="ml-2">
            @if(auth()->user()->id === $post->user_id)
            <form method="post" action="{{route('post.destroy', $post)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>
            @endif
        </span>
    </div>
    <div class="card-body">
        <p class="card-text">
            {{$post->body}}
        </p>
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$post->created_at->diffForHumans()}}
        </span>
    </div>
</div>
<hr>
<div class="p-1 mb-1 bg-secondary text-white">コメント</div>
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
@foreach ($post->comments as $comment)
<div class="card mb-4">
    <div class="card-header">
        投稿者：{{$comment->user->name}}
        <span class="ml-auto">
            @if(auth()->user()->id === $comment->user_id)
            <a href="{{route('comment.edit', $comment)}}"><button class="btn btn-primary">編集</button></a>
            @endif
        </span>
        <span class="ml-2">
            @if(auth()->user()->id === $comment->user_id)
            <form method="post" action="{{route('comment.destroy', $comment)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>
            @endif
        </span>
    </div>
    <div class="card-body">
        {{$comment->comment}}
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$comment->created_at->diffForHumans()}}
        </span>
    </div>
</div>
@endforeach



<div class="card mb-4">
    <form method="post" action="{{route('comment.store')}}">
        @csrf
        <input type="hidden" name='post_id' value="{{$post->id}}">
        <div class="form-group">
            <textarea name="comment" class="form-control" id="comment" cols="30" rows="5" placeholder="コメントを入力する">{{old('body')}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
        </div>
    </form>
</div>
@endsection