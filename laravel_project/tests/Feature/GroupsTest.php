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
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('groups.index'));

        $response->assertStatus(200);

        $response->assertSee('グループ新規作成');
    }

    public function testSearch()
    {
        $user = factory(User::class)->create();

        $group = factory(Group::class)->make([
            'category' => 'study'
        ]);

        $group->save();

        $response = $this->actingAs($user)->get('groups/search?category=study&sort=&keyword=');

        $response->assertSee($group->name);
    }

    public function testCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('groups.create'));

        $response->assertStatus(200);

        $response->assertSee('作成');
    }

    public function testStore()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/groups/store',[
            'name' => 'test_group',
            'category' => 'study',
            'comment' => 'test'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('groups', [
            'name' => 'test_group',
            'category' => 'study',
            'comment' => 'test'
        ]);
    }

    public function testDetails()
    {
        $group = factory(Group::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('groups.details', ['group_id' => $group->id]));

        $response->assertStatus(200);

        $response->assertSee($group->name);
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

        $response = $this->actingAs($user)->post('/groups/1');

        //$response->assertStatus(200);

        $this->assertDatabaseHas('group_members', [
            'group_id' => '1',
            'user_id' => '1'
        ]);
    }
}
