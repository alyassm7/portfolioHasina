@extends('admin.layouts.app')

@section('page-title', 'Projets')
@section('title', 'Projets')

@section('content')
    @include('admin.partials.crud-header', [
        'title' => 'Projets',
        'createRoute' => route('admin.projects.create'),
    ])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Technologies</th>
                        <th>Mis en avant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->order }}</td>
                            <td>{{ $project->localized('title', 'fr') }}</td>
                            <td>{{ implode(', ', $project->technologies ?? []) }}</td>
                            <td>@if($project->is_featured)<span class="badge bg-success">Oui</span>@else<span class="badge bg-secondary">Non</span>@endif</td>
                            <td>
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="d-inline" onsubmit="return confirm('Supprimer ce projet ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Aucun projet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
