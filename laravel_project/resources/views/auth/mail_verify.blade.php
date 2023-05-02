@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレスをご確認ください') }}</div>
                <div class="card-body">
                    {{ __('入力していただいたメールアドレスをご確認ください。
                        もしメールが届いていない場合は再度仮登録を行なってください。') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection