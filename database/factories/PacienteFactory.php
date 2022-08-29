<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;


class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Paciente::class;
    public function definition()
    {
        $model = [
            'nome' => $this->faker->name(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->email(),
            'telefone' => $this->faker->tollFreePhoneNumber(),
            'data_nascimento' => $this->faker->date('Y-m-d'),
            'id_endereco' => $this->faker->numberBetween(1, 20)
         ];

        return $model;
    }
}
