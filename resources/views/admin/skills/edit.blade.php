@extends('admin.layout')

@section('title', 'Edit Skill: ' . $skill->name)
@section('page_title', 'Edit Skill')

@section('content')
  <div class="admin-card" style="max-width: 650px; margin: 0 auto;">
    <div class="admin-card-header">
      <h2 class="admin-card-title">Edit Skill: {{ $skill->name }}</h2>
      <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="name" class="form-label">Skill Name *</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $skill->name) }}" required autofocus>
      </div>

      <div class="form-group">
        <label for="category" class="form-label">Category Group *</label>
        <select id="category" name="category" class="form-control" required>
          <option value="Frontend" {{ old('category', $skill->category) == 'Frontend' ? 'selected' : '' }}>Frontend</option>
          <option value="Backend & Data" {{ old('category', $skill->category) == 'Backend & Data' ? 'selected' : '' }}>Backend & Data</option>
          <option value="DevOps & Cloud" {{ old('category', $skill->category) == 'DevOps & Cloud' ? 'selected' : '' }}>DevOps & Cloud</option>
          <option value="Design & Workflow" {{ old('category', $skill->category) == 'Design & Workflow' ? 'selected' : '' }}>Design & Workflow</option>
        </select>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
        <div class="form-group">
          <label for="proficiency" class="form-label">Proficiency % (Optional)</label>
          <input type="number" id="proficiency" name="proficiency" class="form-control" min="1" max="100" value="{{ old('proficiency', $skill->proficiency) }}">
        </div>

        <div class="form-group">
          <label for="sort_order" class="form-label">Display Order</label>
          <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $skill->sort_order) }}">
        </div>
      </div>

      <div style="border-top: 1px solid var(--admin-border); padding-top: 1.5rem; margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
@endsection
