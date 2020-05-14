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

        $response = $this->get(route('tasks.index', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee('追加');
    }

    public function testStore()
    {
        $task = factory(Task::class)->create();

        $response = $this->post(route('tasks.store', [$user_id => $task->user_id]));

        $response->assertStatus(200);

        $this->assertEquals(1, User::count());
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create();

        $response = $this->get(route('tasks.edit', [$user_id => $task->user_id, $task_id => $task->id]));

        $response->assertStatus(200);

        $this->assertSee($task->name);
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create();

        $response = $this->post(route('tasks.update', [$user_id => $task->user_id, $task_id => $task->id]));

        $response->assertStatus(200);

        $task->name = 'test_user';
        $task->save();

        $this->assertDatabaseHas('tasks', [
            'name' => 'test_user'
        ]);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create();

        $response = $this->delete(route('tasks.destroy', [$user_id => $task->user_id, $task_id => $task->id]));

        $response->assertStatus(200);

        $this->assertEquals(0, User::count());
    }

    public function testShowRanking()
    {
        $response = $this->get(route('ranking.show'));

        $response->assertStatus(200);

        $this->assertSee('個人（当日）');
    }
}
