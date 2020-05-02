@extends('../layout')

@section('title','グループ')

@section('content')
  <div class="groupDetails-wrapper">
    <div class="container">
      <div class="heading">
        <h1>グループ詳細</h1>
      </div>
      <div class="groupDetails">
        <h1>グループ名:{{$group->name}}</h1>
        <h1>ジャンル:{{$group->category}}</h1>
        @foreach($members as $member)
          <h1>{{$member->user->name}}</h1>
        @endforeach
        <h1>グループ紹介</h1>
        <h2>{{$group->comment}}</h2>
        <form action="{{ route('groups.participate', ['group_id' => $group->id]) }}" method="post">
          {{csrf_field()}}
          @if($group_member_num > 4)
            <h1>定員に達したため参加できません</h1>
          @endif
          <input type="submit" class="btn" value="このグループに参加する" {{ $group_member_num > 4 ? 'disabled="disabled"' : '' }}>
        </form>
      </div>
    </div>
  </div>
@endsection