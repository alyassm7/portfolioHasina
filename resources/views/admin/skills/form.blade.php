@extends('admin.layouts.app')

@section('page-title', isset($skill->id) ? 'Modifier compétence' : 'Nouvelle compétence')
@section('title', 'Compétences')

@section('content')
    @include('admin.partials.crud-header', ['indexRoute' => route('admin.skills.index'), 'isForm' => true])

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ isset($skill->id) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
                @csrf
                @if(isset($skill->id)) @method('PUT') @endif
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Nom</label><input type="text" name="name" class="form-control" value="{{ old('name', $skill->exists ? $skill->localized('name', 'fr') : '') }}" required></div>
                    <div class="col-md-3"><label class="form-label">Pourcentage</label><input type="number" name="percentage" class="form-control" min="0" max="100" value="{{ old('percentage', $skill->percentage ?? 0) }}" required></div>
                    <div class="col-md-3"><label class="form-label">Ordre</label><input type="number" name="order" class="form-control" value="{{ old('order', $skill->order ?? 0) }}"></div>
                    <div class="col-md-6"><label class="form-label">Icône (Font Awesome)</label><input type="text" name="icon" class="form-control" value="{{ old('icon', $skill->icon) }}" placeholder="fab fa-laravel"></div>
                    <div class="col-md-6"><label class="form-label">Catégorie</label><input type="text" name="category" class="form-control" value="{{ old('category', $skill->exists ? $skill->localized('category', 'fr') : '') }}"></div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
