@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('title', 'Dashboard')

@section('content')
    @php
        $hour = (int) now()->format('H');
        $greeting = $hour < 12 ? 'Bonjour' : ($hour < 18 ? 'Bon après-midi' : 'Bonsoir');
        $statCards = [
            ['icon' => 'folder-open', 'label' => 'Projets', 'value' => $stats['projects'], 'color' => '#9333EA', 'route' => 'admin.projects.index'],
            ['icon' => 'bolt', 'label' => 'Compétences', 'value' => $stats['skills'], 'color' => '#A855F7', 'route' => 'admin.skills.index'],
            ['icon' => 'briefcase', 'label' => 'Expériences', 'value' => $stats['experiences'], 'color' => '#C026D3', 'route' => 'admin.experiences.index'],
            ['icon' => 'graduation-cap', 'label' => 'Formations', 'value' => $stats['educations'], 'color' => '#E11D48', 'route' => 'admin.educations.index'],
            ['icon' => 'star', 'label' => 'Témoignages', 'value' => $stats['testimonials'], 'color' => '#FB7185', 'route' => 'admin.testimonials.index'],
            ['icon' => 'envelope', 'label' => 'Messages non lus', 'value' => $stats['messages_unread'], 'color' => '#ef4444', 'route' => 'admin.messages.index', 'badge' => $stats['messages_total'].' au total'],
        ];
        $quickActions = [
            ['icon' => 'plus', 'label' => 'Nouveau projet', 'route' => 'admin.projects.create', 'color' => '#9333EA'],
            ['icon' => 'plus', 'label' => 'Nouvelle compétence', 'route' => 'admin.skills.create', 'color' => '#A855F7'],
            ['icon' => 'envelope-open-text', 'label' => 'Voir les messages', 'route' => 'admin.messages.index', 'color' => '#E11D48'],
            ['icon' => 'sliders-h', 'label' => 'Paramètres', 'route' => 'admin.settings.edit', 'color' => '#FB7185'],
        ];
    @endphp

    <div class="dashboard-page">
        {{-- Hero --}}
        <section class="dashboard-hero">
            <div class="dashboard-hero-content">
                <span class="dashboard-hero-badge">
                    <i class="fas fa-chart-line"></i> Tableau de bord
                </span>
                <h2 class="dashboard-hero-title">{{ $greeting }}, {{ auth()->user()->name }} 👋</h2>
                <p class="dashboard-hero-text">
                    Gérez le portfolio <strong>{{ $siteName }}</strong> — contenu, messages et paramètres en un seul endroit.
                </p>
                <div class="dashboard-hero-meta">
                    <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F Y') }}</span>
                    <span><i class="far fa-clock"></i> {{ now()->format('H:i') }}</span>
                </div>
            </div>
            <div class="dashboard-hero-actions">
                <a href="{{ route('home') }}" target="_blank" class="dashboard-hero-btn dashboard-hero-btn-outline">
                    <i class="fas fa-external-link-alt"></i> Voir le site
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="dashboard-hero-btn dashboard-hero-btn-primary">
                    <i class="fas fa-sliders-h"></i> Paramètres
                </a>
            </div>
        </section>

        {{-- Stats --}}
        <section class="dashboard-stats">
            @foreach($statCards as $stat)
                <a href="{{ route($stat['route']) }}" class="dashboard-stat-card" style="--stat-color: {{ $stat['color'] }}">
                    <div class="dashboard-stat-top">
                        <div class="dashboard-stat-icon">
                            <i class="fas fa-{{ $stat['icon'] }}"></i>
                        </div>
                        @if(!empty($stat['badge']))
                            <span class="dashboard-stat-badge">{{ $stat['badge'] }}</span>
                        @endif
                    </div>
                    <div class="dashboard-stat-value">{{ $stat['value'] }}</div>
                    <div class="dashboard-stat-label">{{ $stat['label'] }}</div>
                </a>
            @endforeach
        </section>

        <div class="dashboard-grid">
            {{-- Messages récents --}}
            <section class="dashboard-panel dashboard-panel-messages">
                <div class="dashboard-panel-header">
                    <div>
                        <h3 class="dashboard-panel-title">
                            <i class="fas fa-inbox"></i> Messages récents
                        </h3>
                        <p class="dashboard-panel-subtitle">
                            {{ $stats['messages_unread'] }} non lu{{ $stats['messages_unread'] > 1 ? 's' : '' }}
                            · {{ $stats['messages_total'] }} au total
                        </p>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="dashboard-panel-link">
                        Tout voir <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="dashboard-panel-body">
                    @forelse($recentMessages as $msg)
                        <a href="{{ route('admin.messages.show', $msg) }}" class="dashboard-message-item {{ !$msg->is_read ? 'is-unread' : '' }}">
                            <div class="dashboard-message-avatar">{{ strtoupper(substr($msg->name, 0, 1)) }}</div>
                            <div class="dashboard-message-content">
                                <div class="dashboard-message-top">
                                    <strong>{{ $msg->name }}</strong>
                                    <span>{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="dashboard-message-subject">{{ $msg->subject }}</div>
                                <div class="dashboard-message-preview">{{ Str::limit($msg->body, 90) }}</div>
                            </div>
                            @unless($msg->is_read)
                                <span class="dashboard-message-dot" title="Non lu"></span>
                            @endunless
                        </a>
                    @empty
                        <div class="dashboard-empty">
                            <i class="far fa-envelope-open"></i>
                            <p>Aucun message pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Actions rapides + résumé --}}
            <div class="dashboard-side">
                <section class="dashboard-panel">
                    <div class="dashboard-panel-header">
                        <h3 class="dashboard-panel-title">
                            <i class="fas fa-bolt"></i> Actions rapides
                        </h3>
                    </div>
                    <div class="dashboard-panel-body dashboard-quick-actions">
                        @foreach($quickActions as $action)
                            <a href="{{ route($action['route']) }}" class="dashboard-quick-action" style="--action-color: {{ $action['color'] }}">
                                <span class="dashboard-quick-action-icon">
                                    <i class="fas fa-{{ $action['icon'] }}"></i>
                                </span>
                                <span>{{ $action['label'] }}</span>
                                <i class="fas fa-chevron-right dashboard-quick-action-arrow"></i>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="dashboard-panel dashboard-panel-summary">
                    <div class="dashboard-panel-header">
                        <h3 class="dashboard-panel-title">
                            <i class="fas fa-chart-pie"></i> Résumé du contenu
                        </h3>
                    </div>
                    <div class="dashboard-panel-body">
                        <ul class="dashboard-summary-list">
                            <li>
                                <span><i class="fas fa-folder-open"></i> Projets publiés</span>
                                <strong>{{ $stats['projects'] }}</strong>
                            </li>
                            <li>
                                <span><i class="fas fa-bolt"></i> Compétences</span>
                                <strong>{{ $stats['skills'] }}</strong>
                            </li>
                            <li>
                                <span><i class="fas fa-briefcase"></i> Expériences</span>
                                <strong>{{ $stats['experiences'] }}</strong>
                            </li>
                            <li>
                                <span><i class="fas fa-graduation-cap"></i> Formations</span>
                                <strong>{{ $stats['educations'] }}</strong>
                            </li>
                            <li>
                                <span><i class="fas fa-star"></i> Témoignages</span>
                                <strong>{{ $stats['testimonials'] }}</strong>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
