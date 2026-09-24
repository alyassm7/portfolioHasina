@extends('layouts.app')

@section('title', __('portfolio.experiences.title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.experiences.tag') }}</span>
                <h1 class="section-title gradient-text-inline">{{ __('portfolio.experiences.heading') }}</h1>
            </div>

            <div class="row g-5">
                <div class="col-lg-7">
                    <h3 class="mb-4" data-aos="fade-right"><i class="fas fa-briefcase me-2 gradient-text-inline"></i>{{ __('portfolio.experiences.experiences') }}</h3>
                    <div class="timeline timeline-premium">
                        @foreach($experiences as $exp)
                            <div class="timeline-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="timeline-marker"><i class="fas fa-briefcase"></i></div>
                                <div class="timeline-content glass-card tilt-card" data-tilt data-tilt-max="5">
                                    <span class="timeline-year">{{ $exp->localized('year') }}</span>
                                    <h4>{{ $exp->localized('title') }}</h4>
                                    @if($exp->company)
                                        <p class="timeline-company">{{ $exp->localized('company') }}</p>
                                    @endif
                                    @if($exp->description)
                                        <p class="timeline-desc">{{ $exp->localized('description') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-5">
                    <h3 class="mb-4" data-aos="fade-left"><i class="fas fa-graduation-cap me-2 gradient-text-inline"></i>{{ __('portfolio.experiences.education') }}</h3>
                    @foreach($educations as $edu)
                        <div class="education-card glass-card mb-3 tilt-card" data-aos="fade-left" data-aos-delay="{{ $loop->index * 80 }}" data-tilt data-tilt-max="5">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">{{ $edu->localized('title') }}</h5>
                                    @if($edu->institution)
                                        <p class="mb-0 text-muted">{{ $edu->localized('institution') }}</p>
                                    @endif
                                    @if($edu->description)
                                        <p class="mb-0 mt-2 small text-muted">{{ $edu->localized('description') }}</p>
                                    @endif
                                </div>
                                @if($edu->year)
                                    <span class="edu-year">{{ $edu->localized('year') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if($certificates->isNotEmpty())
                        <h3 class="mb-4 mt-5" data-aos="fade-left">
                            <i class="fas fa-certificate me-2 gradient-text-inline"></i>{{ __('portfolio.experiences.certificates') }}
                        </h3>
                        <div class="row g-3">
                            @foreach($certificates as $cert)
                                <div class="col-12" data-aos="fade-left" data-aos-delay="{{ $loop->index * 80 }}">
                                    <div class="certificate-card glass-card tilt-card" data-tilt data-tilt-max="5">
                                        @if($cert->fileUrl() && $cert->isImage())
                                            <a href="{{ $cert->fileUrl() }}" target="_blank" rel="noopener" class="certificate-preview">
                                                <img src="{{ $cert->fileUrl() }}" alt="{{ $cert->title }}" loading="lazy">
                                            </a>
                                        @elseif($cert->fileUrl() && $cert->isPdf())
                                            <a href="{{ $cert->fileUrl() }}" target="_blank" rel="noopener" class="certificate-pdf-preview">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        @else
                                            <div class="certificate-pdf-preview">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                        @endif
                                        <div class="certificate-body">
                                            <div class="d-flex justify-content-between align-items-start gap-2">
                                                <div>
                                                    <h5 class="mb-1">{{ $cert->title }}</h5>
                                                    @if($cert->issuer)
                                                        <p class="mb-0 text-muted">{{ $cert->issuer }}</p>
                                                    @endif
                                                </div>
                                                @if($cert->year)
                                                    <span class="edu-year">{{ $cert->year }}</span>
                                                @endif
                                            </div>
                                            @if($cert->fileUrl())
                                                <a href="{{ $cert->fileUrl() }}" target="_blank" rel="noopener" class="btn btn-outline-accent btn-sm mt-3">
                                                    <i class="fas fa-eye me-1"></i>{{ __('portfolio.experiences.view_certificate') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
