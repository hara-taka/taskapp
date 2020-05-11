<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupsTest extends TestCase
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
        $response = $this->get(route('groups.index'));

        $response->assertStatus(200);
    }

    public function testSearch()
    {
        $response = $this->get(route('groups.search'));

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('groups.create'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->post(route('groups.store'));

        $response->assertStatus(200);
    }

    public function testDetails()
    {
        $response = $this->get(route('groups.details'));

        $response->assertStatus(200);
    }

    public function testParticipate()
    {
        $response = $this->post(route('groups.participate'));

        $response->assertStatus(200);
    }
}
