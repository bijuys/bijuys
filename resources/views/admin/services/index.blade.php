@extends('admin.layout')

@section('title', 'Services & Capabilities')
@section('page_title', 'Services / Capabilities')

@section('topbar_actions')
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
    + Add Service
  </a>
@endsection

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">Services & Capabilities ({{ $services->count() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Manage the capability cards shown on the homepage.</p>
      </div>
      <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">+ Add Service</a>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Order</th>
            <th>Title</th>
            <th>Description</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($services as $service)
            <tr>
              <td><code>#{{ $service->sort_order }}</code></td>
              <td><strong>{{ $service->title }}</strong></td>
              <td><span style="font-size: 0.875rem; color: var(--admin-muted);">{{ Str::limit($service->description, 90) }}</span></td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-secondary btn-sm">Edit</a>
                  <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" style="text-align: center; color: var(--admin-muted); padding: 3rem;">
                No services added yet. Click "+ Add Service" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
