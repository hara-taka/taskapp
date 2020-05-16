<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ProfileTest extends TestCase
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

    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.show', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee($user->name);
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.edit', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee($user->name);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $response = $this->post('/profile/1/update',[
            'name' => 'test_user'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'test_user'
        ]);
    }

    public function testEditPassword()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.editPassword', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee('現在のパスワード');
    }

    public function testUpdatePassword()
    {
        $user = factory(User::class)->make([
            'id' => '1'
        ]);
        $user->save();

        $response = $this->post('/profile/1/updatePassword',[
            'current_password' => 'test_oldPassword',
            'new_password' => 'test_newPassword'
        ]);

        $test_user = User::find(1);
        $user_pass = $test_user->password;
        $this->assertDatabaseHas('users', [
            'current_password' => $user_pass
        ]);
    }
}
