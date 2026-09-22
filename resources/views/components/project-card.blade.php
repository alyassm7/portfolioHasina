<div class="col-md-6 col-lg-4 project-col" data-aos="fade-up" data-aos-delay="{{ ($loop->index ?? 0) * 100 }}"
     data-techs="{{ json_encode($project->technologies ?? []) }}">
    <a href="{{ route('projects.show', $project->slug) }}" class="project-card-link text-decoration-none">
        <div class="project-card glass-card h-100 tilt-card" data-tilt data-tilt-max="10" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.12">
            <div class="project-image-wrap">
                @if($project->image)
                    <div class="project-image">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->localized('title') }}" loading="lazy">
                    </div>
                @else
                    <div class="project-image project-image-placeholder">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                @endif
                <div class="project-overlay">
                    <div class="project-overlay-actions">
                        <span class="btn btn-accent btn-sm">
                            <i class="fas fa-eye"></i> {{ __('portfolio.projects.view') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="project-body">
                @if($project->is_featured)
                    <span class="project-featured-badge">{{ __('portfolio.projects.featured') }}</span>
                @endif
                <h3 class="project-title gradient-text-inline">{{ $project->localized('title') }}</h3>
                <div class="project-tech mb-3">
                    @foreach(array_slice($project->technologies ?? [], 0, 4) as $tech)
                        <span class="tech-badge">{{ $tech }}</span>
                    @endforeach
                    @if(count($project->technologies ?? []) > 4)
                        <span class="tech-badge">+{{ count($project->technologies) - 4 }}</span>
                    @endif
                </div>
                <p class="project-desc">{{ Str::limit($project->localized('description'), 120) }}</p>
                @if($project->features)
                    <ul class="project-features">
                        @foreach(array_slice($project->localizedFeatures(), 0, 3) as $feature)
                            <li><i class="fas fa-check"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </a>
</div>
