<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente al factory.
     *
     * @var string
     */
    protected $model = Cita::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id'   => User::factory(),
            'doctor_id'    => User::factory(),
            'especialidad' => $this->faker->randomElement(['Cardiología', 'Pediatría', 'Dermatología', 'Medicina General']),
            'fecha_hora'   => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            'motivo'       => $this->faker->sentence(),
            'estado'       => 'pendiente',
        ];
    }

    /**
     * Estado para citas confirmadas.
     */
    public function confirmada(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'confirmada',
        ]);
    }

    /**
     * Estado para citas canceladas (opcional).
     */
    public function cancelada(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'cancelada',
        ]);
    }
}