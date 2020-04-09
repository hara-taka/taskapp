<div>
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
  <div>
    <h1>{{$dt->year}}年{{$dt->month}}月</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
            <th>{{ $dayOfWeek }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach (array_map(NULL, $dates, $tasks) as [ $date, $task ])
        @if ($date->dayOfWeek == 0)
        <tr>
        @endif
          <td>
            {{$date->day}}</br>
            {{$task}}
          </td>
        @if ($date->dayOfWeek == 6)
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>