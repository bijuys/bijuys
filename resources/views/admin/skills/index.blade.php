@extends('admin.layout')

@section('title', 'Toolkit Skills')
@section('page_title', 'Skills & Technologies')

@section('topbar_actions')
  <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">
    + Add New Skill
  </a>
@endsection

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">All Skills ({{ $skills->total() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Manage the technical skills displayed on the About page.</p>
      </div>
      <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">+ Add Skill</a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Order</th>
            <th>Skill Name</th>
            <th>Category</th>
            <th>Proficiency</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($skills as $skill)
            <tr>
              <td><code>#{{ $skill->sort_order }}</code></td>
              <td><strong>{{ $skill->name }}</strong></td>
              <td>
                <span class="badge-pill badge-primary">{{ $skill->category }}</span>
              </td>
              <td>
                @if($skill->proficiency)
                  <span>{{ $skill->proficiency }}%</span>
                @else
                  <span style="color: var(--admin-muted);">-</span>
                @endif
              </td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-secondary btn-sm">Edit</a>
                  <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Remove this skill?');">
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
                No skills added yet. Click "+ Add New Skill" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($skills->hasPages())
      <div style="margin-top: 1.5rem;">
        {{ $skills->links() }}
      </div>
    @endif
  </div>
@endsection
