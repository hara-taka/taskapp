<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
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

    public function testShow()
    {
        $response = $this->get(route('profile.show'));

        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $response = $this->get(route('profile.edit'));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $response = $this->post(route('profile.update'));

        $response->assertStatus(200);
    }

    public function testEditPassword()
    {
        $response = $this->get(route('profile.editPassword'));

        $response->assertStatus(200);
    }

    public function testUpdatePassword()
    {
        $response = $this->post(route('groups.updatePassword'));

        $response->assertStatus(200);
    }
}
