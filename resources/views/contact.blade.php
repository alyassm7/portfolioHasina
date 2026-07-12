@extends('layouts.app')

@section('title', __('portfolio.contact.title') . ' — ' . ($settings['site_name'] ?? 'Portfolio'))

@section('content')
    <section class="page-hero section-padding">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-tag">{{ __('portfolio.contact.tag') }}</span>
                <h1 class="section-title gradient-text-inline">{{ __('portfolio.contact.heading') }}</h1>
            </div>

            <div class="row g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="contact-info glass-card tilt-card" data-tilt data-tilt-max="4">
                        <h3 class="mb-4">{{ __('portfolio.contact.subtitle') }}</h3>
                        <p class="contact-intro mb-4">{{ __('portfolio.contact.intro') }}</p>

                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>{{ __('portfolio.contact.email') }}</strong>
                                <a href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a>
                            </div>
                        </div>
                        @if(!empty($settings['phone']))
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>{{ __('portfolio.contact.phone') }}</strong>
                                    <span>{{ $settings['phone'] }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="contact-item">
                            <i class="fab fa-github"></i>
                            <div>
                                <strong>GitHub</strong>
                                <a href="{{ $settings['github_url'] ?? '#' }}" target="_blank">{{ $settings['github_url'] ?? '' }}</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-linkedin-in"></i>
                            <div>
                                <strong>LinkedIn</strong>
                                <a href="{{ $settings['linkedin_url'] ?? '#' }}" target="_blank">{{ $settings['linkedin_url'] ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-form-card glass-card tilt-card" data-tilt data-tilt-max="4">
                        <form method="POST" action="{{ route('contact.store') }}" id="contactForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('portfolio.contact.name') }}</label>
                                <input type="text" name="name" class="form-control portfolio-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('portfolio.contact.email') }}</label>
                                <input type="email" name="email" class="form-control portfolio-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('portfolio.contact.subject') }}</label>
                                <input type="text" name="subject" class="form-control portfolio-input @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">{{ __('portfolio.contact.message') }}</label>
                                <textarea name="message" rows="5" class="form-control portfolio-input @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-accent btn-lg w-100">
                                <i class="fas fa-paper-plane me-2"></i>{{ __('portfolio.contact.send') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
