@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | {{ $siteName }}</title>
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
  <style>
    body.login-page {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: var(--admin-bg);
      background-image: radial-gradient(circle at 50% 20%, var(--admin-primary-light) 0%, transparent 60%);
      padding: 1.5rem;
      position: relative;
    }
    .login-theme-bar {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      background-color: var(--admin-card);
      border: 1px solid var(--admin-border);
      border-radius: var(--radius-lg);
      padding: 2.5rem;
      box-shadow: var(--admin-shadow-lg);
    }
    .login-brand {
      text-align: center;
      margin-bottom: 2rem;
    }
    .login-brand h1 {
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--admin-text);
      letter-spacing: -0.025em;
    }
    .login-brand h1 span {
      color: var(--admin-primary);
    }
    .login-brand p {
      color: var(--admin-muted);
      font-size: 0.9rem;
      margin-top: 0.35rem;
    }
  </style>
</head>
<body class="login-page">

  <div class="login-theme-bar">
    <button class="admin-theme-toggle" id="admin-theme-toggle" type="button" aria-label="Toggle theme" title="Toggle Light / Dark Theme">
      <svg class="admin-theme-icon-light" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
      </svg>
      <svg class="admin-theme-icon-dark" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
      </svg>
      <span class="admin-theme-text">Dark Mode</span>
    </button>
  </div>

  <div class="login-card">
    <div class="login-brand">
      <a href="{{ route('home') }}" class="login-logo-link" aria-label="{{ $siteName }} Home">
        <img class="login-logo-name logo-dark" src="{{ asset('images/bijuys-logo-dark.png') }}" alt="{{ $siteName }}">
        <img class="login-logo-name logo-light" src="{{ asset('images/bijuys-logo-light.png') }}" alt="{{ $siteName }}">
      </a>
      <p>Enter your credentials to access the CMS.</p>
    </div>

    @if(session('success'))
      <div class="admin-alert admin-alert-success" style="margin-bottom: 1.25rem;">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="admin-alert admin-alert-danger" style="margin-bottom: 1.25rem;">
        @foreach($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          class="form-control" 
          value="{{ old('email', 'admin@bijuys.com') }}" 
          required 
          autofocus
        >
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          class="form-control" 
          placeholder="••••••••" 
          required
        >
        <span class="form-help">Default demo credentials: <code>admin@bijuys.com</code> / <code>password</code></span>
      </div>

      <div class="form-group" style="display: flex; align-items: center; justify-content: space-between; margin-top: 1rem;">
        <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: var(--admin-muted); cursor: pointer;">
          <input type="checkbox" name="remember" value="1">
          Remember me
        </label>
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem; padding: 0.8rem;">
        Log In to Dashboard &rarr;
      </button>
    </form>

    <div style="margin-top: 2rem; text-align: center;">
      <a href="{{ route('home') }}" style="color: var(--admin-muted); font-size: 0.85rem; text-decoration: none;">
        &larr; Return to Public Website
      </a>
    </div>
  </div>

</body>
</html>
