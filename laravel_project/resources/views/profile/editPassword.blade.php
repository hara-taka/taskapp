@extends('../layout')

@section('title','プロフィール')

@section('content')
  <div class="editPassword-wrapper">
    <div class="container">
      <div class="heading">
        <h1>パスワード変更</h1>
      </div>
      <div class="editPassword">
        <form action="{{ route('profile.updatePassword', ['user_id' => $user_id]) }}" method="post">
          {{csrf_field()}}
          <h1>現在のパスワード</h1>
          <input type="password" name="current_password">
          <h1>新しいパスワード</h1>
          <input type="password" name="new_password">
          <h1>新しいパスワードの確認</h1>
          <input type="password" name="confirm_password"></br>
          <input type="submit" value="更新" class="btn">
        </form>
      </div>
    </div>
  </div>
@endsection