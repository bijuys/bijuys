<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the blog posts listing.
     */
    public function index(Request $request)
    {
        $query = Post::published()->orderBy('published_at', 'desc');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = Post::published()->distinct()->pluck('category')->filter();

        return view('pages.blog.index', compact('posts', 'categories'));
    }

    /**
     * Display a single blog post.
     */
    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                $query->where('category', $post->category)
                      ->orWhere('id', '>', 0);
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
