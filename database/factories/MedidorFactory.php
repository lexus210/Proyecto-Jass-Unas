<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medidor;
use App\Models\Cliente;

class MedidorFactory extends Factory
{
    protected $model = Medidor::class;
    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'numero_serie' => $this->faker->unique()->numerify('M####'),
            'lectura_actual' => $this->faker->randomFloat(2, 0, 1000),
            'lectura_anterior' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}