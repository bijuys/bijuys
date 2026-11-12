<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display the Home page.
     */
    public function index()
    {
        $services = Service::orderBy('sort_order', 'asc')->get();
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        // Fallback if no projects are marked featured
        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::orderBy('sort_order', 'asc')->take(3)->get();
        }

        $latestPosts = Post::published()->orderBy('published_at', 'desc')->take(3)->get();

        return view('pages.home', compact('services', 'featuredProjects', 'latestPosts'));
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        $skills = Skill::orderBy('sort_order', 'asc')->get()->groupBy('category');
        $experiences = Experience::orderBy('sort_order', 'asc')->get();

        return view('pages.about', compact('skills', 'experiences'));
    }

    /**
     * Display the Work/Projects page.
     */
    public function work(Request $request)
    {
        $query = Project::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $projects = $query->orderBy('sort_order', 'asc')->get();

        return view('pages.work', compact('projects'));
    }

    /**
     * Display the Contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        ContactMessage::create($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been received. I will get back to you shortly.',
            ]);
        }

        return back()->with('success', 'Thank you! Your message has been received. I will get back to you shortly.');
    }
}
