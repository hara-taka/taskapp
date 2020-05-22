<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\User;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('tasks.index', ['user_id' => $user->id, 'date' => '2020-01-01']));

        $response->assertStatus(200);

        $response->assertSee('追加');
    }

    public function testStore()
    {
        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $user->save();

        $response = $this->post('/tasks/1/2020-01-01/store',[
            'name' => 'test_task',
            'status' => '2'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'name' => 'test_task',
            'status' => '2'
        ]);
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create();

        $response = $this->get(route('tasks.edit', ['user_id' => $task->user_id, 'task_id' => $task->id, 'date' => $task->date]));

        $response->assertStatus(200);

        $response->assertSee($task->name);
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->make([
            'id' => '1',
            'user_id' => '1'
        ]);

        $task->save();

        $response = $this->post('/tasks/1/1/2020-01-01/update',[
            'name' => 'test_task',
            'status' => '2'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'name' => 'test_task',
            'status' => '2'
        ]);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create();

        $response = $this->delete(route('tasks.destroy', ['user_id' => $task->user_id, 'task_id' => $task->id, 'date' => $task->date]));

        $response->assertStatus(302);

        $this->assertEquals(0, Task::count());
    }

    public function testShowRanking()
    {
        $task = factory(Task::class)->create();

        $response = $this->get(route('ranking.show'));

        //$response->assertStatus(200);

        $response->assertSee('個人（当日）');
    }
}
