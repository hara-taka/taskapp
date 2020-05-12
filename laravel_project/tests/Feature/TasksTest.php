<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
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
        $response = $this->post(route('tasks.store'));

        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $response = $this->get(route('tasks.edit'));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->post(route('tasks.update'));

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('tasks.destroy'));

        $response->assertStatus(200);
    }

    public function testShowRanking()
    {
        $response = $this->get(route('ranking.show'));

        $response->assertStatus(200);
    }
}
