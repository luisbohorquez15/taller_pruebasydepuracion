@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-2">Agendar Nueva Cita Médica</h2>
        <p class="text-slate-500 text-sm mb-6">Complete la información para solicitar una consulta clínica.</p>

        <form action="{{ route('citas.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Médico Asignado</label>
                <select name="doctor_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-white">
                    <option value="" disabled selected>Seleccione un médico</option>
                    @foreach($doctores as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->email }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Especialidad Médica</label>
                <input type="text" name="especialidad" placeholder="Ej. Cardiología, Pediatría, Dermatología" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Fecha y Hora de la Consulta</label>
                <input type="datetime-local" name="fecha_hora" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Motivo de la Consulta</label>
                <textarea name="motivo" rows="4" placeholder="Describa brevemente el motivo..." required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition"></textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="{{ route('citas.index') }}" class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 font-medium transition">Cancelar</a>
                <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl shadow-md transition">
                    Guardar Cita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection