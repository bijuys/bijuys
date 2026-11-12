@extends('admin.layout')

@section('title', 'Add Service')
@section('page_title', 'Add Service')

@section('content')
  <div class="admin-card" style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Add Service / Capability</h2>
      <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="title" class="form-label">Service Title *</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Frontend Engineering, Cloud Architecture" required autofocus>
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Description *</label>
        <textarea id="description" name="description" class="form-control" rows="3" required placeholder="Describe what you deliver to clients or engineering teams...">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Add Service</button>
      </div>
    </form>
  </div>
@endsection
