@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
@endphp

@extends('layouts.app')

@section('title', 'Work & Projects | ' . $ownerName . ' - ' . $siteName)

@section('content')
  <!-- Work Header -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Portfolio</span>
        <h1 class="section-title">Selected Projects</h1>
        <p class="section-desc">
          A curated collection of web applications, full-stack systems, and user interfaces built with performance, security, and human-centric design.
        </p>
      </div>

      <!-- Filter Controls -->
      <div class="filter-tabs" role="tablist" aria-label="Project category filters">
        <button class="filter-btn active" data-filter="all" type="button">All Projects</button>
        <button class="filter-btn" data-filter="fullstack" type="button">Full-Stack</button>
        <button class="filter-btn" data-filter="frontend" type="button">Frontend</button>
        <button class="filter-btn" data-filter="design" type="button">Design / UI</button>
      </div>

      <!-- Projects Grid -->
      <div class="projects-grid" id="projects-container">
        @forelse($projects as $project)
          <article class="project-card" data-category="{{ $project->category }}">
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
              <h2 class="project-title">{{ $project->title }}</h2>
              <p class="project-desc">
                {{ $project->description }}
              </p>
              <div class="project-footer">
                <span style="font-size: 0.8125rem; color: var(--text-muted);">{{ $project->badge_text ?? ucfirst($project->category) }}</span>
                <div class="project-links">
                  @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="View source code on GitHub">
                      Code
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    </a>
                  @endif
                  @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="Launch Live Demo">
                      Live Demo &rarr;
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </article>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem;">
            <h3>No projects published yet.</h3>
            <p style="color: var(--text-muted);">Check back soon or add projects via the admin dashboard.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Project Workflow -->
  <section class="section section-muted">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">How I Work</span>
        <h2 class="section-title">My Development Workflow</h2>
        <p class="section-desc">A structured, transparent cycle designed to deliver exceptional results on schedule.</p>
      </div>

      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <span style="font-weight: 800; font-size: 1.25rem;">01</span>
          </div>
          <h3 class="feature-title">Discovery & Strategy</h3>
          <p class="feature-desc">Understanding user needs, business goals, and technical constraints to establish clear milestones and success criteria.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <span style="font-weight: 800; font-size: 1.25rem;">02</span>
          </div>
          <h3 class="feature-title">Architecture & UX</h3>
          <p class="feature-desc">Structuring scalable database schemas, backend services, component hierarchies, and interactive wireframes.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <span style="font-weight: 800; font-size: 1.25rem;">03</span>
          </div>
          <h3 class="feature-title">Agile Build & Testing</h3>
          <p class="feature-desc">Developing modular, typed code with automated tests, continuous integration, and frequent stakeholder demo drops.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <span style="font-weight: 800; font-size: 1.25rem;">04</span>
          </div>
          <h3 class="feature-title">Launch & Optimization</h3>
          <p class="feature-desc">Deploying to high-availability servers or edge networks, configuring observability, and fine-tuning Core Web Vitals performance.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to action -->
  <section class="section" style="padding-top: 0;">
    <div class="container">
      <div class="cta-banner">
        <h2 class="cta-banner-title">Need a tailored solution for your product?</h2>
        <p class="cta-banner-desc">Let’s discuss your technical roadmap and build an exceptional experience together.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
          <a href="{{ route('contact') }}" class="btn btn-secondary">Get in Touch</a>
          <a href="{{ route('about') }}" class="btn" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);">Read My Bio</a>
        </div>
      </div>
    </div>
  </section>
@endsection
