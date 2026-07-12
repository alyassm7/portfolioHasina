@extends('admin.layouts.app')

@section('page-title', isset($education->id) ? 'Modifier formation' : 'Nouvelle formation')
@section('title', 'Formations')

@section('content')
    @include('admin.partials.crud-header', ['indexRoute' => route('admin.educations.index'), 'isForm' => true])

    <div class="card shadow-sm"><div class="card-body">
        <form method="POST" action="{{ isset($education->id) ? route('admin.educations.update', $education) : route('admin.educations.store') }}">
            @csrf @if(isset($education->id)) @method('PUT') @endif
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Titre</label><input type="text" name="title" class="form-control" value="{{ old('title', $education->exists ? $education->localized('title', 'fr') : '') }}" required></div>
                <div class="col-md-4"><label class="form-label">Institution</label><input type="text" name="institution" class="form-control" value="{{ old('institution', $education->exists ? $education->localized('institution', 'fr') : '') }}"></div>
                <div class="col-md-2"><label class="form-label">Année</label><input type="text" name="year" class="form-control" value="{{ old('year', $education->exists ? $education->localized('year', 'fr') : '') }}"></div>
                <div class="col-md-2"><label class="form-label">Ordre</label><input type="number" name="order" class="form-control" value="{{ old('order', $education->order ?? 0) }}"></div>
                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2">{{ old('description', $education->exists ? $education->localized('description', 'fr') : '') }}</textarea></div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary">Enregistrer</button> <a href="{{ route('admin.educations.index') }}" class="btn btn-secondary">Annuler</a></div>
        </form>
    </div></div>
@endsection
