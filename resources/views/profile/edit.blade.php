@extends('layouts.app')
@section('title', 'Mi Perfil')
@section('page-title', 'Mi Perfil')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="position-relative d-inline-block mb-3">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                             alt="Avatar" 
                             class="rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #e2e8f0;">
                    @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary text-white"
                             style="width: 150px; height: 150px; font-size: 3.5rem; font-weight: 700;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="fw-bold mb-1">{{ auth()->user()->name }}</h4>
                <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    Miembro desde {{ auth()->user()->created_at->format('d/m/Y') }}
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-gear me-2"></i>Editar Información Personal
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nombre Completo *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Correo Electrónico *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Foto de Perfil</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Formatos: JPG, PNG, WEBP. Máximo 2MB.</small>
                            @error('avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-12">
                            <hr class="my-3">
                            <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock me-2"></i>Cambiar Contraseña</h6>
                            <small class="text-muted d-block mb-3">Deja en blanco si no deseas cambiarla.</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Contraseña Actual</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6"></div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Nueva Contraseña</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                        
                        <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection