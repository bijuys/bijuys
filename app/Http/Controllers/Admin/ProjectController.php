<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order', 'asc')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'],
            'tags' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'badge_text' => ['nullable', 'string', 'max:100'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ], [
            'image.required' => 'Every project must have an uploaded image.',
            'image.image' => 'The uploaded file must be an image (JPEG, PNG, WebP, GIF, or SVG).',
            'image.max' => 'The project image size cannot exceed 5MB.',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully with uploaded image!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'],
            'tags' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'badge_text' => ['nullable', 'string', 'max:100'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ];

        if (empty($project->image)) {
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'];
        }

        $validated = $request->validate($rules, [
            'image.required' => 'Every project must have an uploaded image.',
            'image.image' => 'The uploaded file must be an image (JPEG, PNG, WebP, GIF, or SVG).',
            'image.max' => 'The project image size cannot exceed 5MB.',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
