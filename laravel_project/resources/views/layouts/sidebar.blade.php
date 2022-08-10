<div class="list-group">
    <a href="{{route('home')}}" class="list-group-item">
        <span>一覧表示</span>
    </a>
    <a href="{{route('post.create')}}" class="list-group-item">
        <span>新規投稿</span>
    </a>
    <a href="{{route('home.mypost')}}" class="list-group-item">
        <span>自分の投稿</span>
    </a>
    <a href="{{route('home.mycomment')}}" class="list-group-item">
        <span>コメントした投稿</span>
    </a>
    <a href="{{route('profile.edit', auth()->user()->id)}}" class="list-group-item">
        <span>プロフィール編集</span>
    </a>
    @can("admin")
    <a href="{{route('profile.index')}}" class="list-group-item">
        <span>ユーザーアカウント</span>
    </a>
    @endcan
</div>