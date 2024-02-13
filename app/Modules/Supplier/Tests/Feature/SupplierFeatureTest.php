<?php

namespace App\Modules\Supplier\Tests\Feature;

use App\Modules\Supplier\Models\Supplier;
use Database\Seeders\DatabaseSeederTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected string $token;

    protected $http;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeederTest::class);

        $this->token = $this->signIn();
        $this->http = $this->makeClient()->withToken($this->token);
    }

    /** @test */
    public function should_return_ok_status_when_no_has_suppliers()
    {
        $response = $this->http->get('/api/suppliers');

        $this->assertEquals($response->status(), 200);
    }

    /** @test */
    public function should_not_create_supplier_with_invalid_data()
    {
        $supplierData = Supplier::factory()->raw();

        $response = $this->http->post('/api/suppliers', $supplierData);
        $this->assertEquals($response->status(), 422);
    }

    /** @test */
    public function should_create_pf_supplier_with_valid_data()
    {
        $supplierData = Supplier::factory()->raw([
            'cpf_cnpj' => '01234567890',
            'rg' => '12345676',
            'name' => 'Marlon Minotti',
        ]);

        $additionalData = $this->additionalData();

        $supplierCompleteData = array_merge($supplierData, $additionalData);
        $response = $this->http->post('/api/suppliers', $supplierCompleteData);

        $this->assertEquals($response->status(), 201);
        $this->assertDatabaseCount('suppliers', 1);
    }

    /** @test */
    public function should_return_a_unique_supplier()
    {
        $supplier = Supplier::factory()->create();

        $response = $this->http->get('/api/suppliers/' . $supplier->id);

        $this->assertEquals($response->status(), 200);
        $this->assertEquals($response->json('data.id'), $supplier->id);
    }

    /** @test */
    public function should_be_invalid_when_try_delete_an_inexistent_supplier()
    {
        $response = $this->http->get('/api/suppliers/10');
        $this->assertEquals($response->status(), 404);
    }

    /** @test */
    public function should_delete_an_supplier()
    {
        Supplier::factory()->create();

        $response = $this->http->delete('/api/suppliers/1');
        $this->assertEquals($response->status(), 200);
    }

    /** @test */
    public function should_update_an_pf_supplier()
    {
        $supplier = Supplier::factory()->create();

        $additionalData = $this->additionalData();

        $supplierData = array_merge($supplier->toArray(), $additionalData);
        $supplierData['cpf_cnpj'] = '03450298100';
        $supplierData['rg'] = '1234567890';
        $supplierData['name'] = 'Marlon Minotti';

        $response = $this->http->put('/api/suppliers/1', $supplierData);

        $this->assertEquals($response->status(), 200);
        $this->assertEquals($response->json('data.cpf_cnpj'), '03450298100');
    }

    /** @test */
    public function should_not_change_an_pf_to_pj_supplier()
    {
        $supplier = Supplier::factory()->create();

        $additionalData = $this->additionalData();

        $supplierData = array_merge($supplier->toArray(), $additionalData);
        $supplierData['type'] = 'PJ';

        $response = $this->http->put('/api/suppliers/1', $supplierData);

        $this->assertEquals($response->status(), 422);
        $this->assertEquals($response->json('data.type'), 'Não é possível alterar o tipo do fornecedor');
    }
}
