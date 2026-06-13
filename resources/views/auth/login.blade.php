@extends('layouts.layout')

@section('title', 'Вход — ServiceName')

@push('scripts')
{!! NoCaptcha::renderJs() !!}
@endpush

@push('styles')
<style>
  .auth-section {
    min-height: calc(100vh - 180px);
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 0;
    position: relative;
  }
  .auth-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--accent), var(--steel-light), var(--accent));
  }
  .auth-card {
    background: var(--white);
    border-radius: 6px;
    padding: 2.5rem 2rem;
    width: 100%;
    max-width: 460px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    position: relative;
  }
  .auth-card::after {
    content: '';
    position: absolute;
    top: -2px; left: 20px; right: 20px;
    height: 4px;
    background: var(--accent);
    border-radius: 0 0 4px 4px;
  }
  .auth-logo {
    text-align: center;
    margin-bottom: 2rem;
  }
  .auth-logo-text {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    color: var(--navy);
    letter-spacing: 0.08em;
  }
  .auth-logo-text span { color: var(--accent); }
  .auth-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2rem;
    color: var(--navy);
    text-align: center;
    letter-spacing: 0.04em;
    margin-bottom: 1.8rem;
  }
  .auth-label {
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--navy2);
    margin-bottom: 6px;
    display: block;
  }
  .auth-input {
    background: var(--light);
    border: 1.5px solid rgba(0,0,0,0.08);
    border-radius: 4px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    font-family: 'Manrope', sans-serif;
    color: var(--navy);
    width: 100%;
    transition: all 0.2s;
    outline: none;
  }
  .auth-input:focus {
    border-color: var(--steel);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(37,99,168,0.1);
  }
  .auth-input.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
  }
  .invalid-feedback {
    font-size: 0.8rem;
    color: #dc2626;
    margin-top: 4px;
    font-weight: 500;
  }
  .btn-auth {
    background: var(--navy);
    color: var(--white);
    font-weight: 700;
    font-size: 0.88rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 0.85rem 2rem;
    border: none;
    border-radius: 4px;
    width: 100%;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 0.5rem;
  }
  .btn-auth:hover {
    background: var(--steel);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(37,99,168,0.3);
  }
  .btn-auth:active {
    transform: translateY(0);
  }
  .auth-link {
    color: var(--steel);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.88rem;
    transition: color 0.2s;
  }
  .auth-link:hover { color: var(--accent); text-decoration: underline; }
  .auth-divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1.5rem 0;
  }
  .auth-divider::before,
  .auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(0,0,0,0.1);
  }
  .auth-divider span {
    font-size: 0.78rem;
    color: #94a3b8;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
  .alert-danger-custom {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 4px;
    font-size: 0.88rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
  }
  @media (max-width: 575px) {
    .auth-card {
      padding: 2rem 1.2rem;
    }
  }
</style>
@endpush

@section('content')
<section class="auth-section">
  <div class="container">
    <div class="auth-card mx-auto">
      <div class="auth-logo">
        <div class="auth-logo-text">Bulding<span>Service</span></div>
      </div>
      <h2 class="auth-title">Вход в систему</h2>

      @if ($errors->any())
        <div class="alert-danger-custom">
          <i class="bi bi-exclamation-triangle me-2"></i>
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="mb-3">
          <label for="email" class="auth-label">Email</label>
          <input 
            type="email" 
            name="email" 
            id="email" 
            class="auth-input @error('email') is-invalid @enderror" 
            placeholder="mail@company.ru" 
            value="{{ old('email') }}" 
            required 
            autofocus
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="auth-label">Пароль</label>
          <input 
            type="password" 
            name="password" 
            id="password" 
            class="auth-input @error('password') is-invalid @enderror" 
            placeholder="••••••••" 
            required
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" style="border-color: rgba(0,0,0,0.2); cursor: pointer;">
            <label class="form-check-label" for="remember" style="font-size: 0.85rem; color: #64748b; cursor: pointer;">
              Запомнить меня
            </label>
          </div>
        </div>

        <div class="mb-3">
          {!! NoCaptcha::display() !!}
          @error('g-recaptcha-response')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-auth">
          <i class="bi bi-box-arrow-in-right me-2"></i>Войти
        </button>
      </form>

      <div class="auth-divider">
        <span>или</span>
      </div>

      <div class="text-center">
        <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 0;">
          Нет аккаунта? 
          <a href="{{ route('register') }}" class="auth-link">Зарегистрироваться</a>
        </p>
      </div>

      <div class="text-center mt-3">
        <a href="{{ url('/') }}" class="auth-link" style="font-size: 0.82rem;">
          <i class="bi bi-arrow-left me-1"></i>Вернуться на главную
        </a>
      </div>
    </div>
  </div>
</section>
@endsection