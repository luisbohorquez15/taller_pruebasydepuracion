<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use App\Mail\NuevaCitaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CitaWebController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['patient', 'doctor'])->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $doctores = User::all();
        return view('citas.create', compact('doctores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'especialidad' => 'required|string',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string',
        ]);

        // Usa el usuario en sesión o toma el primer usuario de la base de datos como fallback
        $patientId = auth()->id() ?? User::first()?->id;

        $cita = Cita::create([
            'patient_id' => $patientId,
            'doctor_id' => $validated['doctor_id'],
            'especialidad' => $validated['especialidad'],
            'fecha_hora' => $validated['fecha_hora'],
            'estado' => 'pendiente',
            'motivo' => $validated['motivo'],
        ]);

        Mail::to($cita->doctor->email)->send(new NuevaCitaNotification($cita));

        return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
    }
}