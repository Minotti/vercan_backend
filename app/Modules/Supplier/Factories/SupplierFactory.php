<?php

namespace App\Modules\Supplier\Factories;

use App\Modules\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'PF',
            'legal_name' => fake()->name(),
            'trade_name' => fake()->name,
            'cpf_cnpj' => '22209877000120',
            'active' => true,
            'ie_indicator' => 'contribuinte',
            'ie' => '123123',
            'im' => '',
            'gathering' => 'retido',
            'observation' => '<p>Teste</p>'
        ];
    }
}
