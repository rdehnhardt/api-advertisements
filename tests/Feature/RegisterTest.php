<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    public function testRegisterNewUser()
    {
        $password = $this->faker()->password();

        $response = $this->json('POST', '/register', [
            'name' => $this->faker()->name,
            'email' => $this->faker()->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response
            ->assertStatus(201)
            ->assertExactJson([
                'message' => 'ok'
            ]);
    }

    /**
     * @expectedExceptionCode 23000
     */
    public function testRegisterDuplicatedUsers()
    {
        $password = $this->faker()->password();
        $data = [
            'name' => $this->faker()->name,
            'email' => $this->faker()->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $this->json('POST', '/register', $data);
        $this->json('POST', '/register', $data);
    }
}
