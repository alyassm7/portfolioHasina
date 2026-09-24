@extends('layouts.app')

@section('title', ($settings['hero_name'] ?? 'Hasina Ralison') . ' — ' . __('portfolio.home.title_suffix'))

@section('content')
<div class="page-home">
    {{-- Hero --}}
    <section class="hero-section" id="hero">
        <div class="hero-glow"></div>
        <div class="container hero-content">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-7 hero-text-col order-last order-lg-first">
                    <div class="hero-badge glass-pill" data-aos="fade-down">
                        <span class="pulse-dot"></span>
                        {{ __('portfolio.home.available') }}
                    </div>
                    <p class="hero-greeting gsap-fade">{{ $settings['hero_greeting'] ?? __('portfolio.home.default_greeting') }}</p>
                    <h1 class="hero-title gsap-fade">
                        {{ __('portfolio.home.i_am') }}<br>
                        <span class="gradient-text">{{ $settings['hero_name'] ?? 'Hasina Ralison' }}</span>
                    </h1>
                    @if(!empty($settings['hero_job_title']))
                        <p class="hero-job-title gsap-fade">{{ $settings['hero_job_title'] }}</p>
                    @endif
                    <div class="hero-typed mb-4 gsap-fade">
                        <span id="typed-roles"></span>
                    </div>
                    <div class="d-flex flex-wrap gap-3 hero-actions gsap-fade">
                        <a href="{{ route('cv.download') }}" class="btn btn-accent btn-lg">
                            <i class="fas fa-download me-2"></i>{{ __('portfolio.home.download_cv') }}
                        </a>
                        <a href="{{ route('projects') }}" class="btn btn-glass btn-lg">
                            <i class="fas fa-folder-open me-2"></i>{{ __('portfolio.home.view_projects') }}
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-accent btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>{{ __('portfolio.home.contact_me') }}
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-5 text-center hero-photo-col order-first order-lg-last mb-4 mb-lg-0">
                    <div class="hero-photo-wrap" data-tilt data-tilt-max="6" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.2">
                        <div class="hero-photo-ring"></div>
                        <div class="hero-photo-glow"></div>
                        <img src="{{ $profilePhotoUrl }}"
                             alt="{{ $settings['hero_name'] ?? 'Hasina Ralison' }}"
                             class="hero-photo"
                             loading="eager"
                             width="360"
                             height="360">
                        <div class="hero-float-badge hero-float-badge-1 glass-card">
                            <i class="fab fa-laravel"></i> Laravel
                        </div>
                        <div class="hero-float-badge hero-float-badge-2 glass-card">
                            <i class="fas fa-headset"></i> Support IT
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-scroll-hint">
                <span>{{ __('portfolio.home.scroll') }}</span>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="section-padding stats-section" id="stats">
        <div class="container">
            <div class="row g-4">
                @php
                    $stats = [
                        ['value' => $settings['stat_projects'] ?? '10', 'suffix' => '+', 'label' => __('portfolio.home.stats.applications')],
                        ['value' => $settings['stat_commits'] ?? '500', 'suffix' => '+', 'label' => __('portfolio.home.stats.tickets')],
                        ['value' => $settings['stat_technologies'] ?? '100', 'suffix' => '+', 'label' => __('portfolio.home.stats.equipment')],
                        ['value' => $settings['stat_motivation'] ?? '3', 'suffix' => '+', 'label' => __('portfolio.home.stats.years')],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="stat-card glass-card tilt-card" data-tilt data-tilt-max="5">
                            <div class="stat-number" data-count="{{ preg_replace('/[^0-9]/', '', $stat['value']) }}" data-suffix="{{ $stat['suffix'] }}">0</div>
                            <div class="stat-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Skills Preview --}}
    <section class="section-padding" id="skills-preview">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.skills.tag') }}</span>
                <h2 class="section-title gradient-text-inline">{{ __('portfolio.skills.heading') }}</h2>
            </div>
            <div class="row g-4">
                @foreach($skills->take(6) as $skill)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="skill-card glass-card tilt-card" data-tilt data-tilt-max="8">
                            <div class="skill-icon-wrap">
                                <i class="{{ $skill->icon ?? 'fas fa-code' }}"></i>
                            </div>
                            <div class="skill-header">
                                <span class="skill-name">{{ $skill->localized('name') }}</span>
                                <span class="skill-percent">{{ $skill->percentage }}%</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress" data-width="{{ $skill->percentage }}"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('skills') }}" class="btn btn-outline-accent">{{ __('portfolio.home.view_all_skills') }}</a>
            </div>
        </div>
    </section>

    {{-- Tech Wall --}}
    <section class="section-padding tech-wall-section" id="tech">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.home.tech_tag') }}</span>
                <h2 class="section-title">{{ __('portfolio.home.tech_title') }}</h2>
            </div>
            <div class="tech-wall" data-aos="zoom-in">
                @php
                    $techIcons = [
                        ['icon' => 'fab fa-laravel', 'name' => 'Laravel'],
                        ['icon' => 'fab fa-php', 'name' => 'PHP'],
                        ['icon' => 'fas fa-database', 'name' => 'MySQL'],
                        ['icon' => 'fab fa-git-alt', 'name' => 'Git'],
                        ['icon' => 'fab fa-linux', 'name' => 'Linux'],
                        ['icon' => 'fab fa-windows', 'name' => 'Windows'],
                        ['icon' => 'fab fa-bootstrap', 'name' => 'Bootstrap'],
                        ['icon' => 'fas fa-bolt', 'name' => 'Livewire'],
                        ['icon' => 'fab fa-shopify', 'name' => 'Shopify'],
                        ['icon' => 'fab fa-angular', 'name' => 'Angular'],
                        ['icon' => 'fab fa-node-js', 'name' => 'NodeJS'],
                        ['icon' => 'fab fa-js', 'name' => 'JavaScript'],
                    ];
                @endphp
                @foreach($techIcons as $i => $tech)
                    <div class="tech-icon-item glass-card" style="--delay: {{ $i * 0.15 }}s">
                        <i class="{{ $tech['icon'] }}"></i>
                        <span>{{ $tech['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Projects --}}
    <section class="section-padding projects-section" id="projects-preview">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.home.recent_projects_tag') }}</span>
                <h2 class="section-title">{{ __('portfolio.home.recent_projects_title') }}</h2>
            </div>
            <div class="row g-4">
                @foreach($projects->where('is_featured', true)->take(3) as $project)
                    @include('components.project-card', ['project' => $project])
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('projects') }}" class="btn btn-accent">{{ __('portfolio.home.view_all_projects') }}</a>
            </div>
        </div>
    </section>

    {{-- Experience Preview --}}
    <section class="section-padding timeline-section" id="experience-preview">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.experiences.tag') }}</span>
                <h2 class="section-title">{{ __('portfolio.experiences.heading') }}</h2>
            </div>
            <div class="timeline timeline-premium">
                @foreach($experiences->take(3) as $exp)
                    <div class="timeline-item" data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="timeline-marker"><i class="fas fa-briefcase"></i></div>
                        <div class="timeline-content glass-card tilt-card" data-tilt data-tilt-max="5">
                            <span class="timeline-year">{{ $exp->localized('year') }}</span>
                            <h4>{{ $exp->localized('title') }}</h4>
                            @if($exp->company)
                                <p class="timeline-company">{{ $exp->localized('company') }}</p>
                            @endif
                            @if($exp->description)
                                <p class="timeline-desc">{{ Str::limit($exp->localized('description'), 180) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('experiences') }}" class="btn btn-outline-accent">{{ __('portfolio.home.view_all_experience') }}</a>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="section-padding testimonials-section">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.home.testimonials_tag') }}</span>
                <h2 class="section-title">{{ __('portfolio.home.testimonials_title') }}</h2>
            </div>
            <div class="row g-4">
                @foreach($testimonials as $testimonial)
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="testimonial-card glass-card tilt-card" data-tilt data-tilt-max="6">
                            <div class="stars mb-3">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p class="testimonial-text">"{{ $testimonial->localized('content') }}"</p>
                            <div class="testimonial-author">
                                <strong>{{ $testimonial->name }}</strong>
                                @if($testimonial->role)
                                    <span>{{ $testimonial->localized('role') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section class="section-padding contact-cta-section" id="contact-cta">
        <div class="container">
            <div class="contact-cta glass-card text-center" data-aos="zoom-in">
                <h2 class="gradient-text-inline mb-3">{{ __('portfolio.home.cta_title') }}</h2>
                <p class="text-secondary mb-4">{{ __('portfolio.home.cta_text') }}</p>
                <a href="{{ route('contact') }}" class="btn btn-accent btn-lg">
                    <i class="fas fa-paper-plane me-2"></i>{{ __('portfolio.home.contact_me') }}
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@php
    $rolesRaw = $settings['hero_roles'] ?? __('portfolio.home.default_roles');
    $heroRoles = array_filter(array_map('trim', explode(',', is_string($rolesRaw) ? $rolesRaw : __('portfolio.home.default_roles'))));
@endphp
<script>
    window.portfolioHeroRoles = @json(array_values($heroRoles));
</script>
@endpush
