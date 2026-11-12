@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
  <!-- Metric Widgets -->
  <div class="stats-grid">
    <div class="stat-widget">
      <div class="stat-widget-info">
        <span>Total Projects</span>
        <h3>{{ $stats['projects_count'] }}</h3>
      </div>
      <div class="stat-widget-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>
      </div>
    </div>

    <div class="stat-widget">
      <div class="stat-widget-info">
        <span>Blog Articles</span>
        <h3>{{ $stats['posts_count'] }}</h3>
      </div>
      <div class="stat-widget-icon" style="background-color: rgba(168, 85, 247, 0.15); color: #a855f7;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
      </div>
    </div>

    <div class="stat-widget">
      <div class="stat-widget-info">
        <span>Toolkit Skills</span>
        <h3>{{ $stats['skills_count'] }}</h3>
      </div>
      <div class="stat-widget-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
      </div>
    </div>

    <div class="stat-widget">
      <div class="stat-widget-info">
        <span>Timeline Milestones</span>
        <h3>{{ $stats['experiences_count'] }}</h3>
      </div>
      <div class="stat-widget-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
      </div>
    </div>

    <div class="stat-widget">
      <div class="stat-widget-info">
        <span>Total Inquiries</span>
        <h3>{{ $stats['messages_count'] }}</h3>
      </div>
      <div class="stat-widget-icon" style="background-color: var(--admin-danger-light); color: var(--admin-danger);">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
      </div>
    </div>
  </div>

  <!-- Quick Action Banner -->
  <div class="admin-card" style="background: linear-gradient(135deg, var(--admin-primary-light) 0%, transparent 100%); border-color: var(--admin-border);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
      <div>
        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.25rem;">Welcome to Bijuys CMS</h3>
        <p style="color: var(--admin-muted); font-size: 0.925rem;">
          Update your portfolio copy, add new case studies, modify skills, and manage contact inquiries in real-time.
        </p>
      </div>
      <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <a href="{{ route('admin.settings.edit') }}" class="btn btn-primary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
          Edit Content & Bio
        </a>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-secondary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
          Add Project
        </a>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-secondary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
          Write Article
        </a>
      </div>
    </div>
  </div>

  <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 1.75rem; margin-top: 1.5rem;">
    <!-- Recent Inquiries -->
    <div class="admin-card" style="margin-bottom: 0;">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Recent Inquiries</h2>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">View All ({{ $stats['messages_count'] }})</a>
      </div>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Sender</th>
              <th>Subject</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentMessages as $msg)
              <tr>
                <td>
                  <strong>{{ $msg->name }}</strong>
                  <div style="font-size: 0.8rem; color: var(--admin-muted);">{{ $msg->email }}</div>
                </td>
                <td>{{ Str::limit($msg->subject, 28) }}</td>
                <td>
                  @if($msg->is_read)
                    <span class="badge-pill" style="background-color: rgba(148, 163, 184, 0.15); color: var(--admin-muted);">Read</span>
                  @else
                    <span class="badge-pill badge-primary">New</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm">View</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" style="text-align: center; color: var(--admin-muted); padding: 2rem;">
                  No messages received yet.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recent Projects -->
    <div class="admin-card" style="margin-bottom: 0;">
      <div class="admin-card-header">
        <h2 class="admin-card-title">Recent Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">+ Add Project</a>
      </div>

      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Featured</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentProjects as $proj)
              <tr>
                <td>
                  <strong>{{ $proj->title }}</strong>
                  <div style="font-size: 0.8rem; color: var(--admin-muted);">{{ Str::limit($proj->tags, 22) }}</div>
                </td>
                <td><span class="badge-pill badge-primary">{{ ucfirst($proj->category) }}</span></td>
                <td>
                  @if($proj->is_featured)
                    <span class="badge-pill badge-success">Featured</span>
                  @else
                    <span style="color: var(--admin-muted); font-size: 0.85rem;">Standard</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.projects.edit', $proj) }}" class="btn btn-secondary btn-sm">Edit</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" style="text-align: center; color: var(--admin-muted); padding: 2rem;">
                  No projects added yet.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
