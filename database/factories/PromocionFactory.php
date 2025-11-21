<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promocion>
 */
class PromocionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array de días de la semana aleatorios
        $dias = Arr::random(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'], rand(1, 5));

        return [
            'texto' => $this->faker->text(200),
            'fechaDesde' => $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d'),
            'fechaHasta' => $this->faker->dateTimeBetween('+2 weeks', '+2 months')->format('Y-m-d'),
            'idCategoriaMinima' => $this->faker->randomElement([1,2,3]),
            'diasSemana' => $dias,
            'estado' => $this->faker->randomElement(['Pendiente', 'Aprobada', 'Denegada']),
            'idLocal' => $this->faker->randomElement([1,5]),
        ];
    }
}











