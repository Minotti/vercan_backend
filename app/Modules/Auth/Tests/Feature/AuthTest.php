<?php

namespace App\Modules\Auth\Tests\Feature;

use Database\Seeders\CreateTestUserSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CreateTestUserSeeder::class);
        $this->http = $this->makeClient();
    }

    /** @test */
    public function should_unauthorized_with_invalid_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    public function should_authorize_when_has_valid_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'teste@teste.com',
            'password' => '123123'
        ]);

        $this->assertEquals(200, $response->status());
    }

    /** @test  */
    public function should_return_unauthorized_when_try_access_private_route()
    {
        $response = $this->http->get('/api/suppliers');
        $this->assertEquals(401, $response->status());
    }

    /** @test */
    public function should_authorize_when_token_is_valid()
    {
        $token = $this->signIn('teste@teste.com', '123123');
        $response = $this->makeClient()->withToken($token)->get('/api/suppliers');

        $this->assertEquals(200, $response->status());
    }
}
