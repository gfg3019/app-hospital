<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Endereco;

class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Endereco::class;

    public function definition()
    {
        $model =
        [
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->secondaryAddress(),
            'cep' => $this->faker->postcode(),
            'bairro' => $this->faker->cityPrefix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),
        ];
        return $model;
    }
}
