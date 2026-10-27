@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Citas Médicas Agendadas</h1>
            <p class="text-slate-500 text-sm mt-1">Gestión y control de consultas agendadas en la clínica.</p>
        </div>
        <a href="{{ route('citas.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-600 text-white font-medium rounded-xl shadow-md hover:bg-brand-700 transition">
            + Agendar Nueva Cita
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-100/70 border-b border-slate-200 text-slate-600 text-xs uppercase font-semibold tracking-wider">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Paciente</th>
                    <th class="px-6 py-4">Médico</th>
                    <th class="px-6 py-4">Especialidad</th>
                    <th class="px-6 py-4">Fecha y Hora</th>
                    <th class="px-6 py-4">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse($citas as $cita)
                    <tr class="hover:bg-brand-50/50 transition">
                        <td class="px-6 py-4 font-semibold text-slate-900">#{{ $cita->id }}</td>
                        <td class="px-6 py-4 font-medium">{{ $cita->patient->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $cita->doctor->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 font-medium text-brand-600">{{ $cita->especialidad }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y h:i A') }}</td>
                        <td class="px-6 py-4">
                            @if($cita->estado === 'confirmada')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Confirmada</span>
                            @elseif($cita->estado === 'pendiente')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Pendiente</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">{{ ucfirst($cita->estado) }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            No hay citas médicas registradas en este momento.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection