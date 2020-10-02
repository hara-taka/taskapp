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
          <table>
            <tr>
              <td><h2>現在のパスワード</h2></td>
              <td>
                @error('current_password')
                  <div class="error">{{ $message }}</div>
                @enderror
                @if (session('error'))
                  <p class="error">
                    {{ session('error') }}
                  </p>
                @endif
                <input type="password" name="current_password">　
              </td>
            </tr>
            <tr>
              <td><h2>新しいパスワード</h2></td>
              <td>
                @error('new_password')
                  <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="new_password">
              </td>
            </tr>
            <tr>
              <td><h2>新しいパスワードの確認</h2></td>
              <td>
                @error('confirm_password')
                  <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="confirm_password">
              </td>
            </tr>
          </table>
          <input type="submit" value="更新" class="btn">
        </form>
      </div>
    </div>
  </div>
@endsection