@extends('admin.layouts.app')

@section('page-title', 'Expériences')
@section('title', 'Expériences')

@section('content')
    @include('admin.partials.crud-header', ['title' => 'Expériences', 'createRoute' => route('admin.experiences.create')])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Année</th><th>Titre</th><th>Entreprise</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($experiences as $exp)
                        <tr>
                            <td>{{ $exp->localized('year', 'fr') }}</td><td>{{ $exp->localized('title', 'fr') }}</td><td>{{ $exp->localized('company', 'fr') }}</td>
                            <td>
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.experiences.destroy', $exp) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Aucune expérience.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
