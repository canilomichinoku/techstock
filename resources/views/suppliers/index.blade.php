@extends('layouts.app')
@section('title', 'Proveedores')
@section('page-title', 'Gestión de Proveedores')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-truck me-2"></i>Listado de Proveedores</span>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Nuevo Proveedor</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th class="text-end">Acciones</th></tr></thead>
            <tbody>
                @forelse($suppliers as $s)
                <tr>
                    <td class="fw-semibold">{{ $s->name }}</td>
                    <td>{{ $s->email ?? '—' }}</td>
                    <td>{{ $s->phone ?? '—' }}</td>
                    <td class="text-muted">{{ $s->address ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('suppliers.edit', $s) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('suppliers.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">No hay proveedores.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection