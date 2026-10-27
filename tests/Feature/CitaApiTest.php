<?php

namespace Tests\Feature;

use App\Mail\NuevaCitaNotification;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CitaApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba: Consulta y Filtrado por Estado
     */
    public function test_muestra_citas_confirmadas(): void
    {
        Cita::factory()->confirmada()->create(['especialidad' => 'Cardiología']);
        Cita::factory()->create(['estado' => 'pendiente']);

        $response = $this->getJson('/api/citas?estado=confirmada');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['estado' => 'confirmada']);
    }

    /**
     * Prueba: Acción Autenticada, Persistencia y Envío de Correo
     */
    public function test_agendar_cita_y_envio_correo(): void
    {
        Mail::fake();

        $paciente = User::factory()->create();
        $medico = User::factory()->create();

        $response = $this->actingAs($paciente)
            ->postJson('/api/citas', [
                'doctor_id' => $medico->id,
                'especialidad' => 'Pediatría',
                'fecha_hora' => '2026-11-01 10:00:00',
                'motivo' => 'Consulta general',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('citas', [
            'patient_id' => $paciente->id,
            'doctor_id' => $medico->id,
            'especialidad' => 'Pediatría',
        ]);

        Mail::assertSent(NuevaCitaNotification::class, function ($mail) use ($medico) {
            return $mail->hasTo($medico->email);
        });
    }

    /**
     * Prueba: Diagnóstico y Prevención del Problema N+1
     */
    public function test_detecta_problema_n_mas_1(): void
    {
        $patient = User::factory()->create();
        $doctor = User::factory()->create();

        Cita::factory()->count(10)->create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

        $queryCount = 0;
        DB::listen(function ($query) use (&$queryCount) {
            $queryCount++;
        });

        $this->getJson('/api/citas');

        $this->assertLessThanOrEqual(3, $queryCount, "Se detectó problema N+1. Consultas ejecutadas: {$queryCount}");
    }
}