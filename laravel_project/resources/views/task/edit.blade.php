<div class="editTask_header">
  <h1>タスク編集</h1>
    <div class="taskEditWrapper">
      <form action="{{ route('tasks.update', ['user_id' => $user_id,'task_id' => $task->id]) }}" method="post">
        {{csrf_field()}}
          <input type="text" name="name" value="{{ $task -> name }}">
          <select name="status">
            <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>未完了</option>
            <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>完了</option>
          </select>
          <input type="submit" value="更新" class="btn">
      </form>
    </<div>
</div>