@extends('admin.layout')

@section('title', 'Manage Blog Articles')
@section('page_title', 'Blog Articles')

@section('topbar_actions')
  <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
    + Write New Article
  </a>
@endsection

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">All Blog Articles ({{ $posts->total() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Manage publications, draft articles, and insights appearing on Bijuys.</p>
      </div>
      <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">+ Write Article</a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Status</th>
            <th>Picture</th>
            <th>Title & Tags</th>
            <th>Category</th>
            <th>Read Time</th>
            <th>Published Date</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $post)
            <tr>
              <td>
                @if($post->is_published)
                  <span class="badge-pill badge-success">Published</span>
                @else
                  <span class="badge-pill" style="background-color: rgba(148, 163, 184, 0.15); color: var(--admin-muted);">Draft</span>
                @endif
              </td>
              <td>
                <img 
                  src="{{ $post->image_url }}" 
                  alt="{{ $post->title }}" 
                  style="width: 56px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid var(--admin-border); display: block;"
                >
              </td>
              <td>
                <strong>{{ $post->title }}</strong>
                <div style="font-size: 0.8rem; color: var(--admin-muted);">{{ Str::limit($post->excerpt, 60) }}</div>
              </td>
              <td>
                <span class="badge-pill badge-primary">{{ $post->category }}</span>
              </td>
              <td><span style="font-size: 0.85rem; color: var(--admin-muted);">{{ $post->read_time }}</span></td>
              <td>
                <span style="font-size: 0.85rem; color: var(--admin-muted);">
                  {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not set' }}
                </span>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  @if($post->is_published)
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-secondary btn-sm" title="View live article">
                      View
                    </a>
                  @endif
                  <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-secondary btn-sm">Edit</a>
                  <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; color: var(--admin-muted); padding: 3rem;">
                No blog articles published yet. Click "+ Write New Article" to write your first post.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($posts->hasPages())
      <div style="margin-top: 1.5rem;">
        {{ $posts->links() }}
      </div>
    @endif
  </div>
@endsection
