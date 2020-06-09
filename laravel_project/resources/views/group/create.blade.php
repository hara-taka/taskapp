@extends('../layout')

@section('title','グループ')

@section('content')
  <div class="createGroup-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グループ作成</h1>
      </div>
      <div class="createGroup">
        <form action="{{ route('groups.store') }}" method="post">
          {{csrf_field()}}
          <h1>名前</h1>
          @error('name')
            <div class="error">{{ $message }}</div>
          @enderror
          <input type="text" name="name" value="{{old('name')}}">
          <h1>カテゴリー</h1>
          <select name="category">
            <option value="study">勉強</option>
            <option value="sport">スポーツ</option>
            <option value="diet">ダイエット</option>
            <option value="sleep">睡眠</option>
          </select>
          <h1>コメント</h1>
          @error('comment')
            <div class="error">{{ $message }}</div>
          @enderror
          <textarea name="comment" cols="50" rows="5"></textarea></br>
          <input type="submit" value="作成" class="btn">
        </form>
      </div>
    </div>
  </div>

@endsection