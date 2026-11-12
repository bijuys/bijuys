@extends('admin.layout')

@section('title', 'Edit Service: ' . $service->title)
@section('page_title', 'Edit Service')

@section('content')
  <div class="admin-card" style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Edit Service: {{ $service->title }}</h2>
      <a href="{{ route('admin.services.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="title" class="form-label">Service Title *</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $service->title) }}" required autofocus>
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Description *</label>
        <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $service->description) }}</textarea>
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order) }}">
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
@endsection
