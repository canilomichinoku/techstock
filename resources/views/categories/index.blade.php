@extends('layouts.app')
@section('title', 'Categorías')
@section('page-title', 'Gestión de Categorías')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-tags me-2"></i>Listado de Categorías</span>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Nueva Categoría</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Productos</th><th class="text-end">Acciones</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td class="fw-semibold">{{ $cat->name }}</td>
                    <td class="text-muted">{{ $cat->description ?? '—' }}</td>
                    <td><span class="badge-stock-ok">{{ $cat->products_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">No hay categorías.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection