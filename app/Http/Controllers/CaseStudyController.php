<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('category')->firstOrFail();
        $settings = Setting::allSettings();

        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('category_id', $project->category_id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('portfolio.case-study', compact('project', 'settings', 'relatedProjects'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $projects = Project::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->orderBy('sort_order')
            ->get();

        return response()->json($projects);
    }
}
