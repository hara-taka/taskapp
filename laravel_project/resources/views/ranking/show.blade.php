@foreach($personalTodayData as $key => $value)
<h1>{{$key}}:{{$value}}</h1>
@endforeach

------------------------------------
@foreach($personalOneWeekData as $key => $value)
<h1>{{$key}}:{{$value}}</h1>
@endforeach

-------------------------------------
@foreach($groupTodayData as $key => $value)
<h1>{{$key}}:{{$value}}</h1>
@endforeach

--------------------------------------
@foreach($groupOneWeekData as $key => $value)
<h1>{{$key}}:{{$value}}</h1>
@endforeach