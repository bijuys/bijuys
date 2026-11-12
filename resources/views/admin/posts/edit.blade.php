@extends('admin.layout')

@section('title', 'Edit Article: ' . $post->title)
@section('page_title', 'Edit Article')

@section('content')
  <div class="admin-card" style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Edit Article: {{ $post->title }}</h2>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="title" class="form-label">Article Title *</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required autofocus>
      </div>

      <!-- Featured Image Card -->
      <div class="form-group" style="background: var(--admin-bg); border: 2px dashed var(--admin-border); border-radius: 12px; padding: 1.5rem; text-align: center; margin-bottom: 1.5rem;">
        <label for="image" class="form-label" style="font-weight: 700; margin-bottom: 0.35rem; display: block; font-size: 1rem;">
          Featured Article Picture
        </label>
        <p style="color: var(--admin-muted); font-size: 0.85rem; margin-bottom: 1rem;">
          Every blog post must have a picture. Upload a new image to replace the current picture.
        </p>

        <div id="image-preview-container" style="margin-bottom: 1rem;">
          <img id="image-preview" src="{{ $post->image_url }}" alt="{{ $post->title }}" style="max-height: 240px; border-radius: 8px; border: 1px solid var(--admin-border); object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>

        <input 
          type="file" 
          id="image" 
          name="image" 
          class="form-control @error('image') is-invalid @enderror" 
          accept="image/*" 
          onchange="previewImage(this)"
          style="max-width: 440px; margin: 0 auto; display: block;"
        >
        @error('image')
          <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</div>
        @enderror
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="category" class="form-label">Category *</label>
          <select id="category" name="category" class="form-control" required>
            <option value="Architecture" {{ old('category', $post->category) == 'Architecture' ? 'selected' : '' }}>Architecture</option>
            <option value="Laravel & PHP" {{ old('category', $post->category) == 'Laravel & PHP' ? 'selected' : '' }}>Laravel & PHP</option>
            <option value="Frontend & CSS" {{ old('category', $post->category) == 'Frontend & CSS' ? 'selected' : '' }}>Frontend & CSS</option>
            <option value="Performance" {{ old('category', $post->category) == 'Performance' ? 'selected' : '' }}>Performance</option>
            <option value="DevOps & Cloud" {{ old('category', $post->category) == 'DevOps & Cloud' ? 'selected' : '' }}>DevOps & Cloud</option>
            <option value="Design Systems" {{ old('category', $post->category) == 'Design Systems' ? 'selected' : '' }}>Design Systems</option>
          </select>
        </div>

        <div class="form-group">
          <label for="read_time" class="form-label">Estimated Read Time</label>
          <input type="text" id="read_time" name="read_time" class="form-control" value="{{ old('read_time', $post->read_time) }}">
        </div>

        <div class="form-group">
          <label for="published_at" class="form-label">Publish Date</label>
          <input type="date" id="published_at" name="published_at" class="form-control" value="{{ old('published_at', $post->published_at?->format('Y-m-d')) }}">
        </div>
      </div>

      <div class="form-group">
        <label for="tags" class="form-label">Tags (Comma-separated)</label>
        <input type="text" id="tags" name="tags" class="form-control" value="{{ old('tags', $post->tags) }}">
      </div>

      <div class="form-group">
        <label for="excerpt" class="form-label">Short Summary / Excerpt *</label>
        <textarea id="excerpt" name="excerpt" class="form-control" rows="2" required>{{ old('excerpt', $post->excerpt) }}</textarea>
      </div>

      <div class="form-group">
        <label for="content" class="form-label">Article Full Body Content *</label>
        <textarea id="content" name="content" class="form-control" rows="14" required>{{ old('content', $post->content) }}</textarea>
      </div>

      <div class="form-group" style="display: flex; align-items: center; margin-top: 1.5rem;">
        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
          <strong>Published to live blog</strong>
        </label>
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>

  <script>
    function previewImage(input) {
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
