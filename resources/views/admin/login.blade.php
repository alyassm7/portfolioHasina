@extends('admin.layouts.guest')

@section('title', 'Connexion')

@section('content')
    <div class="admin-login-page">
        <div class="admin-login-top">
            <button class="admin-theme-toggle" id="adminThemeToggle" aria-label="Changer le thème" title="Changer le thème">
                <i class="fas fa-sun"></i>
            </button>
        </div>
        <div class="admin-login-card">
            <div class="admin-login-logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Administration</h3>
            <p class="admin-login-subtitle">Connectez-vous pour gérer votre portfolio</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@hasina.dev">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                </button>
            </form>
        </div>
    </div>
@endsection
