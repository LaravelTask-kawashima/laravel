@extends('layouts.email')

@section('content')

サイトへのアカウント仮登録が完了しました。<br>
<br>
以下のURLからログインして、本登録を完了させてください。<br>
{{url('/api/signup')}}

@endsection