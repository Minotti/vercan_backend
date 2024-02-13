<?php

namespace Tests;

use App\Modules\User\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $http;

    /**
     * Set up Accept property on http client
     */
    public function makeClient()
    {
        return $this->http = $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    /**
     * Make login with credential and set token on http client
     * @param string $email
     * @param string $password
     * @return string $token
     *
     * @throws \Exception
     */
    public function signIn(?string $email = null, ?string $password = null): string
    {
        $email = $email ?? 'teste@teste.com';
        $password = $password ?? '123123';

        $response = $this->makeClient()->post('/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);

        if ($response->status() === 401) {
            throw new \Exception('Unauthorized');
        }

        return json_decode($response->content())->access_token;
    }

    public function additionalData(): array
    {
        return [
            'address' => [
                'city_id' => 1383,
                'postcode' => '78048405',
                'address' => 'Rua Acorizal',
                'district' => 'Consil',
                'number' => '133',
                'complement' => 'Ed. Monalisa Apto 504',
                'condominium' => 1
            ],
            'contacts' => [
                [
                    'additional' => false,
                    'company' => '',
                    'contacts' => [
                        'phone' => [
                            [
                                'phone' => '(65) 99999-9999',
                                'type' => 'residential'
                            ]
                        ],
                        'email' => [
                            [
                                'email' => 'teste@teste.com',
                                'type' => 'other'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}


