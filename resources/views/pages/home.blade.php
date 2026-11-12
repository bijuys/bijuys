@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
  $ownerTitle = Setting::get('owner_title', 'Senior Full-Stack Engineer & Product Designer');
  $heroBadge = Setting::get('hero_badge', 'Available for freelance & full-time roles');
  $heroTitle = Setting::get('hero_title', 'Crafting fast, intuitive & human-centered web experiences.');
  $heroSubtitle = Setting::get('hero_subtitle', "Hi, I'm {$ownerName}. I'm a full-stack engineer and digital product designer passionate about clean code, modern web standards, and high-impact digital products.");
  $statExp = Setting::get('stat_experience', '7+');
  $statProjects = Setting::get('stat_projects', '45+');
  $statSat = Setting::get('stat_satisfaction', '99%');
  $availability = Setting::get('availability', 'Open to Projects');
  $bioImageUrl = Setting::getBioImageUrl();
@endphp

@extends('layouts.app')

@section('title', $siteName . ' | ' . $ownerName . ' - ' . $ownerTitle)

@section('content')
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-grid">
        <div class="hero-content">
          @if($heroBadge)
            <div class="hero-badge">{{ $heroBadge }}</div>
          @endif
          <h1 class="hero-title">
            {!! preg_replace('/human-centered/i', '<span class="gradient-text">$0</span>', e($heroTitle)) !!}
          </h1>
          <p class="hero-subtitle">
            {{ $heroSubtitle }}
          </p>
          <div class="hero-actions">
            <a href="{{ route('work') }}" class="btn btn-primary">
              View My Work
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Get in Touch</a>
          </div>
          <div class="hero-stats">
            <div class="stat-item">
              <span class="stat-number">{{ $statExp }}</span>
              <span class="stat-label">Years of Experience</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">{{ $statProjects }}</span>
              <span class="stat-label">Projects Completed</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">{{ $statSat }}</span>
              <span class="stat-label">Client Satisfaction</span>
            </div>
          </div>
        </div>

        <div class="hero-visual">
          <div class="hero-avatar-card">
            <div class="avatar-inner">
              <div class="avatar-graphic" style="width: 140px; height: 140px; border-radius: 28px; overflow: hidden; margin: 0 auto 1.25rem; border: 3px solid var(--accent-primary); box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);">
                <img src="{{ $bioImageUrl }}" alt="{{ $ownerName }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
              </div>
              <h3 style="font-size: 1.35rem; font-weight: 800; margin-bottom: 0.25rem; letter-spacing: -0.02em;">{{ $ownerName }}</h3>
              <p style="color: var(--accent-primary); font-size: 0.9rem; font-weight: 600;">{{ $ownerTitle }}</p>
              <div style="margin-top: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap; justify-content: center;">
                <span class="tag">PHP / Laravel</span>
                <span class="tag">TypeScript</span>
                <span class="tag">React / Vue</span>
                <span class="tag">UI/UX</span>
              </div>
              <div class="avatar-badge-float">
                <span style="display:inline-block; width:8px; height:8px; background-color: var(--success); border-radius: 50%;"></span>
                {{ $availability }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Capabilities / Services Section -->
  @if($services->isNotEmpty())
    <section class="section section-muted">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">Capabilities</span>
          <h2 class="section-title">What I Bring to the Table</h2>
          <p class="section-desc">Specialized in turning complex requirements into robust, scalable, and maintainable software.</p>
        </div>

        <div class="features-grid">
          @foreach($services as $index => $service)
            <div class="feature-card">
              <div class="feature-icon">
                @if($index == 0)
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                @elseif($index == 1)
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg>
                @elseif($index == 2)
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 17.58A5 5 0 0 0 18 8h-1.26A8 8 0 1 0 4 16.25"></path><line x1="8" y1="16" x2="8.01" y2="16"></line><line x1="8" y1="20" x2="8.01" y2="20"></line><line x1="12" y1="18" x2="12.01" y2="18"></line><line x1="12" y1="22" x2="12.01" y2="22"></line><line x1="16" y1="16" x2="16.01" y2="16"></line><line x1="16" y1="20" x2="16.01" y2="20"></line></svg>
                @else
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                @endif
              </div>
              <h3 class="feature-title">{{ $service->title }}</h3>
              <p class="feature-desc">{{ $service->description }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Featured Projects Preview -->
  @if($featuredProjects->isNotEmpty())
    <section class="section">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">Selected Work</span>
          <h2 class="section-title">Recent Featured Projects</h2>
          <p class="section-desc">A snapshot of recent web applications and platforms I have engineered.</p>
        </div>

        <div class="projects-grid">
          @foreach($featuredProjects as $project)
            <article class="project-card">
              <div class="project-media" style="aspect-ratio: 16 / 10; overflow: hidden; position: relative; background: var(--bg-tertiary);">
                @if($project->live_url)
                  <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" style="display: block; width: 100%; height: 100%;">
                    <img 
                      src="{{ $project->image_url }}" 
                      alt="{{ $project->title }}" 
                      loading="lazy"
                      style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-normal);"
                      onmouseover="this.style.transform='scale(1.05)'"
                      onmouseout="this.style.transform='scale(1)'"
                    >
                  </a>
                @else
                  <img 
                    src="{{ $project->image_url }}" 
                    alt="{{ $project->title }}" 
                    loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-normal);"
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'"
                  >
                @endif
                @if($project->badge_text)
                  <span class="tag" style="position: absolute; top: 0.85rem; left: 0.85rem; z-index: 2; background: rgba(10, 13, 20, 0.85); backdrop-filter: blur(8px); border-color: rgba(255,255,255,0.15);">
                    {{ $project->badge_text }}
                  </span>
                @endif
              </div>
              <div class="project-body">
                <div class="project-tags">
                  @foreach($project->tags_list as $tag)
                    <span class="tag">{{ $tag }}</span>
                  @endforeach
                </div>
                <h3 class="project-title">{{ $project->title }}</h3>
                <p class="project-desc">{{ $project->description }}</p>
                <div class="project-footer">
                  <span style="font-size: 0.8125rem; color: var(--text-muted);">{{ $project->badge_text ?? ucfirst($project->category) }}</span>
                  <div class="project-links">
                    @if($project->github_url)
                      <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="Code on GitHub">Code</a>
                    @endif
                    @if($project->live_url)
                      <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="Live Demo">Live Demo &rarr;</a>
                    @else
                      <a href="{{ route('work') }}" class="project-link">Learn More &rarr;</a>
                    @endif
                  </div>
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
          <a href="{{ route('work') }}" class="btn btn-secondary">
            View All Projects
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
          </a>
        </div>
      </div>
    </section>
  @endif

  <!-- Latest Blog Posts -->
  @if($latestPosts->isNotEmpty())
    <section class="section section-muted">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">Recent Writing</span>
          <h2 class="section-title">Latest Articles & Insights</h2>
          <p class="section-desc">Thoughts on web architecture, software craftsmanship, and performance.</p>
        </div>

        <div class="projects-grid">
          @foreach($latestPosts as $post)
            <article class="project-card">
              <div class="project-media" style="aspect-ratio: 16 / 9; overflow: hidden; position: relative; background: var(--bg-tertiary);">
                <a href="{{ route('blog.show', $post->slug) }}" style="display: block; width: 100%; height: 100%;">
                  <img 
                    src="{{ $post->image_url }}" 
                    alt="{{ $post->title }}" 
                    loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-normal);"
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'"
                  >
                </a>
                <span class="tag" style="position: absolute; top: 0.85rem; left: 0.85rem; z-index: 2; background: rgba(10, 13, 20, 0.85); backdrop-filter: blur(8px); border-color: rgba(255,255,255,0.15);">
                  {{ $post->category }}
                </span>
              </div>

              <div class="project-body">
                <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                  <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->format('M d, Y') }}</time>
                  <span>&bull; {{ $post->read_time }}</span>
                </div>

                <h3 class="project-title" style="font-size: 1.2rem; line-height: 1.35;">
                  <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;">
                    {{ $post->title }}
                  </a>
                </h3>

                <p class="project-desc" style="font-size: 0.925rem; margin-bottom: 1.25rem;">
                  {{ Str::limit($post->excerpt, 110) }}
                </p>

                <div class="project-footer">
                  <div class="project-tags">
                    @foreach(array_slice($post->tags_list, 0, 2) as $tag)
                      <span class="tag">{{ $tag }}</span>
                    @endforeach
                  </div>
                  <a href="{{ route('blog.show', $post->slug) }}" class="project-link">
                    Read &rarr;
                  </a>
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
          <a href="{{ route('blog.index') }}" class="btn btn-secondary">
            View All Articles
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
          </a>
        </div>
      </div>
    </section>
  @endif

  <!-- Call to Action Banner -->
  <section class="section" style="padding-top: 0;">
    <div class="container">
      <div class="cta-banner">
        <h2 class="cta-banner-title">Let’s build something extraordinary together.</h2>
        <p class="cta-banner-desc">
          Have a project in mind, need architecture consulting, or looking to augment your development team? I'm always open to discussing new opportunities.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
          <a href="{{ route('contact') }}" class="btn btn-secondary">Start a Conversation</a>
          <a href="{{ route('about') }}" class="btn" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);">Learn More About Me</a>
        </div>
      </div>
    </div>
  </section>
@endsection
