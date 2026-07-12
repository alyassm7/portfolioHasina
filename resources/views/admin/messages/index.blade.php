@extends('admin.layouts.app')

@section('page-title', 'Messages')
@section('title', 'Messages')

@section('content')
    <h4 class="mb-4">Messages reçus</h4>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="message-row {{ !$msg->is_read ? 'table-warning' : '' }}"
                            data-href="{{ route('admin.messages.show', $msg) }}"
                            role="button"
                            tabindex="0"
                            aria-label="Ouvrir le message de {{ $msg->name }}">
                            <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->subject }}</td>
                            <td>
                                @if($msg->is_read)
                                    <span class="badge bg-success">Lu</span>
                                @else
                                    <span class="badge bg-warning text-dark">Non lu</span>
                                @endif
                            </td>
                            <td class="text-end message-row-actions">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Aucun message.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
