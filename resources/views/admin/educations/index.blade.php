@extends('admin.layouts.app')

@section('page-title', 'Formations')
@section('title', 'Formations')

@section('content')
    @include('admin.partials.crud-header', ['title' => 'Formations', 'createRoute' => route('admin.educations.create')])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Titre</th><th>Institution</th><th>Année</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($educations as $edu)
                        <tr>
                            <td>{{ $edu->localized('title', 'fr') }}</td><td>{{ $edu->localized('institution', 'fr') }}</td><td>{{ $edu->localized('year', 'fr') }}</td>
                            <td>
                                <a href="{{ route('admin.educations.edit', $edu) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.educations.destroy', $edu) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Aucune formation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
