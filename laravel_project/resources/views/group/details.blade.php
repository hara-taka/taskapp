<div>
  <h1>{{$group->name}}</h1>
  <h1>{{$member}}</h1>
  <form action="{{ route('groups.participate', ['group_id' => $group_id,]) }}" method="post">
    {{csrf_field()}}
    @if($group_member_num > 5)
      <h1>定員に達したため参加できません</h1>
    @endif
    <input type="submit" value="このグループに参加する" {{ $group_member_num > 5 ? 'disabled="disabled"' : '' }}>
  </form>
</div>