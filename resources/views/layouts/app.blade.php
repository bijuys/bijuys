@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
  $ownerTitle = Setting::get('owner_title', 'Senior Full-Stack Engineer & Product Designer');
  $githubUrl = Setting::get('github_url', 'https://github.com');
  $linkedinUrl = Setting::get('linkedin_url', 'https://linkedin.com');
  $twitterUrl = Setting::get('twitter_url', 'https://twitter.com');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', $siteName . ' | ' . $ownerName . ' - ' . $ownerTitle)</title>
  <meta name="description" content="@yield('description', 'Official website and portfolio of ' . $ownerName . ' (' . $siteName . ') - ' . $ownerTitle)">
  <link rel="icon" type="image/png" href="{{ asset('images/bijuys-icon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/bijuys-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="{{ asset('js/main.js') }}" defer></script>
  @stack('styles')
</head>
<body>

  <!-- Site Header -->
  <header class="site-header">
    <div class="container header-inner">
      <a class="site-logo" href="{{ route('home') }}" aria-label="{{ $siteName }} Home">
        <img class="site-logo-name logo-dark" src="{{ asset('images/bijuys-logo-dark.png') }}" alt="{{ $siteName }}" height="44">
        <img class="site-logo-name logo-light" src="{{ asset('images/bijuys-logo-light.png') }}" alt="{{ $siteName }}" height="44">
      </a>

      <!-- Navigation -->
      <nav class="site-nav" id="site-nav" aria-label="Primary">
        <ul class="nav-list">
          <li>
            <a class="nav-link" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>
              Home
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>
              About
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('work') }}" @if(request()->routeIs('work')) aria-current="page" @endif>
              Work
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('blog.index') }}" @if(request()->routeIs('blog.*')) aria-current="page" @endif>
              Blog
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>
              Contact
            </a>
          </li>
          @auth
            <li>
              <a class="nav-link" href="{{ route('admin.dashboard') }}" style="color: var(--accent-primary); font-weight: 600;">
                Admin
              </a>
            </li>
          @endauth
        </ul>
      </nav>

      <!-- Theme Toggle & Hamburger -->
      <div class="header-actions">
        <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Toggle theme">
          <svg class="theme-icon-light" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg class="theme-icon-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <button class="mobile-nav-toggle" id="mobile-nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Open navigation menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Site Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a class="site-logo" href="{{ route('home') }}" aria-label="{{ $siteName }} Home">
            <img class="site-logo-name logo-dark" src="{{ asset('images/bijuys-logo-dark.png') }}" alt="{{ $siteName }}" height="38">
            <img class="site-logo-name logo-light" src="{{ asset('images/bijuys-logo-light.png') }}" alt="{{ $siteName }}" height="38">
          </a>
          <p>
            {{ $ownerName }} &bull; {{ $ownerTitle }}. Dedicated to crafting fast, accessible, and high-impact digital experiences.
          </p>
        </div>

        <div class="footer-col">
          <h4>Navigation</h4>
          <ul class="footer-links">
            <li><a class="footer-link" href="{{ route('home') }}">Home</a></li>
            <li><a class="footer-link" href="{{ route('about') }}">About</a></li>
            <li><a class="footer-link" href="{{ route('work') }}">Work</a></li>
            <li><a class="footer-link" href="{{ route('blog.index') }}">Blog</a></li>
            <li><a class="footer-link" href="{{ route('contact') }}">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Explore</h4>
          <ul class="footer-links">
            <li><a class="footer-link" href="{{ route('about') }}#skills">Skills & Stack</a></li>
            <li><a class="footer-link" href="{{ route('about') }}#experience">Career Timeline</a></li>
            <li><a class="footer-link" href="{{ route('contact') }}#faq">FAQ</a></li>
            @guest
              <li><a class="footer-link" href="{{ route('admin.login') }}" style="color: var(--text-muted); font-size: 0.85rem;">Admin Login</a></li>
            @else
              <li><a class="footer-link" href="{{ route('admin.dashboard') }}" style="color: var(--accent-primary); font-size: 0.85rem;">Admin Dashboard</a></li>
            @endguest
          </ul>
        </div>

        <div class="footer-col">
          <h4>Connect</h4>
          <p style="color: var(--text-secondary); font-size: 0.925rem; margin-bottom: 1rem;">
            Follow my work or say hello:
          </p>
          <div class="social-links">
            @if($githubUrl)
              <a class="social-btn" href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path><path d="M9 18c-4.51 2-5-2-7-2"></path></svg>
              </a>
            @endif
            @if($linkedinUrl)
              <a class="social-btn" href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>
              </a>
            @endif
            @if($twitterUrl)
              <a class="social-btn" href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
              </a>
            @endif
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; <span id="current-year">{{ date('Y') }}</span> {{ $ownerName }} ({{ $siteName }}). Built with PHP Laravel.</p>
        <p>All rights reserved.</p>
      </div>
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
