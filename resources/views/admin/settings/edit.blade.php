@extends('admin.layouts.app')

@section('page-title', 'Paramètres')
@section('title', 'Paramètres')

@section('content')
    <div class="admin-page-header">
        <h4>Paramètres du portfolio</h4>
    </div>

    <div class="card mb-4">
        <div class="admin-card-header">
            <h6 class="mb-0"><i class="fas fa-globe me-2 text-primary"></i>Informations générales</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Nom du site</label><input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}"></div>
                    <div class="col-md-6">
                        <label class="form-label">Titre SEO</label>
                        <input type="text" name="site_title_fr" class="form-control mb-2" placeholder="Français" value="{{ $settings['site_title_fr'] ?? '' }}">
                        <input type="text" name="site_title_en" class="form-control" placeholder="English" value="{{ $settings['site_title_en'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Salutation hero</label>
                        <input type="text" name="hero_greeting_fr" class="form-control mb-2" placeholder="Français" value="{{ $settings['hero_greeting_fr'] ?? '' }}">
                        <input type="text" name="hero_greeting_en" class="form-control" placeholder="English" value="{{ $settings['hero_greeting_en'] ?? '' }}">
                    </div>
                    <div class="col-md-4"><label class="form-label">Nom hero</label><input type="text" name="hero_name" class="form-control" value="{{ $settings['hero_name'] ?? '' }}"></div>
                    <div class="col-md-4"><label class="form-label">Années d'expérience</label><input type="text" name="experience_years" class="form-control" value="{{ $settings['experience_years'] ?? '' }}"></div>
                    <div class="col-md-6">
                        <label class="form-label">Rôles hero (séparés par virgule)</label>
                        <input type="text" name="hero_roles_fr" class="form-control mb-2" placeholder="Français" value="{{ $settings['hero_roles_fr'] ?? '' }}">
                        <input type="text" name="hero_roles_en" class="form-control" placeholder="English" value="{{ $settings['hero_roles_en'] ?? '' }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Texte à propos</label>
                        <textarea name="about_text_fr" class="form-control mb-2" rows="4" placeholder="Version française">{{ $settings['about_text_fr'] ?? '' }}</textarea>
                        <textarea name="about_text_en" class="form-control" rows="4" placeholder="English version">{{ $settings['about_text_en'] ?? '' }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="mb-3 fw-semibold"><i class="fas fa-chart-bar me-2 text-info"></i>Statistiques</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-3"><label class="form-label">Stat Projets</label><input type="text" name="stat_projects" class="form-control" value="{{ $settings['stat_projects'] ?? '' }}"></div>
                    <div class="col-md-3"><label class="form-label">Stat Commits</label><input type="text" name="stat_commits" class="form-control" value="{{ $settings['stat_commits'] ?? '' }}"></div>
                    <div class="col-md-3"><label class="form-label">Stat Technologies</label><input type="text" name="stat_technologies" class="form-control" value="{{ $settings['stat_technologies'] ?? '' }}"></div>
                    <div class="col-md-3"><label class="form-label">Stat Motivation</label><input type="text" name="stat_motivation" class="form-control" value="{{ $settings['stat_motivation'] ?? '' }}"></div>
                </div>

                <h6 class="mb-3 fw-semibold"><i class="fas fa-link me-2 text-success"></i>Contact & réseaux</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6"><label class="form-label">GitHub</label><input type="url" name="github_url" class="form-control" value="{{ $settings['github_url'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">LinkedIn</label><input type="url" name="linkedin_url" class="form-control" value="{{ $settings['linkedin_url'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="form-label">Téléphone</label><input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '' }}"></div>
                </div>

                <h6 class="mb-3 fw-semibold"><i class="fas fa-image me-2 text-warning"></i>Médias & SEO</h6>
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Photo profil</label><input type="file" name="about_photo" class="form-control" accept="image/*"></div>
                    <div class="col-md-6"><label class="form-label">Photo hero (fond)</label><input type="file" name="hero_photo" class="form-control" accept="image/*"></div>
                    <div class="col-12">
                        <label class="form-label">Meta description</label>
                        <textarea name="meta_description_fr" class="form-control mb-2" rows="2" placeholder="Français">{{ $settings['meta_description_fr'] ?? '' }}</textarea>
                        <textarea name="meta_description_en" class="form-control" rows="2" placeholder="English">{{ $settings['meta_description_en'] ?? '' }}</textarea>
                    </div>
                    <div class="col-12"><label class="form-label">Meta keywords</label><input type="text" name="meta_keywords" class="form-control" value="{{ $settings['meta_keywords'] ?? '' }}"></div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Enregistrer les paramètres
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="admin-card-header">
            <h6 class="mb-0"><i class="fas fa-file-pdf me-2 text-danger"></i>Curriculum Vitae</h6>
        </div>
        <div class="card-body">
            <p class="text-muted small mb-3">Téléversez votre CV au format PDF. Il sera disponible au téléchargement sur le site public.</p>
            <form method="POST" action="{{ route('admin.settings.cv') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-8"><input type="file" name="cv" class="form-control" accept=".pdf" required></div>
                    <div class="col-md-4"><button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload me-1"></i> Téléverser CV</button></div>
                </div>
            </form>
        </div>
    </div>
@endsection
