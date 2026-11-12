@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
@endphp

@extends('layouts.app')

@section('title', 'Blog & Articles | ' . $ownerName . ' - ' . $siteName)
@section('description', 'Technical articles, architectural insights, and web development thoughts by ' . $ownerName . '.')

@section('content')
  <!-- Blog Header -->
  <section class="section" style="padding-bottom: 2rem;">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Writing & Insights</span>
        <h1 class="section-title">Articles & Thoughts</h1>
        <p class="section-desc">
          Reflections on software architecture, full-stack development, modern web standards, and digital product design.
        </p>
      </div>

      <!-- Search & Filters -->
      <div style="max-width: 600px; margin: 0 auto 2.5rem;">
        <search>
          <form action="{{ route('blog.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
            @if(request('category'))
              <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input 
              type="search" 
              name="search" 
              class="form-input" 
              placeholder="Search articles by keyword or topic..." 
              value="{{ request('search') }}"
              style="border-radius: var(--radius-full); padding-left: 1.25rem;"
            >
            <button type="submit" class="btn btn-primary" style="border-radius: var(--radius-full); padding-inline: 1.5rem;">
              Search
            </button>
          </form>
        </search>
      </div>

      <!-- Category Filter Pills -->
      @if($categories->isNotEmpty())
        <div class="filter-tabs" style="margin-bottom: 3rem;">
          <a href="{{ route('blog.index', array_filter(['search' => request('search')])) }}" 
             class="filter-btn {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
            All Topics
          </a>
          @foreach($categories as $cat)
            <a href="{{ route('blog.index', array_filter(['category' => $cat, 'search' => request('search')])) }}" 
               class="filter-btn {{ request('category') === $cat ? 'active' : '' }}">
              {{ $cat }}
            </a>
          @endforeach
        </div>
      @endif

      <!-- Articles Grid -->
      <div class="projects-grid">
        @forelse($posts as $post)
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

              <h2 class="project-title" style="font-size: 1.25rem; line-height: 1.35;">
                <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;">
                  {{ $post->title }}
                </a>
              </h2>

              <p class="project-desc" style="font-size: 0.925rem; margin-bottom: 1.25rem;">
                {{ Str::limit($post->excerpt, 120) }}
              </p>

              <div class="project-footer">
                <div class="project-tags">
                  @foreach(array_slice($post->tags_list, 0, 2) as $tag)
                    <span class="tag">{{ $tag }}</span>
                  @endforeach
                </div>
                <a href="{{ route('blog.show', $post->slug) }}" class="project-link">
                  Read Article &rarr;
                </a>
              </div>
            </div>
          </article>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem;">
            <h3>No articles found.</h3>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">
              @if(request('search') || request('category'))
                Try clearing your search query or choosing another topic.
                <div style="margin-top: 1rem;">
                  <a href="{{ route('blog.index') }}" class="btn btn-secondary btn-sm">Clear Filters</a>
                </div>
              @else
                Articles will be published soon. Stay tuned!
              @endif
            </p>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if($posts->hasPages())
        <div style="margin-top: 3.5rem; display: flex; justify-content: center;">
          {{ $posts->links() }}
        </div>
      @endif
    </div>
  </section>

  <!-- CTA Banner -->
  <section class="section" style="padding-top: 2rem;">
    <div class="container">
      <div class="cta-banner">
        <h2 class="cta-banner-title">Have thoughts or a project inquiry?</h2>
        <p class="cta-banner-desc">Let’s connect and talk about building impactful web products together.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
          <a href="{{ route('contact') }}" class="btn btn-secondary">Get in Touch</a>
          <a href="{{ route('work') }}" class="btn" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);">Explore Projects</a>
        </div>
      </div>
    </div>
  </section>
@endsection
