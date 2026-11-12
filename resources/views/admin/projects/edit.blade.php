@extends('admin.layout')

@section('title', 'Edit Project: ' . $project->title)
@section('page_title', 'Edit Project')

@section('content')
  <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Edit Project: {{ $project->title }}</h2>
      <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="title" class="form-label">Project Title *</label>
          <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $project->title) }}" required autofocus>
        </div>

        <div class="form-group">
          <label for="category" class="form-label">Category *</label>
          <select id="category" name="category" class="form-control" required>
            <option value="fullstack" {{ old('category', $project->category) == 'fullstack' ? 'selected' : '' }}>Full-Stack</option>
            <option value="frontend" {{ old('category', $project->category) == 'frontend' ? 'selected' : '' }}>Frontend</option>
            <option value="design" {{ old('category', $project->category) == 'design' ? 'selected' : '' }}>Design / UI</option>
            <option value="mobile" {{ old('category', $project->category) == 'mobile' ? 'selected' : '' }}>Mobile / Other</option>
          </select>
        </div>
      </div>

      <!-- Project Cover Image Card -->
      <div class="form-group" style="background: var(--admin-bg); border: 2px dashed var(--admin-border); border-radius: 12px; padding: 1.5rem; text-align: center; margin-bottom: 1.5rem;">
        <label for="image" class="form-label" style="font-weight: 700; margin-bottom: 0.35rem; display: block; font-size: 1rem;">
          Project Cover Image
        </label>
        <p style="color: var(--admin-muted); font-size: 0.85rem; margin-bottom: 1rem;">
          Upload a new image to replace the current project cover. Recommended ratio: 16:10.
        </p>

        <div id="image-preview-container" style="margin-bottom: 1rem;">
          <img id="image-preview" src="{{ $project->image_url }}" alt="{{ $project->title }}" style="max-height: 220px; border-radius: 8px; border: 1px solid var(--admin-border); object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>

        <input 
          type="file" 
          id="image" 
          name="image" 
          class="form-control @error('image') is-invalid @enderror" 
          accept="image/*" 
          onchange="previewProjectImage(this)"
          style="max-width: 440px; margin: 0 auto; display: block;"
        >
        @error('image')
          <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="tags" class="form-label">Tech Tags (Comma-separated)</label>
        <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', $project->tags) }}" placeholder="e.g. Laravel, React, Tailwind, PostgreSQL">
        <span class="form-help">Appears as badges on the project card.</span>
      </div>

      <div class="form-group">
        <label for="badge_text" class="form-label">Badge Label (Subtitle)</label>
        <input type="text" id="badge_text" name="badge_text" class="form-control" value="{{ old('badge_text', $project->badge_text) }}" placeholder="e.g. SaaS / Web App, Fintech">
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Summary / Description *</label>
        <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $project->description) }}</textarea>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="live_url" class="form-label">Live Demo URL</label>
          <input type="url" id="live_url" name="live_url" class="form-control" value="{{ old('live_url', $project->live_url) }}">
        </div>

        <div class="form-group">
          <label for="github_url" class="form-label">GitHub Repository URL</label>
          <input type="url" id="github_url" name="github_url" class="form-control" value="{{ old('github_url', $project->github_url) }}">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-top: 1rem;">
        <div class="form-group">
          <label for="sort_order" class="form-label">Display Order (Sort Index)</label>
          <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $project->sort_order) }}">
        </div>

        <div class="form-group" style="display: flex; align-items: center; margin-top: 1.75rem;">
          <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
            <strong>Feature on Homepage</strong>
          </label>
        </div>
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>

  <script>
    function previewProjectImage(input) {
      const preview = document.getElementById('image-preview');
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection
