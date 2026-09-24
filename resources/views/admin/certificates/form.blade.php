@extends('admin.layouts.app')

@section('page-title', isset($certificate->id) ? 'Modifier certificat' : 'Nouveau certificat')
@section('title', 'Certificats')

@section('content')
    @include('admin.partials.crud-header', ['indexRoute' => route('admin.certificates.index'), 'isForm' => true])

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST"
                  action="{{ isset($certificate->id) ? route('admin.certificates.update', $certificate) : route('admin.certificates.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($certificate->id)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Titre du certificat *</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $certificate->title) }}" required
                               placeholder="Ex: Cisco CCNA, Odoo Functional…">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Organisme</label>
                        <input type="text" name="issuer" class="form-control"
                               value="{{ old('issuer', $certificate->issuer) }}"
                               placeholder="Ex: Cisco, Coursera, Microsoft">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Année</label>
                        <input type="text" name="year" class="form-control"
                               value="{{ old('year', $certificate->year) }}" placeholder="2024">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ old('order', $certificate->order ?? 0) }}">
                    </div>
                    <div class="col-md-10">
                        <label class="form-label">Fichier (PDF ou image)</label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png,.webp">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Max 5 Mo — PDF, JPG, PNG ou WebP</small>
                        @if($certificate->fileUrl())
                            <div class="mt-2">
                                <a href="{{ $certificate->fileUrl() }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-eye me-1"></i>Fichier actuel
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
