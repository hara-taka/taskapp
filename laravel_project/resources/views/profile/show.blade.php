<div>
  <a href="{{ route('profile.edit', ['user_id' => $user_id]) }}">プロフィール編集</a>
  <a href="{{ route('profile.editPassword', ['user_id' => $user_id]) }}">パスワード変更</a>
  <h1>プロフィール</h1>
  <img src="{{ asset('storage/' . $profile->image) }}">
  <h2>ユーザー名:{{$profile->name}}</h2>
  <h2>性別：{{$profile->gender}}</h2>
  <h2>年齢:{{$profile->age}}</h2>
  <h2>自己紹介:{{$profile->comment}}</h2>
  <h2>メールアドレス:{{$profile->email}}</h2>
</div>