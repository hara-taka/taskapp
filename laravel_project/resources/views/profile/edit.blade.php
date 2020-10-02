@extends('../layout')

@section('title','プロフィール')

@section('content')
  <div class="profileEdit-wrapper">
    <div class="container">
      <div class="heading">
        <h1>プロフィール編集</h1>
      </div>
      <div class="profileEdit">
        <form action="{{ route('profile.update', ['user_id' => $user_id]) }}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          <table>
            <tr>
              <td><h2>プロフィール画像</h2></td>
              <td>
                @error('image')
                  <div class="error">{{ $message }}</div>
                @enderror
                <input type="file" name="image">
              </td>
            </tr>
            <tr>
              <td><h2>ユーザー名</h2></td>
              <td>
                @error('name')
                  <div class="error">{{ $message }}</div>
                @enderror
                <input type="text" name="name" value="{{ $profile -> name }}">
              </td>
            </tr>
            <tr>
              <td><h2>性別</h2></td>
              <td>
                <select name="gender">
                  <option value=""></option>
                  <option value="1" {{ $profile->gender == 1 ? 'selected' : '' }}>男性</option>
                  <option value="2" {{ $profile->gender == 2 ? 'selected' : '' }}>女性</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><h2>年齢</h2></td>
              <td>
                <input type="number" name="age" value="{{ $profile -> age }}">
              </td>
            </tr>

            <tr>
              <td><h2>自己紹介</h2></td>
              <td>
                <textarea name="comment" rows="5" cols="40">{{$profile -> comment}}</textarea>
              </td>
            </tr>
            <tr>
              <td><h2>メールアドレス</h2></td>
              <td>
                @error('email')
                  <div class="error">{{ $message }}</div>
                @enderror
                <input type="text" name="email" value="{{ $profile -> email }}">
              </td>
            </tr>
          </table>
          <input type="submit" value="更新" class="btn">
        </form>
      </div>
    </div>
  </div>
@endsection