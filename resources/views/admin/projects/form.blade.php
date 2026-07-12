@extends('admin.layouts.app')

@section('page-title', isset($project->id) ? 'Modifier projet' : 'Nouveau projet')
@section('title', 'Projets')

@section('content')
    @include('admin.partials.crud-header', [
        'title' => 'Projets',
        'createRoute' => route('admin.projects.create'),
        'indexRoute' => route('admin.projects.index'),
        'isForm' => true,
    ])

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ isset($project->id) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($project->id)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $project->exists ? $project->localized('title', 'fr') : '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $project->order ?? 0) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $project->exists ? $project->localized('description', 'fr') : '') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Technologies (séparées par virgule)</label>
                        <input type="text" name="technologies" class="form-control" value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fonctionnalités (séparées par virgule)</label>
                        <input type="text" name="features" class="form-control" value="{{ old('features', implode(', ', $project->exists ? $project->localizedList('features', 'fr') : [])) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL GitHub</label>
                        <input type="url" name="github_url" class="form-control" value="{{ old('github_url', $project->github_url) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL Démo</label>
                        <input type="url" name="demo_url" class="form-control" value="{{ old('demo_url', $project->demo_url) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check">
                            <input type="checkbox" name="is_featured" class="form-check-input" id="featured" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Projet mis en avant</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
