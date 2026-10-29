@extends('layouts.app')
@section('title', 'Movimientos')
@section('page-title', 'Movimientos de Stock')

@section('content')
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Registrar Movimiento</div>
            <div class="card-body">
                <form action="{{ route('stock-movements.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Producto *</label>
                        <select name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                            <option value="">Seleccionar...</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" @selected(old('product_id') == $p->id)>{{ $p->name }} (Stock: {{ $p->stock }})</option>
                            @endforeach
                        </select>
                        @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo *</label>
                        <select name="type" class="form-select" required>
                            <option value="entrada" @selected(old('type') == 'entrada')>📥 Entrada (Aumenta stock)</option>
                            <option value="salida" @selected(old('type') == 'salida')>📤 Salida (Reduce stock)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad *</label>
                        <input type="number" name="quantity" min="1" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
                        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Motivo</label>
                        <input type="text" name="reason" class="form-control" value="{{ old('reason') }}" placeholder="Ej. Compra, Venta, Merma...">
                    </div>
                    <button class="btn btn-primary w-100"><i class="bi bi-check-lg me-1"></i>Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><i class="bi bi-clock-history me-2"></i>Historial de Movimientos</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Fecha</th><th>Producto</th><th>Tipo</th><th>Cant.</th><th>Antes</th><th>Después</th><th>Motivo</th></tr></thead>
                    <tbody>
                        @forelse($movements as $m)
                        <tr>
                            <td><small class="text-muted">{{ $m->created_at->format('d/m/Y H:i') }}</small></td>
                            <td class="fw-semibold">{{ $m->product->name }}</td>
                            <td>
                                @if($m->type === 'entrada')
                                    <span class="badge-type-entry">Entrada</span>
                                @else
                                    <span class="badge-type-exit">Salida</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $m->quantity }}</td>
                            <td class="text-muted">{{ $m->stock_before }}</td>
                            <td class="fw-semibold">{{ $m->stock_after }}</td>
                            <td><small>{{ $m->reason ?? '—' }}</small></td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">Sin movimientos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white py-3">{{ $movements->links() }}</div>
        </div>
    </div>
</div>
@endsection