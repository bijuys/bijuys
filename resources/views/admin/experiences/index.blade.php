@extends('admin.layout')

@section('title', 'Career Timeline')
@section('page_title', 'Career Timeline & Experience')

@section('topbar_actions')
  <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">
    + Add Milestone
  </a>
@endsection

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">Career Milestones ({{ $experiences->count() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Manage the career history timeline on the About page.</p>
      </div>
      <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">+ Add Milestone</a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Order</th>
            <th>Period</th>
            <th>Role & Company</th>
            <th>Description</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($experiences as $exp)
            <tr>
              <td><code>#{{ $exp->sort_order }}</code></td>
              <td><strong>{{ $exp->period }}</strong></td>
              <td>
                <strong>{{ $exp->role }}</strong>
                <div style="font-size: 0.825rem; color: var(--admin-muted);">
                  {{ $exp->company }} @if($exp->location) &bull; {{ $exp->location }} @endif
                </div>
              </td>
              <td>
                <span style="font-size: 0.875rem; color: var(--admin-muted);">{{ Str::limit($exp->description, 80) }}</span>
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn btn-secondary btn-sm">Edit</a>
                  <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Delete this timeline item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; color: var(--admin-muted); padding: 3rem;">
                No career milestones added yet. Click "+ Add Milestone" to add one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
