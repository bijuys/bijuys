@extends('admin.layout')

@section('title', 'Add Career Milestone')
@section('page_title', 'Add Milestone')

@section('content')
  <div class="admin-card" style="max-width: 700px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Add Timeline Milestone</h2>
      <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.experiences.store') }}" method="POST">
      @csrf

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="role" class="form-label">Job Title / Role *</label>
          <input type="text" id="role" name="role" class="form-control" value="{{ old('role') }}" placeholder="e.g. Lead Full-Stack Engineer" required autofocus>
        </div>

        <div class="form-group">
          <label for="company" class="form-label">Company / Organization *</label>
          <input type="text" id="company" name="company" class="form-control" value="{{ old('company') }}" placeholder="e.g. Acme Tech" required>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="period" class="form-label">Time Period *</label>
          <input type="text" id="period" name="period" class="form-control" value="{{ old('period') }}" placeholder="e.g. 2023 – Present" required>
        </div>

        <div class="form-group">
          <label for="location" class="form-label">Location (Optional)</label>
          <input type="text" id="location" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. San Francisco, CA or Remote">
        </div>
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Summary of Responsibilities & Achievements *</label>
        <textarea id="description" name="description" class="form-control" rows="4" required placeholder="What did you build or lead in this role?">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="sort_order" class="form-label">Display Order (Sort Index)</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Add Milestone</button>
      </div>
    </form>
  </div>
@endsection
