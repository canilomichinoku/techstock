<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechStock - @yield('title', 'Sistema')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #dbeafe;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --bg-body: #f1f5f9;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: var(--bg-body); color: var(--text-main); }
        
        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            width: 260px;
            position: fixed;
            left: 0; top: 0;
            padding: 1.5rem 0;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .sidebar-brand {
            display: flex; align-items: center; gap: 12px;
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 1.5rem;
        }
        .sidebar-brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }
        .sidebar-brand-text { color: white; font-weight: 700; font-size: 1.2rem; letter-spacing: -0.3px; }
        .sidebar-brand-text small { display: block; color: #94a3b8; font-size: 0.7rem; font-weight: 400; }
        
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.92rem;
            display: flex; align-items: center; gap: 12px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover { background: var(--sidebar-hover); color: white; transform: translateX(3px); }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }
        .sidebar .nav-link i { font-size: 1.1rem; width: 20px; }
        
        .sidebar-user {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--sidebar-bg);
        }
        .sidebar-user-avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.2);
        }
        .sidebar-user-avatar-placeholder {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600;
            border: 2px solid rgba(255,255,255,0.2);
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name { color: white; font-weight: 600; font-size: 0.88rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-email { color: #94a3b8; font-size: 0.72rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .main-content { margin-left: 260px; padding: 1.5rem 2rem; transition: margin-left 0.3s ease; min-height: 100vh; }
        
        .topbar {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 1.5rem;
        }
        .topbar h2 { margin: 0; font-size: 1.4rem; font-weight: 700; color: var(--text-main); }
        
        .user-menu { position: relative; }
        .user-menu-btn {
            background: var(--primary-light);
            border: none;
            border-radius: 30px;
            padding: 6px 14px 6px 6px;
            display: flex; align-items: center; gap: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .user-menu-btn:hover { background: #bfdbfe; }
        .user-menu-avatar { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
        .user-menu-avatar-placeholder {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 0.9rem;
        }
        .user-menu-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            min-width: 200px;
            padding: 0.5rem;
            display: none;
            z-index: 100;
        }
        .user-menu-dropdown.show { display: block; }
        .user-menu-dropdown a, .user-menu-dropdown button {
            display: flex; align-items: center; gap: 10px;
            padding: 0.6rem 0.8rem;
            color: var(--text-main);
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: background 0.2s;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }
        .user-menu-dropdown a:hover, .user-menu-dropdown button:hover { background: var(--bg-body); }
        .user-menu-dropdown .divider { height: 1px; background: #e2e8f0; margin: 0.3rem 0; }
        
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: all 0.25s; }
        .card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .card-header { background: white; border-bottom: 1px solid #e2e8f0; border-radius: 12px 12px 0 0 !important; padding: 1rem 1.25rem; font-weight: 600; }
        
        .kpi-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.25s;
            border-left: 4px solid transparent;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .kpi-card.blue { border-left-color: var(--primary); }
        .kpi-card.green { border-left-color: var(--success); }
        .kpi-card.orange { border-left-color: var(--warning); }
        .kpi-card.red { border-left-color: var(--danger); }
        .kpi-icon { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .kpi-icon.blue { background: var(--primary-light); color: var(--primary); }
        .kpi-icon.green { background: #dcfce7; color: var(--success); }
        .kpi-icon.orange { background: #fef3c7; color: var(--warning); }
        .kpi-icon.red { background: #fee2e2; color: var(--danger); }
        .kpi-value { font-size: 1.8rem; font-weight: 700; color: var(--text-main); line-height: 1; }
        .kpi-label { font-size: 0.82rem; color: var(--text-muted); margin-top: 4px; }
        
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border: none; border-radius: 8px; padding: 0.5rem 1.2rem; font-weight: 500; transition: all 0.2s; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35); }
        
        .table thead th { background: #f8fafc; color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; border: none; padding: 0.9rem 1rem; }
        .table tbody td { padding: 0.9rem 1rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
        .table tbody tr:hover { background: #f8fafc; }
        
        .badge-stock-ok { background: #dcfce7; color: #166534; padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.78rem; }
        .badge-stock-low { background: #fef3c7; color: #92400e; padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.78rem; }
        .badge-type-entry { background: #dcfce7; color: #166534; padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.78rem; }
        .badge-type-exit { background: #fee2e2; color: #991b1b; padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.78rem; }
        
        .form-control, .form-select { border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.6rem 0.9rem; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        .form-label { font-weight: 500; font-size: 0.88rem; }
        
        .alert { border: none; border-radius: 10px; padding: 0.9rem 1.2rem; }
        .alert-success { background: #dcfce7; color: #166534; border-left: 4px solid var(--success); }
        .alert-danger { background: #fee2e2; color: #991b1b; border-left: 4px solid var(--danger); }
        
        .sku-code { background: var(--primary-light); color: var(--primary-dark); padding: 3px 10px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; font-family: 'Courier New', monospace; }
        
        .btn-hamburger { display: none; background: var(--primary); color: white; border: none; border-radius: 8px; padding: 8px 12px; font-size: 1.2rem; }
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-content { margin-left: 0; padding: 1rem; }
            .btn-hamburger { display: inline-flex; }
            .topbar { flex-wrap: wrap; gap: 10px; }
            .topbar h2 { font-size: 1.1rem; }
            .kpi-value { font-size: 1.4rem; }
            .kpi-icon { width: 44px; height: 44px; font-size: 1.1rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-box-seam-fill"></i></div>
        <div class="sidebar-brand-text">TechStock<small>Sistema de Inventario</small></div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}"><i class="bi bi-box"></i> Productos</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}"><i class="bi bi-tags"></i> Categorías</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}"><i class="bi bi-truck"></i> Proveedores</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('stock-movements.*') ? 'active' : '' }}" href="{{ route('stock-movements.index') }}"><i class="bi bi-arrow-left-right"></i> Movimientos</a></li>
    </ul>
    
    <div class="sidebar-user">
        @if(auth()->user()->avatar)
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="sidebar-user-avatar" alt="Avatar">
        @else
            <div class="sidebar-user-avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        @endif
        <div class="sidebar-user-info">
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-email">{{ auth()->user()->email }}</div>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn-hamburger" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
            <h2>@yield('page-title', 'Panel')</h2>
        </div>
        
        <div class="user-menu">
            <button class="user-menu-btn" onclick="toggleUserMenu()">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="user-menu-avatar" alt="Avatar">
                @else
                    <div class="user-menu-avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                @endif
                <div class="d-none d-md-block">
                    <small class="d-block text-muted" style="font-size:0.7rem;">Bienvenido</small>
                    <strong style="font-size:0.85rem;">{{ auth()->user()->name }}</strong>
                </div>
                <i class="bi bi-chevron-down ms-1"></i>
            </button>
            <div class="user-menu-dropdown" id="userMenuDropdown">
                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-gear"></i> Mi Perfil
                </a>
                <div class="divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i><div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><div class="flex-grow-1">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    function toggleUserMenu() {
        document.getElementById('userMenuDropdown').classList.toggle('show');
    }
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('userMenuDropdown');
        const btn = e.target.closest('.user-menu');
        if (!btn && menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    });
</script>
@stack('scripts')
</body>
</html>