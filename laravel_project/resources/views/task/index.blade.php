<div>
  <div class="personlTask">
    <div class="personalTask_header">
      <h1>タスク:{{$date}}</h1>
      <h2>達成率{{$achievment_rate}}％</h2>
        <div class="taskcreate">
          <form action="{{ route('tasks.store', ['user_id' => $user_id,'date' => $date]) }}" method="post">
          {{csrf_field()}}
            <input type="text" name="name">
            <select name="status">
              <option value="1">未完了</option>
              <option value="2">完了</option>
            </select>
            <input type="submit" value="追加" class="btn">
          </form>
          <div class="taskIndex_Wrapper">
            <table>
              @foreach($tasks as $task)
                <tr>
                  <td>{{$task->task_status}}</td>
                  <td> {{$task->name}}</td>
                  <td>
                  <a href="{{ route('tasks.edit', ['user_id' => $user_id,'task_id' => $task->id,'date' => $date ]) }}">編集</a>
                  </td>
                  <td>
                    <form action="{{ route('tasks.destroy', ['user_id' => $user_id,'task_id' => $task->id,'date' => $date]) }}" method="post">
                      @method('DELETE')
                      {{csrf_field()}}
                      <input type="submit" value="削除">
                    </form>
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
    </div>
  </div>
</div>