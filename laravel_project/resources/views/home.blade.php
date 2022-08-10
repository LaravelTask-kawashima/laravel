@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<h6><span class="mb-1 badge badge-secondary badge-pill badge-success">{{$user->name}}さんログイン中</span></h>

現在の登録者数：{{$user->count()}}
現在の投稿数：{{$total_posts->count()}}

@foreach ($posts as $post)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <div class="media-body ml-3"> <a href="{{route('post.show',$post->id)}}">{{ Str::limit($post->title,100,"...") }}</a>
                            <div class="text-muted small"> 投稿者：{{ $post->user->name }}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div><strong> {{$post->created_at->diffForHumans()}}</strong> </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>【投稿内容】</p>
                    <p> {{$post->body}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{!! $posts->links() !!}
@endsection