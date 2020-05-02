@extends('../layout')

@section('title','グループ')

@section('content')
  <div class="group-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グループ</h1>
      </div>
      <div class="createGroupLink">
        <a href="{{ route('groups.create') }}">グループ新規作成</a>
      </div>
      <div class="searchGroup">
        <form action="/groups/search" method="get">
          <h1 class="search">検索</h1>
          <h2 class="category">カテゴリー</h2>
          <select name="category">
            <option value=""></option>
            <option value="study">勉強</option>
            <option value="sport">スポーツ</option>
            <option value="diet">ダイエット</option>
            <option value="sleep">睡眠</option>
          </select>
          <h2 class="sort">並び替え</h2>
          <select name="sort">
            <option value=""></option>
            <option value="asc">作成された日時が古い順</option>
            <option value="desc">作成された順が新しい順</option>
          </select>
          <h2 class="sort">フリーワード</h2>
          <input type="text" name="keyword"></br>
          <input type="submit" value="この条件で検索">
        </form>
      </div>
      <div class="groupIndex">
        @foreach($groups as $group)
          <div class="group">
            <h1>{{$group->name}}</h1>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection