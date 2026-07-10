<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'testimonials' => Testimonial::where('is_active', true)->count(),
            'skills' => Skill::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
