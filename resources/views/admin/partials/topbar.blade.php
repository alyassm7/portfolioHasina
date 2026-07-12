<header class="admin-topbar">
    <div class="admin-topbar-inner">
        <div class="admin-topbar-left">
            <button class="admin-menu-toggle" id="adminMenuToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div>
                <h1 class="admin-page-title">@yield('page-title', 'Dashboard')</h1>
            </div>
        </div>

        <div class="admin-user-menu">
            <button class="admin-theme-toggle" id="adminThemeToggle" aria-label="Changer le thème" title="Changer le thème">
                <i class="fas fa-sun"></i>
            </button>
            <div class="admin-user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="admin-user-info">
                <span class="admin-user-name">{{ auth()->user()->name }}</span>
                <span class="admin-user-role">Administrateur</span>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</header>
