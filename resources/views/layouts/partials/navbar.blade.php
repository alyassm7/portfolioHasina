<nav class="navbar navbar-expand-lg fixed-top portfolio-nav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="brand-logo">HR</span>
            <span class="brand-name gradient-text">Hasina</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Menu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-lg-1">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('portfolio.nav.home') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">{{ __('portfolio.nav.about') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('skills') ? 'active' : '' }}" href="{{ route('skills') }}">{{ __('portfolio.nav.skills') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}" href="{{ route('projects') }}">{{ __('portfolio.nav.projects') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('experiences') ? 'active' : '' }}" href="{{ route('experiences') }}">{{ __('portfolio.nav.experiences') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('portfolio.nav.contact') }}</a></li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <div class="dropdown lang-dropdown">
                    <button class="btn btn-theme lang-dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="{{ __('portfolio.nav.language') }}">
                        <i class="fas fa-globe"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end lang-dropdown-menu">
                        <li>
                            <a class="dropdown-item lang-dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}"
                               href="{{ route('locale.switch', 'fr') }}">
                                <span class="lang-flag">🇫🇷</span> {{ __('portfolio.nav.lang_fr') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item lang-dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                               href="{{ route('locale.switch', 'en') }}">
                                <span class="lang-flag">EN</span> {{ __('portfolio.nav.lang_en') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <button id="themeToggle" class="btn btn-theme" aria-label="{{ __('portfolio.nav.theme') }}">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
                <a href="{{ route('cv.download') }}" class="btn btn-accent btn-sm d-none d-lg-inline-flex">
                    <i class="fas fa-download me-1"></i> {{ __('portfolio.nav.cv') }}
                </a>
            </div>
        </div>
    </div>
</nav>
