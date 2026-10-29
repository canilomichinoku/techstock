@extends('layouts.app')
@section('title', 'Productos')
@section('page-title', 'Gestión de Productos')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Buscar</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Buscar por nombre o SKU...">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Filtrar por Categoría</label>
                <select name="category_id" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary flex-grow-1"><i class="bi bi-search me-1"></i>Buscar</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary" title="Limpiar"><i class="bi bi-x-lg"></i></a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Listado de Productos</span>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Nuevo Producto</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>SKU</th><th>Nombre</th><th>Categoría</th><th>Proveedor</th>
                    <th>Precio</th><th>Stock</th><th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td><span class="sku-code">{{ $p->sku }}</span></td>
                    <td class="fw-semibold">{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>{{ $p->supplier->name }}</td>
                    <td>S/ {{ number_format($p->price, 2) }}</td>
                    <td>
                        @if($p->stock <= $p->min_stock)
                            <span class="badge-stock-low"><i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $p->stock }}</span>
                        @else
                            <span class="badge-stock-ok"><i class="bi bi-check-circle-fill me-1"></i>{{ $p->stock }}</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No se encontraron productos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-3">{{ $products->links() }}</div>
</div>
@endsection