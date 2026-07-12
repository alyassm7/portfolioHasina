@extends('layouts.app')

@section('title', __('portfolio.skills.title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.skills.tag') }}</span>
                <h1 class="section-title gradient-text-inline">{{ __('portfolio.skills.heading') }}</h1>
            </div>

            <div class="row g-4">
                @foreach($skills as $skill)
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
                            @if($skill->category)
                                <small class="skill-category">{{ $skill->localized('category') }}</small>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
