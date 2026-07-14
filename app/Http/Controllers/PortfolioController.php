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

        $projects = Project::with('category')->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');
        $testimonials = Testimonial::active()->get();

        $typingWords = json_decode($settings['typing_words'] ?? '["Full-Stack Developer"]', true);

        $calcSettings = [
            'base_landing' => $settings['calc_base_landing'] ?? 50000,
            'base_business' => $settings['calc_base_business'] ?? 80000,
            'base_school' => $settings['calc_base_school'] ?? 150000,
            'base_ecommerce' => $settings['calc_base_ecommerce'] ?? 200000,
            'base_webapp' => $settings['calc_base_webapp'] ?? 300000,
            'per_page' => $settings['calc_per_page'] ?? 10000,
            'included_pages' => $settings['calc_included_pages'] ?? 5,
            'feat_seo' => $settings['calc_feat_seo'] ?? 20000,
            'feat_payment' => $settings['calc_feat_payment'] ?? 30000,
            'feat_auth' => $settings['calc_feat_auth'] ?? 25000,
            'feat_dashboard' => $settings['calc_feat_dashboard'] ?? 40000,
            'feat_api' => $settings['calc_feat_api'] ?? 35000,
            'feat_chat' => $settings['calc_feat_chat'] ?? 15000,
            'feat_cms' => $settings['calc_feat_cms'] ?? 35000,
            'feat_email' => $settings['calc_feat_email'] ?? 15000,
        ];

        return view('portfolio.index', compact(
            'settings',
            'projects',
            'categories',
            'skills',
            'testimonials',
            'typingWords',
            'calcSettings'
        ));
    }

    public function playground()

    {

        $settings = Setting::allSettings();

        return view('portfolio.playground', compact('settings'));

    }


    public function downloadCV()

    {

        $settings = Setting::allSettings();

        $cvPath = $settings['cv_path'] ?? null;

        if ($cvPath && file_exists(storage_path('app/public/' . $cvPath))) {

            return response()->download(storage_path('app/public/' . $cvPath));

        }

        abort(404, 'The CV file is not available.');

    }
}
