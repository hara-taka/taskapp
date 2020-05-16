<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Group;
use App\GroupMember;
use App\User;

class GroupsTest extends TestCase
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
        $response = $this->get(route('groups.index'));

        $response->assertStatus(200);

        $this->assertSee('グループ新規作成');
    }

    public function testSearch()
    {
        $response = $this->get(route('groups.search'));

        $response->assertStatus(200);

        $group = factory(Group::class)->make([
            'category' => 'study'
        ]);

        $group->save();

        $searchResponse = $this->get('groups/search?category=study&sort=&keyword=');

        $this->assertSee($group->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('groups.create'));

        $response->assertStatus(200);

        $this->assertSee('作成');
    }

    public function testStore()
    {
        $response = $this->post('/groups/store',[
            'name' => 'test_group',
            'category' => 'study',
            'comment' => 'test'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('groups', [
            'name' => 'test_group',
            'category' => 'study',
            'comment' => 'test'
        ]);
    }

    public function testDetails()
    {
        $group = factory(Group::class)->create();

        $response = $this->get(route('groups.details', [$group_id => $group->id]));

        $response->assertStatus(200);

        $this->assertSee($group->name);
    }

    public function testParticipate()
    {
        $group = factory(Group::class)->make([
            'id' => '1'
        ]);

        $group->save();

        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $user->save();

        $response = $this->post('/groups/id',[
            'group_id' => '1',
            'user_id' => '1'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('group_members', [
            'group_id' => '1',
            'user_id' => '1'
        ]);
    }
}
