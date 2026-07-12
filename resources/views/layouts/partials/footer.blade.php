<footer class="portfolio-footer">
    <div class="container">
        <div class="footer-grid py-5">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo-link">
                    <span class="brand-logo">HR</span>
                    <span class="brand-name gradient-text">{{ $settings['hero_name'] ?? 'Hasina Ralison' }}</span>
                </a>
                <p class="footer-tagline">{{ __('portfolio.footer.tagline') }}</p>
            </div>

            <div class="footer-nav">
                <h6>{{ __('portfolio.footer.navigation') }}</h6>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('portfolio.nav.home') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('portfolio.nav.about') }}</a></li>
                    <li><a href="{{ route('skills') }}">{{ __('portfolio.nav.skills') }}</a></li>
                    <li><a href="{{ route('projects') }}">{{ __('portfolio.nav.projects') }}</a></li>
                    <li><a href="{{ route('experiences') }}">{{ __('portfolio.nav.experiences') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('portfolio.nav.contact') }}</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h6>{{ __('portfolio.footer.contact') }}</h6>
                @if(!empty($settings['email']))
                    <a href="mailto:{{ $settings['email'] }}"><i class="fas fa-envelope"></i> {{ $settings['email'] }}</a>
                @endif
                @if(!empty($settings['phone']))
                    <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}"><i class="fas fa-phone"></i> {{ $settings['phone'] }}</a>
                @endif
            </div>

            <div class="footer-social">
                <h6>{{ __('portfolio.footer.social') }}</h6>
                <div class="social-links">
                    @if(!empty($settings['github_url']))
                        <a href="{{ $settings['github_url'] }}" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    @endif
                    @if(!empty($settings['linkedin_url']))
                        <a href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if(!empty($settings['email']))
                        <a href="mailto:{{ $settings['email'] }}" aria-label="Email"><i class="fas fa-envelope"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer-bottom py-3">
            <p class="mb-0">&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Hasina Ralison' }}. {{ __('portfolio.footer.rights') }}</p>
        </div>
    </div>
</footer>
