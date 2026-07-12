@extends('layouts.app')

@section('title', __('portfolio.about.title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.about.tag') }}</span>
                <h1 class="section-title gradient-text-inline">{{ __('portfolio.about.heading') }}</h1>
            </div>

            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-photo-wrap mx-auto tilt-card" data-tilt data-tilt-max="6">
                        <img src="{{ $profilePhotoUrl }}"
                             alt="{{ $settings['site_name'] ?? 'Profile' }}"
                             class="about-photo"
                             loading="lazy"
                             width="360"
                             height="360">
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="glass-card p-4 p-lg-5">
                        <h2 class="mb-4 gradient-text-inline">{{ $settings['hero_name'] ?? 'Hasina Ralison' }}</h2>
                        <blockquote class="about-quote">
                            <p>{{ $settings['about_text'] ?: __('portfolio.about.default_text') }}</p>
                        </blockquote>
                        <div class="about-info mt-4">
                            <div class="info-item"><i class="fas fa-briefcase"></i> {{ __('portfolio.about.job_title') }}</div>
                            <div class="info-item"><i class="fas fa-map-marker-alt"></i> {{ __('portfolio.about.location') }}</div>
                            <div class="info-item"><i class="fas fa-envelope"></i> {{ $settings['email'] ?? '' }}</div>
                        </div>
                        <div class="mt-4 d-flex flex-wrap gap-2">
                            <a href="{{ route('contact') }}" class="btn btn-accent">{{ __('portfolio.about.contact_me') }}</a>
                            <a href="{{ route('cv.download') }}" class="btn btn-outline-accent">{{ __('portfolio.about.download_cv') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
