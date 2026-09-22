@extends('layouts.app')

@section('title', __('portfolio.projects.title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.projects.tag') }}</span>
                <h1 class="section-title gradient-text-inline">{{ __('portfolio.projects.heading') }}</h1>
            </div>

            <div class="filter-pills mb-4" data-aos="fade-up" id="projectFilters">
                @foreach(__('portfolio.projects.filters') as $key => $label)
                    <button type="button" class="filter-pill {{ $key === 'all' ? 'active' : '' }}" data-filter="{{ $key }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="project-filters glass-card mb-5 p-4" data-aos="fade-up">
                <form method="GET" action="{{ route('projects') }}" class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">{{ __('portfolio.projects.search') }}</label>
                        <input type="text" name="search" class="form-control portfolio-input" placeholder="{{ __('portfolio.projects.search_placeholder') }}" value="{{ $search }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('portfolio.projects.technology') }}</label>
                        <select name="tech" class="form-select portfolio-input">
                            <option value="">{{ __('portfolio.projects.all') }}</option>
                            @foreach($allTechnologies as $technology)
                                <option value="{{ $technology }}" {{ $currentTech === $technology ? 'selected' : '' }}>{{ $technology }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-accent w-100"><i class="fas fa-search me-1"></i> {{ __('portfolio.projects.filter') }}</button>
                    </div>
                </form>
            </div>

            <div class="row g-4" id="projectsGrid">
                @forelse($projects as $project)
                    @include('components.project-card', ['project' => $project])
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-folder-open fa-3x mb-3 text-muted"></i>
                        <p class="text-muted">{{ __('portfolio.projects.empty') }}</p>
                    </div>
                @endforelse
            </div>
            <p class="text-center text-muted mt-4 d-none" id="noProjectsMsg">{{ __('portfolio.projects.empty') }}</p>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    window.projectFilterMap = {
        laravel: ['Laravel', 'Livewire'],
        php: ['PHP', 'Laravel'],
        support: ['Support', 'IT', 'Ticket', 'SLA', 'Zabbix', 'Grafana', 'Process'],
        shopify: ['Shopify'],
        java: ['Java', 'Swing'],
        odoo: ['Odoo', 'Python', 'Purchase', 'Warehouse']
    };
</script>
@endpush
