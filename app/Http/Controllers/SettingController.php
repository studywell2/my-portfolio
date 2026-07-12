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
            'calc_base_landing' => ['required', 'integer', 'min:0'],
            'calc_base_business' => ['required', 'integer', 'min:0'],
            'calc_base_school' => ['required', 'integer', 'min:0'],
            'calc_base_ecommerce' => ['required', 'integer', 'min:0'],
            'calc_base_webapp' => ['required', 'integer', 'min:0'],
            'calc_per_page' => ['required', 'integer', 'min:0'],
            'calc_included_pages' => ['required', 'integer', 'min:0'],
            'calc_feat_seo' => ['required', 'integer', 'min:0'],
            'calc_feat_payment' => ['required', 'integer', 'min:0'],
            'calc_feat_auth' => ['required', 'integer', 'min:0'],
            'calc_feat_dashboard' => ['required', 'integer', 'min:0'],
            'calc_feat_api' => ['required', 'integer', 'min:0'],
            'calc_feat_chat' => ['required', 'integer', 'min:0'],
            'calc_feat_cms' => ['required', 'integer', 'min:0'],
            'calc_feat_email' => ['required', 'integer', 'min:0'],
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
            'calc_base_landing', 'calc_base_business', 'calc_base_school',
            'calc_base_ecommerce', 'calc_base_webapp',
            'calc_per_page', 'calc_included_pages',
            'calc_feat_seo', 'calc_feat_payment', 'calc_feat_auth',
            'calc_feat_dashboard', 'calc_feat_api', 'calc_feat_chat',
            'calc_feat_cms', 'calc_feat_email',
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
