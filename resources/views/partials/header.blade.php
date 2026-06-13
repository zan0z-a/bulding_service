<div class="topbar">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div class="d-flex gap-3 flex-wrap">
        <span class="d-none d-sm-inline"><i class="bi bi-clock me-1"></i>Пн–Пт: 9:00–18:00</span>
        <span class="d-none d-md-inline"><i class="bi bi-envelope me-1"></i><a href="mailto:info@servicename-group.ru">info@servicename-group.ru</a></span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <a href="tel:88009999999" class="topbar-phone"><i class="bi bi-telephone me-1"></i>8 800 999-99-99</a>
        <span class="d-none d-sm-inline" style="color: #4a5568; font-size: 0.75rem;">Звонок бесплатный</span>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand navbar-brand-text" href="{{ url('/') }}">Bulding<span>Service</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Главная</a></li>
        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ url('/#catalog') }}">Каталог</a></li>
        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ url('/#about') }}">О компании</a></li>
        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ url('/#contact') }}">Контакты</a></li>
        <li class="nav-item ms-lg-3">
          <a href="{{ url('/#contact') }}" class="btn btn-nav-cta">Запросить цену</a>
        </li>
        
        {{-- Блок аутентификации --}}
        @auth
          <li class="nav-item dropdown ms-lg-2">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" style="color: rgba(255,255,255,0.82) !important; font-weight: 600; font-size: 0.88rem; letter-spacing: 0.05em; text-transform: uppercase; padding: 1.2rem 0.5rem !important;">
              <i class="bi bi-person-circle fs-5"></i>
              <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="background: var(--navy2); border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; margin-top: 0;">
              <li>
                <a class="dropdown-item" href="{{ route('profile') }}" style="color: rgba(255,255,255,0.82); font-size: 0.85rem; font-weight: 500; padding: 0.6rem 1.2rem; transition: all 0.2s;" 
                   onmouseover="this.style.background='rgba(245,158,11,0.15)'; this.style.color='#f59e0b';"
                   onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.82)';">
                  <i class="bi bi-person me-2"></i>Профиль
                </a>
              </li>
              @if(Auth::user()->isAdmin())
                <li>
                  <a class="dropdown-item" href="{{ route('admin.index') }}" style="color: rgba(255,255,255,0.82); font-size: 0.85rem; font-weight: 500; padding: 0.6rem 1.2rem; transition: all 0.2s;"
                     onmouseover="this.style.background='rgba(245,158,11,0.15)'; this.style.color='#f59e0b';"
                     onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.82)';">
                    <i class="bi bi-shield-check me-2"></i>Админ-панель
                  </a>
                </li>
              @endif
              <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.1);"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item" style="color: rgba(255,255,255,0.82); font-size: 0.85rem; font-weight: 500; padding: 0.6rem 1.2rem; width: 100%; text-align: left; transition: all 0.2s;"
                          onmouseover="this.style.background='rgba(220,38,38,0.15)'; this.style.color='#ef4444';"
                          onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.82)';">
                    <i class="bi bi-box-arrow-right me-2"></i>Выйти
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item ms-lg-2">
            <a href="{{ route('login') }}" class="btn" style="background: rgba(255,255,255,0.1); color: var(--white); font-weight: 600; font-size: 0.85rem; letter-spacing: 0.06em; text-transform: uppercase; padding: 0.55rem 1.4rem; border-radius: 2px; border: 1px solid rgba(255,255,255,0.2); transition: all 0.2s;"
               onmouseover="this.style.background='rgba(245,158,11,0.2)'; this.style.borderColor='#f59e0b';"
               onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)';">
              <i class="bi bi-box-arrow-in-right me-1"></i> Войти
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>