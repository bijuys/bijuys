@php
  use App\Models\Setting;
  $siteName = Setting::get('site_name', 'Bijuys');
  $ownerName = Setting::get('owner_name', 'Biju Yohannan');
  $ownerTitle = Setting::get('owner_title', 'Senior Full-Stack Engineer & Product Designer');
@endphp

@extends('layouts.app')

@section('title', $post->title . ' | ' . $siteName . ' Blog')
@section('description', $post->excerpt)

@section('content')
  <article class="section" style="padding-bottom: 3rem;">
    <div class="container" style="max-width: 820px;">

      <!-- Breadcrumb & Back Link -->
      <div style="margin-bottom: 2rem;">
        <a href="{{ route('blog.index') }}" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
          &larr; Back to all articles
        </a>
      </div>

      <!-- Article Header -->
      <header style="margin-bottom: 2.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 2rem;">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
          <span class="section-badge" style="margin-bottom: 0;">{{ $post->category }}</span>
          <span style="color: var(--text-muted); font-size: 0.875rem;">&bull;</span>
          <span style="color: var(--text-muted); font-size: 0.875rem;">{{ $post->read_time }}</span>
        </div>

        <h1 style="font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800; letter-spacing: -0.03em; line-height: 1.25; margin-bottom: 1.25rem;">
          {{ $post->title }}
        </h1>

        <div style="display: flex; align-items: center; gap: 1rem; color: var(--text-secondary); font-size: 0.95rem;">
          <div style="width: 44px; height: 44px; border-radius: 50%; overflow: hidden; border: 2px solid var(--accent-primary); flex-shrink: 0; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);">
            <img src="{{ Setting::getBioImageUrl() }}" alt="{{ $ownerName }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div>
            <strong>{{ $ownerName }}</strong>
            <div style="font-size: 0.8125rem; color: var(--text-muted);">
              Published on {{ $post->published_at?->format('F d, Y') }}
            </div>
          </div>
        </div>
      </header>

      <!-- Article Hero Image -->
      <div style="margin-bottom: 2.5rem; border-radius: 16px; overflow: hidden; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
        <img 
          src="{{ $post->image_url }}" 
          alt="{{ $post->title }}" 
          style="width: 100%; max-height: 440px; object-fit: cover; display: block;"
        >
      </div>

      <!-- Article Excerpt Lead -->
      <div style="font-size: 1.2rem; line-height: 1.7; color: var(--text-primary); font-weight: 500; margin-bottom: 2rem; border-left: 4px solid var(--accent-primary); padding-left: 1.25rem;">
        {{ $post->excerpt }}
      </div>

      <!-- Article Main Content -->
      <div class="article-content" style="font-size: 1.075rem; line-height: 1.8; color: var(--text-secondary);">
        {!! nl2br(e($post->content)) !!}
      </div>

      <!-- Article Tags -->
      @if(!empty($post->tags_list))
        <div style="margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
          <span style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted);">Tags:</span>
          @foreach($post->tags_list as $tag)
            <span class="tag">#{{ $tag }}</span>
          @endforeach
        </div>
      @endif

      <!-- Author Bio Card -->
      <div style="margin-top: 3.5rem; background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2rem; display: flex; gap: 1.5rem; align-items: center; flex-wrap: wrap;">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: var(--accent-light); color: var(--accent-primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; flex-shrink: 0;">
          {{ substr($ownerName, 0, 1) }}
        </div>
        <div style="flex: 1; min-width: 240px;">
          <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.25rem;">Written by {{ $ownerName }}</h3>
          <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 0.75rem;">{{ $ownerTitle }}</p>
          <p style="color: var(--text-secondary); font-size: 0.925rem; line-height: 1.6;">
            Specializing in performant PHP/Laravel architecture, accessible web standards, and human-centric software.
          </p>
        </div>
      </div>

      <!-- Related / Recent Articles -->
      @if($relatedPosts->isNotEmpty())
        <div style="margin-top: 4.5rem;">
          <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 1.5rem;">Related Articles</h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
            @foreach($relatedPosts as $rel)
              <div style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                  <span class="tag" style="margin-bottom: 0.5rem;">{{ $rel->category }}</span>
                  <h4 style="font-size: 1rem; font-weight: 700; line-height: 1.4; margin-bottom: 0.5rem;">
                    <a href="{{ route('blog.show', $rel->slug) }}" style="color: inherit; text-decoration: none;">
                      {{ $rel->title }}
                    </a>
                  </h4>
                  <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5;">
                    {{ Str::limit($rel->excerpt, 80) }}
                  </p>
                </div>
                <div style="margin-top: 1rem; font-size: 0.8125rem;">
                  <a href="{{ route('blog.show', $rel->slug) }}" style="font-weight: 600;">Read More &rarr;</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </article>
@endsection
