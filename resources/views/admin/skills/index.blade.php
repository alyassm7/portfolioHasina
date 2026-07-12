@extends('admin.layouts.app')

@section('page-title', 'Compétences')
@section('title', 'Compétences')

@section('content')
    @include('admin.partials.crud-header', ['title' => 'Compétences', 'createRoute' => route('admin.skills.create')])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Nom</th><th>%</th><th>Catégorie</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr>
                            <td><i class="{{ $skill->icon }}"></i> {{ $skill->localized('name', 'fr') }}</td>
                            <td>{{ $skill->percentage }}%</td>
                            <td>{{ $skill->localized('category', 'fr') }}</td>
                            <td>
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Aucune compétence.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
