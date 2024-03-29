@extends('layouts.app')
@section('content')

{{-- メッセージ表示 --}}
@if(session('message'))
<div class="col-8 mx-auto alert alert-success">{{session('message')}}</div>
@endif


<div class="container ml-auto col-12 col-md-10 col-lg-8" style="background-color:white;">
    <div class="row">
        <div class="col-md-10 mt-6 mx-auto">
            <div class="card-body">
                <h1 class="mt4">ユーザー情報編集</h1>
                <form method="post" action="{{route('profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name', $user->name)}}">
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email', $user->email)}}">
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input id="password" type="password" 
                        class="form-control" name="password" placeholder="パスワードを入力してください" 
                        required autocomplete="new-password">

                    </div>

                    <div class="form-group">
                        <label for="password">パスワード再入力</label>
                        <input id="password-confirm" type="password" class="form-control" 
                        name="password_confirmation" placeholder="パスワードを再入力してください" 
                        required autocomplete="new-password">
                    </div>

                    <button type=”submit” class="btn btn-success">送信する</button>
                </form>
            </div>
        </div>      
    </div>
</div>

@endsection
