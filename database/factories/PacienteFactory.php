<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Http\Controllers\PacienteController;


class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    //protected $model = Paciente::class;
    protected $controller = PacienteController::class;
    public function definition()
    {
        $controller = [
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->streetAddress(),
            'cep' => $this->faker->postcode(),
            'bairro' => $this->faker->citySuffix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),
            'nome' => $this->faker->name(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->email(),
            'telefone' => $this->faker->tollFreePhoneNumber(),
            'data_nascimento' => $this->faker->date('Y-m-d'),
         ];

        return $controller;
    }
}
