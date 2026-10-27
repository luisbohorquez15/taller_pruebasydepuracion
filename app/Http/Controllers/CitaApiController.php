<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Mail\NuevaCitaNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class CitaApiController extends Controller
{
    // Endpoint con Eager Loading para prevenir problema N+1
    public function index(Request $request): JsonResponse
    {
        $query = Cita::with(['patient', 'doctor']);

        if ($request->has('estado')) {
            $query->where('estado', $request->query('estado'));
        }

        return response()->json($query->get());
    }

    // Agendar cita, persistir y enviar correo
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'especialidad' => 'required|string',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string',
        ]);

        $cita = Cita::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $validated['doctor_id'],
            'especialidad' => $validated['especialidad'],
            'fecha_hora' => $validated['fecha_hora'],
            'estado' => 'pendiente',
            'motivo' => $validated['motivo'],
        ]);

        Mail::to($cita->doctor->email)->send(new NuevaCitaNotification($cita));

        return response()->json($cita, 201);
    }
}