<div>
  <div class="createGroupButton_Wrapper">
     <a href="{{ route('groups.create') }}">グループ新規作成</a>
  </div>
  <div class="serach_Wrapper">
    <form action="/groups/search" method="get">
      <h1>検索</h1>
      <h1 class="category">カテゴリー</h1>
        <select name="category">
          <option value=""></option>
          <option value="study">勉強</option>
          <option value="sport">スポーツ</option>
          <option value="diet">ダイエット</option>
          <option value="sleep">睡眠</option>
        </select>
      <h1 class="sort">並び替え</h1>
        <select name="sort">
          <option value=""></option>
          <option value="asc">作成された日時が古い順</option>
          <option value="desc">作成された順が新しい順</option>
        </select>
      <h1 class="sort">フリーワード</h1>
      <input type="text" name="keyword"></br>
      <input type="submit" value="この条件で検索">
    </form>
  </div>
  <div class="groupIndex_Wrapper">
    @foreach($groups as $group)
      <div>
        <h1>{{$group->name}}</h1>
      </div>
    @endforeach
  </div>
</div>