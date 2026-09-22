@extends('layouts.app')

@section('title', $project->localized('title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding project-case-page">
        <div class="container">
            <div class="mb-4" data-aos="fade-up">
                <a href="{{ route('projects') }}" class="case-back-link">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('portfolio.projects.back') }}
                </a>
            </div>

            <div class="case-hero glass-card p-4 p-lg-5 mb-5" data-aos="fade-up">
                @if($project->is_featured)
                    <span class="section-tag mb-3 d-inline-block">{{ __('portfolio.projects.featured') }}</span>
                @endif
                <h1 class="section-title gradient-text-inline mb-2">{{ $project->localized('title') }}</h1>
                @if($project->hasCaseStudy() && $project->caseStudyField('subtitle'))
                    <p class="case-subtitle mb-4">{{ $project->caseStudyField('subtitle') }}</p>
                @endif
                <p class="case-lead mb-4">{{ $project->localized('description') }}</p>
                <div class="project-tech mb-0">
                    @foreach($project->technologies ?? [] as $tech)
                        <span class="tech-badge">{{ $tech }}</span>
                    @endforeach
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    @if($project->github_url && $project->github_url !== '#')
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="btn btn-accent btn-sm">
                            <i class="fab fa-github me-1"></i> GitHub
                        </a>
                    @endif
                    @if($project->demo_url && $project->demo_url !== '#')
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="btn btn-outline-accent btn-sm">
                            <i class="fas fa-external-link-alt me-1"></i> {{ __('portfolio.projects.demo') }}
                        </a>
                    @endif
                </div>
            </div>

            @if($project->hasCaseStudy())
                <div class="row g-4 mb-5">
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-exclamation-circle me-2"></i>{{ __('portfolio.projects.case.problem') }}</h2>
                            <p class="mb-0">{{ $project->caseStudyField('problem') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-lightbulb me-2"></i>{{ __('portfolio.projects.case.solution') }}</h2>
                            <p class="mb-0">{{ $project->caseStudyField('solution') }}</p>
                        </div>
                    </div>
                </div>

                @if(count($project->caseStudyList('modules')))
                    <div class="case-block glass-card p-4 p-lg-5 mb-5" data-aos="fade-up">
                        <h2 class="case-block-title"><i class="fas fa-cubes me-2"></i>{{ __('portfolio.projects.case.modules') }}</h2>
                        <ul class="case-module-list">
                            @foreach($project->caseStudyList('modules') as $module)
                                <li><i class="fas fa-check"></i> {{ $module }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row g-4 mb-5">
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-sitemap me-2"></i>{{ __('portfolio.projects.case.architecture') }}</h2>
                            <p class="mb-0">{{ $project->caseStudyField('architecture') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-book me-2"></i>{{ __('portfolio.projects.case.documentation') }}</h2>
                            <p class="mb-0">{{ $project->caseStudyField('documentation') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-trophy me-2"></i>{{ __('portfolio.projects.case.results') }}</h2>
                            <p class="mb-0">{{ $project->caseStudyField('results') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="80">
                        <div class="case-block glass-card h-100 p-4">
                            <h2 class="case-block-title"><i class="fas fa-user-check me-2"></i>{{ __('portfolio.projects.case.skills') }}</h2>
                            <ul class="case-module-list mb-0">
                                @foreach($project->caseStudyList('skills_demonstrated') as $skill)
                                    <li><i class="fas fa-check"></i> {{ $skill }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif($project->features)
                <div class="case-block glass-card p-4 mb-5" data-aos="fade-up">
                    <h2 class="case-block-title">{{ __('portfolio.projects.case.features') }}</h2>
                    <ul class="case-module-list mb-0">
                        @foreach($project->localizedFeatures() as $feature)
                            <li><i class="fas fa-check"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($relatedProjects->isNotEmpty())
                <div class="section-header mb-4" data-aos="fade-up">
                    <h2 class="h4 mb-0">{{ __('portfolio.projects.related') }}</h2>
                </div>
                <div class="row g-4">
                    @foreach($relatedProjects as $related)
                        @include('components.project-card', ['project' => $related, 'loop' => $loop])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
