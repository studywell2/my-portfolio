<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::allSettings();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:255'],
            'typing_words' => ['required', 'string'],
            'about_bio' => ['required', 'string'],
            'current_role' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
            'hero_avatar' => ['nullable', 'image', 'max:2048'],
            'cv_path' => ['nullable', 'file', 'max:5120', 'mimes:pdf,doc,docx'],
            'stat_projects' => ['nullable', 'integer'],
            'stat_clients' => ['nullable', 'integer'],
            'stat_experience' => ['nullable', 'integer'],
            'stat_technologies' => ['nullable', 'integer'],
        ]);

        // Process typing words into JSON
        $words = array_filter(array_map('trim', explode(',', $validated['typing_words'])));
        Setting::set('typing_words', json_encode($words));

        // Save text settings
        $textKeys = [
            'site_name', 'hero_title', 'hero_subtitle', 'about_bio',
            'current_role', 'location', 'email', 'phone', 'whatsapp',
            'github_url', 'linkedin_url',
            'stat_projects', 'stat_clients', 'stat_experience', 'stat_technologies',
        ];

        foreach ($textKeys as $key) {
            Setting::set($key, $validated[$key] ?? null);
        }

        // Handle avatar upload
        if ($request->hasFile('hero_avatar')) {
            Setting::set('hero_avatar', $request->file('hero_avatar')->store('avatars', 'public'));
        }

        // Handle CV upload
        if ($request->hasFile('cv_path')) {
            Setting::set('cv_path', $request->file('cv_path')->store('cv', 'public'));
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
