@extends('admin.layout')

@section('title', 'Manage Projects')
@section('page_title', 'Portfolio Projects')

@section('topbar_actions')
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
    + Add New Project
  </a>
@endsection

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">All Published Projects ({{ $projects->total() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Manage the showcase cards appearing on the Work page and homepage.</p>
      </div>
      <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">+ Add Project</a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Sort</th>
            <th>Image</th>
            <th>Title & Tags</th>
            <th>Category</th>
            <th>Featured</th>
            <th>Live & Code URLs</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($projects as $project)
            <tr>
              <td><code>#{{ $project->sort_order }}</code></td>
              <td>
                <img 
                  src="{{ $project->image_url }}" 
                  alt="{{ $project->title }}" 
                  style="width: 60px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid var(--admin-border); display: block;"
                >
              </td>
              <td>
                <strong>{{ $project->title }}</strong>
                <div style="font-size: 0.8rem; color: var(--admin-muted);">{{ $project->tags }}</div>
              </td>
              <td>
                <span class="badge-pill badge-primary">{{ ucfirst($project->category) }}</span>
              </td>
              <td>
                @if($project->is_featured)
                  <span class="badge-pill badge-success">Featured (Home)</span>
                @else
                  <span style="color: var(--admin-muted); font-size: 0.85rem;">Standard</span>
                @endif
              </td>
              <td>
                <div style="font-size: 0.825rem; display: flex; flex-direction: column; gap: 0.2rem;">
                  @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" style="color: var(--admin-primary); text-decoration: none;">Demo Link &nearr;</a>
                  @endif
                  @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" style="color: var(--admin-muted); text-decoration: none;">Code Repo &nearr;</a>
                  @endif
                </div>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm">Edit</a>
                  <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                No projects found. Click "+ Add New Project" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($projects->hasPages())
      <div style="margin-top: 1.5rem;">
        {{ $projects->links() }}
      </div>
    @endif
  </div>
@endsection
