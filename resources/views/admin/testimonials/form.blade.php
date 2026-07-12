@extends('admin.layouts.app')

@section('page-title', isset($testimonial->id) ? 'Modifier témoignage' : 'Nouveau témoignage')
@section('title', 'Témoignages')

@section('content')
    @include('admin.partials.crud-header', ['indexRoute' => route('admin.testimonials.index'), 'isForm' => true])

    <div class="card shadow-sm"><div class="card-body">
        <form method="POST" action="{{ isset($testimonial->id) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
            @csrf @if(isset($testimonial->id)) @method('PUT') @endif
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">Nom</label><input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required></div>
                <div class="col-md-4"><label class="form-label">Rôle</label><input type="text" name="role" class="form-control" value="{{ old('role', $testimonial->exists ? $testimonial->localized('role', 'fr') : '') }}"></div>
                <div class="col-md-2"><label class="form-label">Note (1-5)</label><input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" required></div>
                <div class="col-md-2"><label class="form-label">Ordre</label><input type="number" name="order" class="form-control" value="{{ old('order', $testimonial->order ?? 0) }}"></div>
                <div class="col-12"><label class="form-label">Contenu</label><textarea name="content" class="form-control" rows="3" required>{{ old('content', $testimonial->exists ? $testimonial->localized('content', 'fr') : '') }}</textarea></div>
            </div>
            <div class="mt-4"><button type="submit" class="btn btn-primary">Enregistrer</button> <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Annuler</a></div>
        </form>
    </div></div>
@endsection
