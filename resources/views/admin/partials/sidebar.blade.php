<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <span class="sidebar-brand-icon"><i class="fas fa-layer-group"></i></span>
            <span class="sidebar-brand-text">
                <span class="sidebar-brand-title">Portfolio</span>
                <span class="sidebar-brand-sub">Administration</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-group">
            <p class="sidebar-section-title">Vue d'ensemble</p>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="sidebar-link-text">Dashboard</span>
            </a>
        </div>

        <div class="sidebar-group">
            <p class="sidebar-section-title">Contenu</p>
            <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-folder-open"></i></span>
                <span class="sidebar-link-text">Projets</span>
            </a>
            <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-bolt"></i></span>
                <span class="sidebar-link-text">Compétences</span>
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-briefcase"></i></span>
                <span class="sidebar-link-text">Expériences</span>
            </a>
            <a href="{{ route('admin.educations.index') }}" class="sidebar-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="sidebar-link-text">Formations</span>
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-certificate"></i></span>
                <span class="sidebar-link-text">Certificats</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-star"></i></span>
                <span class="sidebar-link-text">Témoignages</span>
            </a>
        </div>

        <div class="sidebar-group">
            <p class="sidebar-section-title">Communication</p>
            <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-envelope"></i></span>
                <span class="sidebar-link-text">Messages</span>
            </a>
        </div>

        <div class="sidebar-group">
            <p class="sidebar-section-title">Configuration</p>
            <a href="{{ route('admin.settings.edit') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span class="sidebar-link-icon"><i class="fas fa-sliders-h"></i></span>
                <span class="sidebar-link-text">Paramètres</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link sidebar-link-external">
            <span class="sidebar-link-icon"><i class="fas fa-external-link-alt"></i></span>
            <span class="sidebar-link-text">Voir le site</span>
        </a>
    </div>
</aside>
