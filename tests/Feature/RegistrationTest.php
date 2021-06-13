<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function creates_a_user_from_a_resource_object()
    {

        $response = $this->postJson('/api/v1/users/signup', [
            'data' => [
                'type' => 'users',
                'attributes' => [
                    'name' => 'John Doe',
                    'username' => 'JonDoh',
                    'email' => 'Jondoe@yahoo.com',
                    'password' => 'password',
                ]
                ],
                [
                    'accept' => 'application/vnd.api+json',
                    'content-type' => 'application/vnd.api+json',
                ]
        ]);

        $response->assertStatus(201)
                ->assertJson([
                'data' => [
                    'id' => '1',
                    'type' => 'users',
                    'attributes' => [
                        'name' => 'John Doe',
                        'username' => 'JonDoh',
                        'email' => 'Jondoe@yahoo.com',
                        'password' => 'password',
                        'created_at' =>now()->setMilliseconds(0)->toJSON(),
                        'updated_at' =>now()->setMilliseconds(0)->toJSON(),
                    ]
                ],
            ]);
            $this->assertDatabaseHas('users', [
                'id' => 1,
                'name' => 'John Doe',
                'username' => 'JonDoh',
                'email' => 'Jondoe@yahoo.com',
                'password' => 'password',
            ]);
    }
}
