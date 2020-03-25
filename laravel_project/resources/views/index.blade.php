<div>
  <div class="personlTask">
    <div class="personalTask_header">
      <h1>タスク</h1>
      <h2>達成率％</h2>
        <div class="taskcreate">
          <form action='{{ route('tasks.store', ['user_id' => $user_id]) }}' method="post">
          {{csrf_field()}}
            <input type="text" name="name">
            <input type="submit" value="追加" class="btn">
            <div class="taskIndex_Wrapper">
              <table>
                {{--@foreach($tasks as $task)
                  <tr>
                    <td> {{$task->name}}</td>
                    <td>
                      <form action='{{ route('tasks.edit', ['user_id' => $user_id,'task_id' => $task->id ]) }}' method="get">
                      　{{csrf_field()}}
                      　<input type="submit" value="編集" class="btn">
                      </form>
                    </td>
                    <td>
                      <form action='{{ route('tasks.destroy', ['user_id' => $user_id,'task_id' => $task->id ]) }}' method="delete">
                      　{{csrf_field()}}
                      　<input type="submit" value="削除" class="btn">
                      </form>
                    </td>
                  </tr>
                @endforeach--}}
              </table>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>