<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->orderBy('sort_order')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->input('project_url') === '#') {
            $request->merge(['project_url' => null]);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'overview' => ['nullable', 'string'],
            'problem_statement' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'key_features' => ['nullable', 'string'],
            'technologies_used' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'challenges_solved' => ['nullable', 'string'],
            'results_impact' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:2048'],
            'hero_image_path' => ['nullable', 'image', 'max:4096'],
            'project_url' => ['nullable', 'url'],
            'github_url' => ['nullable', 'url'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('projects', 'public');
        }

        if ($request->hasFile('hero_image_path')) {
            $validated['hero_image_path'] = $request->file('hero_image_path')->store('projects', 'public');
        }

        // Convert comma-separated strings to arrays
        if (!empty($validated['key_features'])) {
            $validated['key_features'] = array_map('trim', explode(',', $validated['key_features']));
        }
        if (!empty($validated['technologies_used'])) {
            $validated['technologies_used'] = array_map('trim', explode(',', $validated['technologies_used']));
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        if ($request->input('project_url') === '#') {
            $request->merge(['project_url' => null]);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'overview' => ['nullable', 'string'],
            'problem_statement' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'key_features' => ['nullable', 'string'],
            'technologies_used' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'challenges_solved' => ['nullable', 'string'],
            'results_impact' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:2048'],
            'hero_image_path' => ['nullable', 'image', 'max:4096'],
            'project_url' => ['nullable', 'url'],
            'github_url' => ['nullable', 'url'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('projects', 'public');
        }

        if ($request->hasFile('hero_image_path')) {
            $validated['hero_image_path'] = $request->file('hero_image_path')->store('projects', 'public');
        }

        // Convert comma-separated strings to arrays
        if (!empty($validated['key_features'])) {
            $validated['key_features'] = array_map('trim', explode(',', $validated['key_features']));
        }
        if (!empty($validated['technologies_used'])) {
            $validated['technologies_used'] = array_map('trim', explode(',', $validated['technologies_used']));
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
