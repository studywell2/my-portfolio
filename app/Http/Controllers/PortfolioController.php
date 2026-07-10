<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\Category;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings = Setting::allSettings();

        $projects = Project::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');
        $testimonials = Testimonial::active()->get();

        $typingWords = json_decode($settings['typing_words'] ?? '["Full-Stack Developer"]', true);

        return view('portfolio.index', compact(
            'settings',
            'projects',
            'categories',
            'skills',
            'testimonials',
            'typingWords'
        ));
    }

    public function downloadCV()
    {
        $cvPath = Setting::get('cv_path');

        if ($cvPath && file_exists(storage_path('app/public/' . $cvPath))) {
            return response()->download(storage_path('app/public/' . $cvPath));
        }

        return back()->with('error', 'CV not available. Please upload it from the admin dashboard.');
    }
}
