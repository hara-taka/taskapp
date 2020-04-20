<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
  <div class="profile-wrapper">
    <div class="container">
      <div class="heading">
        <h1>プロフィール</h1>
      </div>
      <div class="profile">
        <img src="{{ asset('storage/' . $profile->image) }}">
        <a href="{{ route('profile.edit', ['user_id' => $user_id]) }}" class="profileEdit">プロフィール編集</a>
        <a href="{{ route('profile.editPassword', ['user_id' => $user_id]) }}" class="passwordEdit">パスワード変更</a>
        <h1>ユーザー名</h1>
        <h2>{{$profile->name}}</h2>
        <h1>性別</h1>
        <h2>{{$profile->gender}}</h2>
        <h1>年齢</h1>
        <h2>{{$profile->age}}</h2>
        <h1>自己紹介</h1>
        <h2>{{$profile->comment}}</h2>
      </div>
    </div>
  </div>
  <div class="calendar-wrapper">
    <div class="container">
      <div class="heading">
        <h1>カレンダー</h1>
      </div>
      <div class="calendar">
        <h1>
          <a href="{{ route('profile.show', ['user_id' => $user_id,'dt' => $dt,'change_month' => 'prev']) }}">前月</a>
          <span>{{$dt->year}}年{{$dt->month}}月</span>
          <a href="{{ route('profile.show', ['user_id' => $user_id,'dt' => $dt,'change_month' => 'next']) }}">翌月</a>
        </h1>
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
                  <a href="{{ route('tasks.index', ['user_id' => $user_id,'date' => $date]) }}">{{ $date->day}}</a></br>
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
  </div>
  <div class="graph-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グラフ</h1>
      </div>
      <canvas id="Chart"></canvas>
      <script>
        const $oneWeekTaskDate = @json($oneWeekTaskDate);
        const $oneWeekTaskAchievement = @json($oneWeekTaskAchievement);
        var ctx = document.getElementById("Chart");
        var barChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [$oneWeekTaskDate[0],$oneWeekTaskDate[1],$oneWeekTaskDate[2],$oneWeekTaskDate[3],$oneWeekTaskDate[4],$oneWeekTaskDate[5],$oneWeekTaskDate[6]],
            datasets: [
              {
                label: 'タスク達成率',
                data: [$oneWeekTaskAchievement[0],$oneWeekTaskAchievement[1],$oneWeekTaskAchievement[2],$oneWeekTaskAchievement[3],$oneWeekTaskAchievement[4],$oneWeekTaskAchievement[5],$oneWeekTaskAchievement[6]],
                borderColor: "rgba(255,255,255,1)",
                backgroundColor: "#4444FF"
              },
            ],
          },
          options: {
            title: {
              display: true,
              text: $oneWeekTaskDate[0]+'  ~  '+$oneWeekTaskDate[6]
            },
            scales: {
              yAxes: [{
                ticks: {
                  suggestedMax: 100,
                  suggestedMin: 0,
                  stepSize: 10,

                }
              }]
            },
          }
        });
      </script>
    </div>
  </div>
</body>
</html>