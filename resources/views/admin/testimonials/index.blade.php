@extends('admin.layouts.app')

@section('page-title', 'Témoignages')
@section('title', 'Témoignages')

@section('content')
    @include('admin.partials.crud-header', ['title' => 'Témoignages', 'createRoute' => route('admin.testimonials.create')])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Nom</th><th>Note</th><th>Contenu</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>{{ $t->name }}</td>
                            <td>{{ str_repeat('★', $t->rating) }}</td>
                            <td>{{ Str::limit($t->localized('content', 'fr'), 60) }}</td>
                            <td>
                                <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Aucun témoignage.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
