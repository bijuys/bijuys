<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'projects_count' => Project::count(),
            'posts_count' => Post::count(),
            'skills_count' => Skill::count(),
            'experiences_count' => Experience::count(),
            'services_count' => Service::count(),
            'messages_count' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
        $recentProjects = Project::orderBy('updated_at', 'desc')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
