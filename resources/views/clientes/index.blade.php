@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-cyan-600">{{ __('Clientes Registrados') }}</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-cyan-100 text-gray-700">
                    <tr>
                        <th class="border border-gray-300 px-4 py-3">ID</th>
                        <th class="border border-gray-300 px-4 py-3">Nombre</th>
                        <th class="border border-gray-300 px-4 py-3">Dirección</th>
                        <th class="border border-gray-300 px-4 py-3">Teléfono</th>
                        <th class="border border-gray-300 px-4 py-3">Correo</th>
                        <th class="border border-gray-300 px-4 py-3">Tipo de Contrato</th>
                        <th class="border border-gray-300 px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr class="border border-gray-300 hover:bg-cyan-50 transition">
                            <td class="border px-4 py-3 text-center">{{ $cliente->id }}</td>
                            <td class="border px-4 py-3">{{ $cliente->nombre }}</td>
                            <td class="border px-4 py-3">{{ $cliente->direccion }}</td>
                            <td class="border px-4 py-3 text-center">{{ $cliente->telefono }}</td>
                            <td class="border px-4 py-3">{{ $cliente->correo }}</td>
                            <td class="border px-4 py-3 text-center">{{ $cliente->tipo_contrato }}</td>
                            <td class="border px-4 py-3 text-center flex justify-center space-x-4">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="text-cyan-600 font-semibold hover:underline">
                                    {{ __('Editar') }}
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-semibold hover:underline">
                                        {{ __('Eliminar') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7" class="py-4 text-gray-500">{{ __('No hay clientes registrados') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('clientes.create') }}" class="bg-cyan-600 text-white font-semibold px-6 py-3 rounded-md shadow-md hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                {{ __('Agregar Cliente') }}
            </a>
        </div>
    </div>
@endsection