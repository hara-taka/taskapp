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
          <table>
            <tr>
              <td><h2>名前</h2></td>
              <td>
                <input type="text" name="name" value="{{old('name')}}">
                @error('name')
                  <div class="error">{{ $message }}</div>
                @enderror
              </td>
            </tr>
            <tr>
              <td><h2>カテゴリー</h2></td>
              <td>
                <select name="category">
                  <option value="study">勉強</option>
                  <option value="sport">スポーツ</option>
                  <option value="diet">ダイエット</option>
                  <option value="sleep">睡眠</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><h2>コメント</h2></td>
              <td>
                <textarea name="comment" cols="50" rows="5"></textarea></br>
                @error('comment')
                  <div class="error">{{ $message }}</div>
                @enderror
              </td>
            </tr>

          </table>



          <input type="submit" value="作成" class="btn">
        </form>
      </div>
    </div>
  </div>

@endsection