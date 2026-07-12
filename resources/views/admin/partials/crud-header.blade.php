<div class="admin-page-header">
    @if($isForm ?? false)
        <h4>{{ $pageTitle ?? 'Formulaire' }}</h4>
        <a href="{{ $indexRoute }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
    @else
        <h4>{{ $title ?? 'Liste' }}</h4>
        <a href="{{ $createRoute }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Ajouter
        </a>
    @endif
</div>
