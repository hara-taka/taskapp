<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<div class="profileEdit-wrapper">
  <div class="container">
    <div class="heading">
      <h1>プロフィール編集</h1>
    </div>
    <div class="profileEdit">
      <form action="{{ route('profile.update', ['user_id' => $user_id]) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <h1>プロフィール画像</h1>
        <input type="file" name="image">
        <h1>ユーザー名</h1>
        <input type="text" name="name" value="{{ $profile -> name }}">
        <h1>性別</h1>
        <select name="gender">
          <option value=""></option>
          <option value="1" {{ $profile->gender == 1 ? 'selected' : '' }}>男性</option>
          <option value="2" {{ $profile->gender == 2 ? 'selected' : '' }}>女性</option>
        </select>
        <h1>年齢</h1>
        <input type="number" name="age" value="{{ $profile -> age }}">
        <h1>自己紹介</h1>
        <textarea name="comment" rows="5" cols="40">{{$profile -> comment}}</textarea>
        <h1>メールアドレス</h1>
        <input type="text" name="email" value="{{ $profile -> email }}"></br>
        <input type="submit" value="更新" class="btn">
      </form>
    </div>
  </div>
</<div>