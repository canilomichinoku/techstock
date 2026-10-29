<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStock - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .login-left {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            top: -50%; right: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        }
        .login-left .logo {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 3rem;
            position: relative;
            z-index: 1;
        }
        .login-left .logo-icon {
            width: 50px; height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
        }
        .login-left h1 {
            font-size: 2rem; font-weight: 800;
            margin-bottom: 1rem;
            position: relative; z-index: 1;
        }
        .login-left p {
            font-size: 1rem; opacity: 0.9;
            line-height: 1.6;
            position: relative; z-index: 1;
        }
        .login-left .features {
            margin-top: 2rem;
            position: relative; z-index: 1;
        }
        .login-left .feature {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        .login-left .feature i { color: #93c5fd; }
        
        .login-right {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-right h2 {
            font-size: 1.8rem; font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        .login-right .subtitle {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        .form-label {
            font-weight: 500;
            color: #334155;
            font-size: 0.88rem;
            margin-bottom: 0.4rem;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        .input-group-text {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #64748b;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .btn-login {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.85rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            margin-top: 1rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }
        .alert {
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
        }
        .credentials-box {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.85rem;
        }
        .credentials-box strong { color: #1e293b; }
        .credentials-box code {
            background: white;
            padding: 2px 6px;
            border-radius: 4px;
            color: #2563eb;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .login-container { grid-template-columns: 1fr; }
            .login-left { padding: 2rem; }
            .login-left h1 { font-size: 1.5rem; }
            .login-right { padding: 2rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo">
                <div class="logo-icon"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div style="font-weight: 700; font-size: 1.3rem;">TechStock</div>
                    <div style="font-size: 0.8rem; opacity: 0.8;">Sistema de Inventario</div>
                </div>
            </div>
            <h1>Bienvenido de nuevo</h1>
            <p>Gestiona tu inventario de accesorios informáticos de forma profesional y eficiente.</p>
            <div class="features">
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Control de stock en tiempo real</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Alertas de stock bajo</div>
                <div class="feature"><i class="bi bi-check-circle-fill"></i> Reportes y movimientos</div>
            </div>
        </div>
        
        <div class="login-right">
            <h2>Iniciar Sesión</h2>
            <p class="subtitle">Ingresa tus credenciales para acceder al sistema</p>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    @error('password') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                </div>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                
                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar al Sistema
                </button>
            </form>
            
            <div class="credentials-box">
                <strong><i class="bi bi-info-circle me-1"></i>Credenciales de prueba:</strong><br>
                <small class="text-muted">Email: <code>admin@techstock.com</code></small><br>
                <small class="text-muted">Contraseña: <code>admin123</code></small>
            </div>
        </div>
    </div>
</body>
</html>