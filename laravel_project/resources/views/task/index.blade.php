<div>
  <div class="personlTask">
    <div class="personalTask_header">
      <h1>タスク</h1>
        <div class="personalTask_sub">
          <h2>達成率{{}}％<h2>
          <input type="bottun" value="タスクの編集" onclick="#">
            <div class="taskIndex_Wrapper">
              ＠foreach($tasks as $task)
                <div class="taskIndex">
                  <h2 class="taskName">{{$task->name}}</h2>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>