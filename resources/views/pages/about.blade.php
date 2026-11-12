@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
  $ownerTitle = Setting::get('owner_title', 'Senior Full-Stack Engineer & Product Designer');
  $aboutLead = Setting::get('about_lead', 'Bridging technical precision with thoughtful design.');
  $aboutBio1 = Setting::get('about_bio_1', "I am a software engineer and designer working at the intersection of robust backend infrastructure and intuitive user interfaces.");
  $aboutBio2 = Setting::get('about_bio_2', "Over the last 7+ years, I’ve collaborated with fast-growing startups, creative agencies, and global technology teams. My focus is always on creating maintainable systems that serve real people without needless bloat.");
  $aboutBio3 = Setting::get('about_bio_3', "When I'm not writing code or architecting APIs, you’ll find me contributing to open-source software, tinkering with mechanical keyboards, or exploring digital design trends.");
  $location = Setting::get('location', 'San Francisco, CA (Remote Friendly)');
  $availability = Setting::get('availability', 'Open to Projects');
  $statExp = Setting::get('stat_experience', '7+');
  $bioImageUrl = Setting::getBioImageUrl();
@endphp

@extends('layouts.app')

@section('title', 'About Me | ' . $ownerName . ' - ' . $siteName)

@section('content')
  <!-- About Hero Section -->
  <section class="section">
    <div class="container">
      <div class="about-hero-grid">
        <div>
          <span class="section-badge">Background & Story</span>
          <h1 class="section-title">{{ $aboutLead }}</h1>
          <p class="about-intro-lead">
            {{ $aboutBio1 }}
          </p>
          <p class="about-intro-text">
            {{ $aboutBio2 }}
          </p>
          @if($aboutBio3)
            <p class="about-intro-text">
              {{ $aboutBio3 }}
            </p>
          @endif
          <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <a href="{{ route('contact') }}" class="btn btn-primary">Let's Collaborate</a>
            <a href="{{ route('work') }}" class="btn btn-secondary">Explore Projects</a>
          </div>
        </div>

        <div class="about-image-card">
          <div class="about-image-inner">
            <!-- Bio Photo Showcase -->
            <div style="position: relative; margin-bottom: 1.5rem; border-radius: 16px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
              <img 
                src="{{ $bioImageUrl }}" 
                alt="{{ $ownerName }}" 
                style="width: 100%; height: 280px; object-fit: cover; display: block; transition: transform var(--transition-normal);"
                onmouseover="this.style.transform='scale(1.03)'"
                onmouseout="this.style.transform='scale(1)'"
              >
              <div style="position: absolute; bottom: 0.75rem; right: 0.75rem; background: rgba(10, 13, 20, 0.85); backdrop-filter: blur(8px); padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); display: flex; align-items: center; gap: 0.4rem;">
                <span style="display:inline-block; width:7px; height:7px; background:#10b981; border-radius:50%;"></span>
                {{ $availability }}
              </div>
            </div>

            <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
              <h3 style="font-size: 1.35rem; font-weight: 800; letter-spacing: -0.02em;">{{ $ownerName }}</h3>
              <p style="color: var(--accent-primary); font-size: 0.9rem; font-weight: 600;">{{ $ownerTitle }}</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.95rem;">
              <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Location</span>
                <strong>{{ $location }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Experience</span>
                <strong>{{ $statExp }} Years</strong>
              </div>
              <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Specialization</span>
                <strong>Laravel, Web Apps &amp; Design</strong>
              </div>
              <div style="display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Status</span>
                <span style="color: var(--success); font-weight: 600;">{{ $availability }}</span>
              </div>
            </div>

            <div style="background-color: var(--bg-tertiary); padding: 1.25rem; border-radius: var(--radius-md); border-left: 4px solid var(--accent-primary);">
              <p style="font-size: 0.875rem; font-style: italic; color: var(--text-secondary); margin: 0;">
                "Perfection is achieved not when there is nothing more to add, but when there is nothing left to take away."
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Skills & Technologies -->
  @if($skills->isNotEmpty())
    <section class="section section-muted" id="skills">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">Toolkit</span>
          <h2 class="section-title">Skills & Technologies</h2>
          <p class="section-desc">Tools, languages, and frameworks I leverage to engineer reliable software.</p>
        </div>

        <div class="skills-container">
          @foreach($skills as $category => $skillList)
            <div class="skill-category-card">
              <h3 class="skill-cat-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                {{ $category }}
              </h3>
              <div class="skill-pill-list">
                @foreach($skillList as $skill)
                  <span class="skill-pill">{{ $skill->name }}</span>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Work Experience Timeline -->
  @if($experiences->isNotEmpty())
    <section class="section" id="experience">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">Career Journey</span>
          <h2 class="section-title">Experience & Milestones</h2>
          <p class="section-desc">My professional track record across roles and organizations.</p>
        </div>

        <div class="timeline">
          @foreach($experiences as $exp)
            <div class="timeline-item">
              <div class="timeline-marker"></div>
              <div class="timeline-date">{{ $exp->period }}</div>
              <h3 class="timeline-role">{{ $exp->role }}</h3>
              <div class="timeline-company">{{ $exp->company }} @if($exp->location) &bull; {{ $exp->location }} @endif</div>
              <p class="timeline-desc">{{ $exp->description }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Core Values -->
  <section class="section section-muted">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Philosophy</span>
        <h2 class="section-title">How I Approach My Work</h2>
        <p class="section-desc">Guiding principles that steer my engineering decisions every day.</p>
      </div>

      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
          </div>
          <h3 class="feature-title">Accessibility & Inclusion</h3>
          <p class="feature-desc">The web is for everyone. I build with semantic markup, keyboard navigability, proper contrast ratios, and screen-reader support baked in from day one.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
          </div>
          <h3 class="feature-title">Performance as a Feature</h3>
          <p class="feature-desc">A millisecond saved is retention earned. I avoid heavy dependencies where native web standards excel, keeping bundle sizes lean and interaction times instant.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16.5 9.4 7.55 4.24a1.78 1.78 0 0 0-2.5 1.55v12.42a1.78 1.78 0 0 0 2.5 1.55L16.5 14.6a1.78 1.78 0 0 0 0-3.2z"></path></svg>
          </div>
          <h3 class="feature-title">Continuous Iteration</h3>
          <p class="feature-desc">Shipping early and learning fast beats endless planning. I rely on clear feedback loops, user telemetry, and clean code to evolve products sustainably.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="section" style="padding-top: 0;">
    <div class="container">
      <div class="cta-banner">
        <h2 class="cta-banner-title">Interested in working together?</h2>
        <p class="cta-banner-desc">Let's discuss how my experience and skills can help drive results for your project.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
          <a href="{{ route('contact') }}" class="btn btn-secondary">Get in Touch</a>
          <a href="{{ route('work') }}" class="btn" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);">View Portfolio</a>
        </div>
      </div>
    </div>
  </section>
@endsection
