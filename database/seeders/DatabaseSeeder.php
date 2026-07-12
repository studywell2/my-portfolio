<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Akingbehin Abideen',
            'email' => 'admin@abideen.dev',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        $this->seedSettings();
        $this->seedCategories();
        $this->seedProjects();
        $this->seedSkills();
        $this->seedTestimonials();
    }

    private function seedSettings(): void
    {
        $settings = [
            'site_name' => 'Abideen.dev',
            'hero_title' => 'Akingbehin Abideen',
            'hero_subtitle' => 'Full-Stack Developer & Project Manager',
            'hero_avatar' => 'Media (14).jpg',
            'typing_words' => json_encode([
                'Full-Stack Developer',
                'Laravel Expert',
                'Project Manager',
                'Problem Solver',
            ]),
            'about_title' => 'About Me',
            'about_bio' => "I am a passionate Full-Stack Web Developer specializing in Laravel, PHP, MySQL, JavaScript, Bootstrap, HTML, and CSS. I enjoy building secure, scalable, and user-friendly web applications that solve real business problems.\n\nAlongside software development, I serve as an Operations Manager at Ozitech, where I coordinate projects, improve operational processes, and help deliver quality technology solutions.\n\nMy goal is to build modern software that makes businesses, schools, and organizations more efficient while continuously improving my skills and delivering exceptional results for clients.",
            'current_role' => 'Operations Manager at Ozitech & Full-Stack Web Developer',
            'location' => 'Nigeria',
            'email' => 'studywellmail1@gmail.com',
            'phone' => '09130710906',
            'whatsapp' => '2348073866899',
            'github_url' => 'https://github.com/studywell2',
            'linkedin_url' => 'https://linkedin.com/in/studywell',
            'cv_path' => null,
            'stat_projects' => '50',
            'stat_clients' => '30',
            'stat_experience' => '5',
            'stat_technologies' => '15',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }
    }

    private function seedCategories(): void
    {
        $categories = [
            ['name' => 'School Systems', 'icon' => 'bi-mortarboard', 'sort_order' => 1],
            ['name' => 'Business Apps', 'icon' => 'bi-briefcase', 'sort_order' => 2],
            ['name' => 'Web Portals', 'icon' => 'bi-globe', 'sort_order' => 3],
            ['name' => 'Company Sites', 'icon' => 'bi-building', 'sort_order' => 4],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
                'sort_order' => $cat['sort_order'],
            ]);
        }
    }

    private function seedProjects(): void
    {
        $schoolCat = Category::where('slug', 'school-systems')->first();
        $businessCat = Category::where('slug', 'business-apps')->first();
        $portalCat = Category::where('slug', 'web-portals')->first();
        $companyCat = Category::where('slug', 'company-sites')->first();

        $projects = [
            [
                'title' => 'SchoolPro',
                'category_id' => $schoolCat->id,
                'description' => 'A complete School Management System built with Laravel featuring student management, teacher management, attendance, results, fee management, parent portal, notifications, and role-based access control.',
                'project_url' => null,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Business Management System',
                'category_id' => $businessCat->id,
                'description' => 'A modern business management solution with dashboards, reporting, and administrative tools designed to streamline operations.',
                'project_url' => null,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Student Result Portal',
                'category_id' => $portalCat->id,
                'description' => 'A secure online platform where students can check their academic results. Features include secure authentication, result search, and printable reports.',
                'project_url' => null,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Company Website',
                'category_id' => $companyCat->id,
                'description' => 'A responsive corporate website with an admin panel and content management features. Includes blog, services pages, and contact management.',
                'project_url' => null,
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create(array_merge($project, [
                'slug' => Str::slug($project['title']),
                'image_path' => null,
                'gallery' => null,
            ]));
        }
    }

    private function seedSkills(): void
    {
        $skills = [
            // Backend
            ['name' => 'Laravel', 'category' => 'backend', 'proficiency' => 95, 'icon_class' => 'bi-laravel', 'sort_order' => 1],
            ['name' => 'PHP', 'category' => 'backend', 'proficiency' => 90, 'icon_class' => 'bi-filetype-php', 'sort_order' => 2],
            ['name' => 'MySQL', 'category' => 'backend', 'proficiency' => 88, 'icon_class' => 'bi-database', 'sort_order' => 3],
            ['name' => 'REST APIs', 'category' => 'backend', 'proficiency' => 85, 'icon_class' => 'bi-cloud-arrow-up', 'sort_order' => 4],

            // Frontend
            ['name' => 'HTML5', 'category' => 'frontend', 'proficiency' => 95, 'icon_class' => 'bi-filetype-html', 'sort_order' => 1],
            ['name' => 'CSS3', 'category' => 'frontend', 'proficiency' => 90, 'icon_class' => 'bi-filetype-css', 'sort_order' => 2],
            ['name' => 'Bootstrap 5', 'category' => 'frontend', 'proficiency' => 92, 'icon_class' => 'bi-bootstrap', 'sort_order' => 3],
            ['name' => 'JavaScript', 'category' => 'frontend', 'proficiency' => 82, 'icon_class' => 'bi-filetype-js', 'sort_order' => 4],

            // Tools
            ['name' => 'Git', 'category' => 'tools', 'proficiency' => 88, 'icon_class' => 'bi-git', 'sort_order' => 1],
            ['name' => 'GitHub', 'category' => 'tools', 'proficiency' => 90, 'icon_class' => 'bi-github', 'sort_order' => 2],
            ['name' => 'Composer', 'category' => 'tools', 'proficiency' => 85, 'icon_class' => 'bi-box-seam', 'sort_order' => 3],
            ['name' => 'VS Code', 'category' => 'tools', 'proficiency' => 95, 'icon_class' => 'bi-braces', 'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'author_name' => 'John Doe',
                'author_role' => 'Principal',
                'author_company' => 'Greenfield Academy',
                'content' => 'Abideen delivered our school management system on time and beyond expectations. The platform is intuitive, secure, and has transformed how we manage student data.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'author_name' => 'Sarah Ahmed',
                'author_role' => 'CEO',
                'author_company' => 'TechFlow Solutions',
                'content' => 'Working with Abideen was a pleasure. He understood our business requirements and delivered a robust web portal that improved our operational efficiency significantly.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'author_name' => 'Michael Chen',
                'author_role' => 'Operations Director',
                'author_company' => 'Global Trade Ltd',
                'content' => 'The inventory management system Abideen built for us has been a game changer. Clean code, great documentation, and excellent ongoing support.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'author_name' => 'Aisha Bello',
                'author_role' => 'Founder',
                'author_company' => 'LearnHub',
                'content' => 'Professional, reliable, and skilled. Abideen took our vision and turned it into a polished, fully-functional web application. Highly recommended.',
                'rating' => 5,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
