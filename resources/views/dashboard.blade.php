@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Panel de Control')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="kpi-card blue">
            <div class="kpi-icon blue"><i class="bi bi-box-seam"></i></div>
            <div><div class="kpi-value">{{ $totalProducts }}</div><div class="kpi-label">Total Productos</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card green">
            <div class="kpi-icon green"><i class="bi bi-tags"></i></div>
            <div><div class="kpi-value">{{ $totalCategories }}</div><div class="kpi-label">Categorías</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card orange">
            <div class="kpi-icon orange"><i class="bi bi-truck"></i></div>
            <div><div class="kpi-value">{{ $totalSuppliers }}</div><div class="kpi-label">Proveedores</div></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card red">
            <div class="kpi-icon red"><i class="bi bi-exclamation-triangle"></i></div>
            <div><div class="kpi-value text-danger">{{ $lowStockProducts }}</div><div class="kpi-label">Stock Bajo</div></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="card h-100">
            <div class="card-header"><i class="bi bi-pie-chart-fill text-primary me-2"></i>Productos por categoría</div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-exclamation-triangle text-warning me-2"></i>Productos con stock bajo</span>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Producto</th><th>Stock</th><th>Mínimo</th><th>Estado</th></tr></thead>
                    <tbody>
                        @forelse($lowStockList as $p)
                        <tr>
                            <td class="fw-semibold">{{ $p->name }}</td>
                            <td><span class="badge-stock-low">{{ $p->stock }}</span></td>
                            <td class="text-muted">{{ $p->min_stock }}</td>
                            <td><i class="bi bi-exclamation-circle-fill text-warning"></i></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">✅ No hay productos con stock bajo</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($categoryLabels) !!},
            datasets: [{
                data: {!! json_encode($categoryData) !!},
                backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 15, usePointStyle: true, pointStyle: 'circle' }
                }
            }
        }
    });
</script>
@endpush