<div>
  <div class="createGroupButton_Wrapper">
     <a href="{{ route('groups.create') }}">グループ新規作成</a>
  </div>
  <div class="serach_Wrapper">
    <form>
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
          <option value=""></option>
          <option value=""></option>
        </select>
      <h1 class="sort">フリーワード</h1>
      <input type="text" name="freeword"></br>
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