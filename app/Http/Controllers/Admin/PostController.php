<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:255'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ], [
            'image.required' => 'Every blog post must have an uploaded picture.',
            'image.image' => 'The uploaded file must be an image (JPEG, PNG, WebP, GIF, or SVG).',
            'image.max' => 'The image size cannot exceed 5MB.',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug
        $baseSlug = $validated['slug'];
        $count = 1;
        while (Post::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$baseSlug}-{$count}";
            $count++;
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['read_time'] = $validated['read_time'] ?: '5 min read';
        $validated['published_at'] = $validated['published_at'] ?: ($validated['is_published'] ? now() : null);

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog article created successfully with featured picture!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'tags' => ['nullable', 'string', 'max:255'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ];

        // If post does not yet have an image, require one
        if (empty($post->image)) {
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif,svg', 'max:5120'];
        }

        $validated = $request->validate($rules, [
            'image.required' => 'Every blog post must have an uploaded picture.',
            'image.image' => 'The uploaded file must be an image (JPEG, PNG, WebP, GIF, or SVG).',
            'image.max' => 'The image size cannot exceed 5MB.',
        ]);

        if ($request->hasFile('image')) {
            // Delete old file if present in public storage
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['read_time'] = $validated['read_time'] ?: '5 min read';

        if ($validated['is_published'] && empty($post->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog article updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Blog article deleted successfully.');
    }
}
