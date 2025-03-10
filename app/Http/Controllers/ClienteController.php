<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = Cliente::all();
            return view('clientes.index', compact('clientes'));
        } catch (\Exception $e) {
            Log::error('Error al obtener clientes: ' . $e->getMessage());
            return redirect()->route('clientes.index')->with('error', 'Error al cargar clientes.');
        }
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|size:8|unique:clientes,dni', // Validación del DNI exacto de 8 dígitos
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:255',
            'tipo_contrato' => 'required|in:con medidor,sin medidor'
        ]);

        try {
            Cliente::create($request->all());
            return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al crear cliente: ' . $e->getMessage());
            return redirect()->route('clientes.create')->with('error', 'Error al crear el cliente.');
        }
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'dni' => 'required|string|size:8|unique:clientes,dni,' . $cliente->id,
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:255',
            'tipo_contrato' => 'required|in:con medidor,sin medidor'
        ]);

        try {
            $cliente->update($request->all());
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar cliente: ' . $e->getMessage());
            return redirect()->route('clientes.edit', $cliente)->with('error', 'Error al actualizar el cliente.');
        }
    }

    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage());
            return redirect()->route('clientes.index')->with('error', 'Error al eliminar el cliente.');
        }
    }
}
