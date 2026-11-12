@php
  use App\Models\ContactMessage;
  use App\Models\Setting;
  $unreadCount = ContactMessage::where('is_read', false)->count();
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') | {{ $siteName }} Backend</title>
  <link rel="icon" type="image/png" href="{{ asset('images/bijuys-icon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/bijuys-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <script>
    (function () {
      var theme = localStorage.getItem('bijuys-admin-theme') || 'light';
      document.documentElement.setAttribute('data-admin-theme', theme);
    })();
  </script>
  <script src="{{ asset('js/admin.js') }}" defer></script>
  @stack('styles')
</head>
<body class="admin-body">

  <div class="admin-layout">
    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
      <div class="sidebar-brand">
        <a class="brand-link brand-logo-link" href="{{ route('admin.dashboard') }}" aria-label="{{ $siteName }} Admin">
          <img class="admin-logo-name logo-dark" src="{{ asset('images/bijuys-logo-dark.png') }}" alt="{{ $siteName }}" height="36">
          <img class="admin-logo-name logo-light" src="{{ asset('images/bijuys-logo-light.png') }}" alt="{{ $siteName }}" height="36">
        </a>
      </div>

      <nav class="sidebar-nav">
        <div class="nav-section-title">Overview</div>
        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
          Dashboard
        </a>

        <div class="nav-section-title">Content Management</div>
        <a class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          Site Info & Bio
        </a>

        <a class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>
          Projects (Work)
        </a>

        <a class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
          Blog Articles
        </a>

        <a class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}" href="{{ route('admin.skills.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          Skills & Stack
        </a>

        <a class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}" href="{{ route('admin.experiences.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          Career Timeline
        </a>

        <a class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
          Services / Capabilities
        </a>

        <div class="nav-section-title">Communication</div>
        <a class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          Inquiries
          @if($unreadCount > 0)
            <span class="badge">{{ $unreadCount }}</span>
          @endif
        </a>

        <div class="nav-section-title" style="margin-top: auto;">Quick Links</div>
        <a class="sidebar-link" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          View Live Website
        </a>
      </nav>

      <div class="sidebar-footer">
        <div class="admin-user-info">
          <div class="user-avatar" style="overflow: hidden; padding: 0;">
            <img src="{{ Setting::getBioImageUrl() }}" alt="Admin Avatar" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div class="user-details">
            <h5>{{ Auth::user()->name ?? $ownerName }}</h5>
            <span>Administrator</span>
          </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-secondary btn-sm" title="Log Out">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </button>
        </form>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
      <header class="admin-topbar">
        <h1 class="topbar-title">@yield('page_title', 'Dashboard')</h1>
        <div class="topbar-actions">
          <!-- Theme Switcher Toggle -->
          <button class="admin-theme-toggle" id="admin-theme-toggle" type="button" aria-label="Toggle theme" title="Toggle Light / Dark Theme">
            <!-- Sun icon when dark (click to switch to light) -->
            <svg class="admin-theme-icon-light" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon icon when light (click to switch to dark) -->
            <svg class="admin-theme-icon-dark" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <span class="admin-theme-text">Dark Mode</span>
          </button>

          <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary btn-sm">
            Live Preview
          </a>
          @yield('topbar_actions')
        </div>
      </header>

      <div class="admin-content">
        <!-- Flash Alert Messages -->
        @if(session('success'))
          <div class="admin-alert admin-alert-success">
            <div>{{ session('success') }}</div>
            <span style="cursor: pointer;" onclick="this.parentElement.remove();">&times;</span>
          </div>
        @endif

        @if(session('error'))
          <div class="admin-alert admin-alert-danger">
            <div>{{ session('error') }}</div>
            <span style="cursor: pointer;" onclick="this.parentElement.remove();">&times;</span>
          </div>
        @endif

        @if($errors->any())
          <div class="admin-alert admin-alert-danger">
            <ul style="padding-left: 1.25rem;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <span style="cursor: pointer;" onclick="this.parentElement.remove();">&times;</span>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  @stack('scripts')
</body>
</html>
