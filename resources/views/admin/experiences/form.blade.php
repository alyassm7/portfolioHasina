@extends('admin.layouts.app')

@section('page-title', isset($experience->id) ? 'Modifier expérience' : 'Nouvelle expérience')
@section('title', 'Expériences')

@section('content')
    @include('admin.partials.crud-header', ['indexRoute' => route('admin.experiences.index'), 'isForm' => true])

    <div class="card shadow-sm"><div class="card-body">
        <form method="POST" action="{{ isset($experience->id) ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}">
            @csrf @if(isset($experience->id)) @method('PUT') @endif
            <div class="row g-3">
                <div class="col-md-3"><label class="form-label">Année</label><input type="text" name="year" class="form-control" value="{{ old('year', $experience->exists ? $experience->localized('year', 'fr') : '') }}" required></div>
                <div class="col-md-6"><label class="form-label">Titre</label><input type="text" name="title" class="form-control" value="{{ old('title', $experience->exists ? $experience->localized('title', 'fr') : '') }}" required></div>
                <div class="col-md-3"><label class="form-label">Ordre</label><input type="number" name="order" class="form-control" value="{{ old('order', $experience->order ?? 0) }}"></div>
                <div class="col-md-6"><label class="form-label">Entreprise</label><input type="text" name="company" class="form-control" value="{{ old('company', $experience->exists ? $experience->localized('company', 'fr') : '') }}"></div>
                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $experience->exists ? $experience->localized('description', 'fr') : '') }}</textarea></div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary">Enregistrer</button> <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Annuler</a></div>
        </form>
    </div></div>
@endsection
