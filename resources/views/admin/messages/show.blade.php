@extends('admin.layouts.app')

@section('page-title', 'Message')
@section('title', 'Message')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-trash"></i> Supprimer
            </button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">
                    <i class="fas fa-inbox me-2"></i>Message reçu
                </div>
                <div class="card-body">
                    <div class="message-meta mb-3">
                        <p class="mb-1"><strong>De :</strong> {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                        <p class="mb-1"><strong>Sujet :</strong> {{ $message->subject }}</p>
                        <p class="mb-0 text-muted"><strong>Date :</strong> {{ $message->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <hr>
                    <div class="message-body">{!! nl2br(e($message->body)) !!}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">
                    <i class="fas fa-reply me-2"></i>Répondre
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.messages.reply', $message) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Destinataire</label>
                            <input type="text" class="form-control" value="{{ $message->name }} &lt;{{ $message->email }}&gt;" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="reply-subject" class="form-label">Sujet</label>
                            <input type="text"
                                   id="reply-subject"
                                   name="subject"
                                   class="form-control @error('subject') is-invalid @enderror"
                                   value="{{ old('subject', str_starts_with($message->subject, 'Re:') ? $message->subject : 'Re: '.$message->subject) }}"
                                   required>
                            @error('subject')<div class="invalid-feedback">{{ $errors->first('subject') }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="reply-body" class="form-label">Votre réponse</label>
                            <textarea id="reply-body"
                                      name="body"
                                      rows="8"
                                      class="form-control @error('body') is-invalid @enderror"
                                      placeholder="Bonjour {{ $message->name }},&#10;&#10;Merci pour votre message..."
                                      required>{{ old('body') }}</textarea>
                            @error('body')<div class="invalid-feedback">{{ $errors->first('body') }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer la réponse
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
