@extends('admin.layouts.app')

@section('page-title', 'Certificats')
@section('title', 'Certificats')

@section('content')
    @include('admin.partials.crud-header', ['title' => 'Certificats', 'createRoute' => route('admin.certificates.create')])

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Organisme</th>
                        <th>Année</th>
                        <th>Fichier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificates as $cert)
                        <tr>
                            <td>{{ $cert->title }}</td>
                            <td>{{ $cert->issuer ?: '—' }}</td>
                            <td>{{ $cert->year ?: '—' }}</td>
                            <td>
                                @if($cert->fileUrl())
                                    <a href="{{ $cert->fileUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-file"></i> Voir
                                    </a>
                                @else
                                    <span class="text-muted">Aucun</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.certificates.edit', $cert) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.certificates.destroy', $cert) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Aucun certificat. Cliquez sur « Ajouter » pour en importer un.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
