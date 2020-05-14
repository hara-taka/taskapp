<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Group;
use App\GroupMember;

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

        $group = factory(Group::class)->create([
            'category' => 'study'
        ]);

        $searchResponse = $this->get('groups/search?category=study&sort=&keyword=');

        $searchResponse->assertSee($group->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('groups.create'));

        $response->assertStatus(200);

        $this->assertSee('作成');
    }

    public function testStore()
    {
        $response = $this->post(route('groups.store'));

        $response->assertStatus(200);

        $group = factory(Group::class)->create();

        $this->assertEquals(1, Group::count());
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
        $group_member = factory(GroupMember::class)->create();

        $response = $this->post(route('groups.participate', [$group_id => $group_member->group_id]));

        $response->assertStatus(200);

        $this->assertEquals(1, GroupMember::count());
    }
}
