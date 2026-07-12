<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['hero_title'] ?? 'Akingbehin Abideen' }} — {{ $settings['hero_subtitle'] ?? 'Full-Stack Developer & Project Manager' }}. {{ $settings['current_role'] ?? '' }}">
    <meta name="keywords" content="Laravel developer Nigeria, full-stack developer, PHP developer, web developer, school management system, Abideen, Akingbehin Abideen">
    <meta name="author" content="{{ $settings['hero_title'] ?? 'Akingbehin Abideen' }}">
    <meta property="og:title" content="{{ $settings['site_name'] ?? 'Abideen.dev' }}">
    <meta property="og:description" content="{{ $settings['hero_subtitle'] ?? 'Full-Stack Developer & Project Manager' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['site_name'] ?? 'Abideen.dev' }}">
    <meta name="twitter:description" content="{{ $settings['hero_subtitle'] ?? 'Full-Stack Developer & Project Manager' }}">
    <title>{{ $settings['site_name'] ?? 'Abideen.dev' }} — {{ $settings['hero_subtitle'] ?? 'Full-Stack Developer' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/portfolio.js'])

    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Person",
        "name": "{{ $settings['hero_title'] ?? 'Akingbehin Abideen' }}",
        "jobTitle": "{{ $settings['hero_subtitle'] ?? 'Full-Stack Developer & Project Manager' }}",
        "address": {
            "@@type": "PostalAddress",
            "addressCountry": "{{ $settings['location'] ?? 'Nigeria' }}"
        },
        "email": "{{ $settings['email'] ?? '' }}",
        "sameAs": [
            "{{ $settings['github_url'] ?? '' }}",
            "{{ $settings['linkedin_url'] ?? '' }}"
        ]
    }
    </script>
</head>
<body style="background: #0a0a0a; color: #e0e0e0;">

    {{-- Loading Screen --}}
    <div class="loading-screen" id="loading-screen">
        <div class="text-center">
            <div class="loader mx-auto"></div>
            <div class="loader-text text-gradient-gold">Abideen.dev</div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="main-navbar">
        <div class="container">
            <a class="navbar-brand text-gradient-gold me-auto" href="#home">Abideen.dev</a>
            <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <i class="bi bi-list text-light" style="font-size:1.4rem"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#calculator">Cost Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item">
                        <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
                            <i id="theme-icon" class="bi bi-sun"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="btn btn-gold btn-sm px-3">Hire Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="home" class="hero-section">
        <div class="hero-bg-gradient"></div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-7 text-center text-lg-start order-2 order-lg-1">
                    <p class="text-gradient-gold fw-600 mb-2 reveal" style="font-family:'JetBrains Mono',monospace;font-size:0.95rem">&lt; Hello, I'm &gt;</p>
                    <h1 class="hero-title mb-3 reveal" style="animation-delay:0.1s">{{ $settings['hero_title'] ?? 'Akingbehin Abideen' }}</h1>
                    <div class="typing-text mb-4 reveal" style="animation-delay:0.2s">
                        <span class="text-gradient">{{ $settings['hero_subtitle'] ?? 'Full-Stack Developer' }}</span>
                        <span id="typing-text" data-words='{{ json_encode($typingWords) }}'></span><span class="cursor"></span>
                    </div>
                    <p class="lead mb-4 reveal" style="animation-delay:0.3s;max-width:560px">
                        {{ $settings['current_role'] ?? 'Operations Manager at Ozitech and Full-Stack Web Developer.' }}
                    </p>
                    <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start reveal" style="animation-delay:0.4s">
                        <a href="#contact" class="btn btn-gold px-4 py-2">
                            <i class="bi bi-envelope me-2"></i>Get in Touch
                        </a>
                        <a href="#projects" class="btn btn-outline-gold px-4 py-2">
                            <i class="bi bi-folder me-2"></i>View Work
                        </a>
                        @if (isset($settings['cv_path']) && $settings['cv_path'])
                            <a href="{{ route('download.cv') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bi bi-download me-2"></i>Download CV
                            </a>
                        @endif
                    </div>
                    <div class="d-flex gap-3 mt-4 justify-content-center justify-content-lg-start reveal" style="animation-delay:0.5s">
                        @if (!empty($settings['github_url']))
                            <a href="{{ $settings['github_url'] }}" target="_blank" class="social-link" style="color:#e0e0e0;background:rgba(255,255,255,0.05)">
                                <i class="bi bi-github"></i>
                            </a>
                        @endif
                        @if (!empty($settings['linkedin_url']))
                            <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="social-link" style="color:#0a66c2;background:rgba(10,102,194,0.1)">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        @endif
                        @if (!empty($settings['email']))
                            <a href="mailto:{{ $settings['email'] }}" class="social-link" style="color:#d4af37;background:rgba(212,175,55,0.1)">
                                <i class="bi bi-envelope-fill"></i>
                            </a>
                        @endif
                        @if (!empty($settings['whatsapp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" class="social-link" style="color:#25d366;background:rgba(37,211,102,0.1)">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 text-center order-1 order-lg-2 mb-4 mb-lg-0">
                    <div class="hero-avatar-wrapper reveal-scale">
                        @if (isset($settings['hero_avatar']) && $settings['hero_avatar'])
                            @php
                                $avatarUrl = str_starts_with($settings['hero_avatar'], 'http') || str_starts_with($settings['hero_avatar'], '/')
                                    ? $settings['hero_avatar']
                                    : (file_exists(public_path('storage/' . $settings['hero_avatar']))
                                        ? asset('storage/' . $settings['hero_avatar'])
                                        : asset($settings['hero_avatar']));
                            @endphp
                            <img src="{{ $avatarUrl }}" alt="{{ $settings['hero_title'] ?? 'Avatar' }}" class="hero-avatar img-fluid">
                        @else
                            <div class="hero-avatar d-flex align-items-center justify-content-center mx-auto" style="background:linear-gradient(135deg,#1a1a1a,#2a2a2a)">
                                <i class="bi bi-person-fill" style="font-size:8rem;color:#d4af37;opacity:0.5"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <a href="#about" class="scroll-down">
            <i class="bi bi-chevron-double-down"></i>
        </a>
    </section>

    {{-- About Section --}}
    <section id="about" class="py-5">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">Get To Know Me</span>
                <h2 class="title">About <span class="text-gradient-gold">Me</span></h2>
                <div class="divider"></div>
            </div>
            <div class="row align-items-center g-5 mt-2">
                <div class="col-lg-5 reveal-left">
                    <div class="about-image p-3" style="background:linear-gradient(135deg,rgba(212,175,55,0.1),rgba(59,130,246,0.1));border-radius:20px">
                        @if (isset($settings['hero_avatar']) && $settings['hero_avatar'])
                            <img src="{{ $avatarUrl }}" alt="About" class="img-fluid rounded-3">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded-3" style="aspect-ratio:1;background:#1a1a1a">
                                <i class="bi bi-person-fill" style="font-size:10rem;color:#d4af37;opacity:0.3"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 reveal-right">
                    <h3 class="fw-bold mb-3">{{ $settings['hero_title'] ?? 'Akingbehin Abideen' }}</h3>
                    <p class="text-muted mb-3" style="font-size:1.05rem;line-height:1.8">
                        {{ $settings['current_role'] ?? '' }}
                    </p>
                    @foreach (explode("\n\n", $settings['about_bio'] ?? '') as $paragraph)
                        <p class="text-muted mb-3" style="line-height:1.8">{{ $paragraph }}</p>
                    @endforeach
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <div class="text-muted small">Location</div>
                                    <div class="fw-600">{{ $settings['location'] ?? 'Agege lagos, Nigeria' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-envelope-fill"></i>
                                <div>
                                    <div class="text-muted small">Email</div>
                                    <div class="fw-600">{{ $settings['email'] ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <div class="text-muted small">Phone</div>
                                    <div class="fw-600">{{ $settings['phone'] ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-briefcase-fill"></i>
                                <div>
                                    <div class="text-muted small">Availability</div>
                                    <div class="fw-600 text-success">Open for Work</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Statistics Section --}}
    <section class="py-5" style="background:linear-gradient(135deg,rgba(212,175,55,0.03),rgba(59,130,246,0.03))">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-6 col-lg-3 reveal">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-folder2-open"></i></div>
                        <div class="stat-number" data-target="{{ $settings['stat_projects'] ?? 50 }}">0</div>
                        <div class="stat-label text-muted">Projects Completed</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal" style="animation-delay:0.1s">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-people"></i></div>
                        <div class="stat-number" data-target="{{ $settings['stat_clients'] ?? 30 }}">0</div>
                        <div class="stat-label text-muted">Happy Clients</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal" style="animation-delay:0.2s">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                        <div class="stat-number" data-target="{{ $settings['stat_experience'] ?? 5 }}">0</div>
                        <div class="stat-label text-muted">Years Experience</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 reveal" style="animation-delay:0.3s">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-cpu"></i></div>
                        <div class="stat-number" data-target="{{ $settings['stat_technologies'] ?? 15 }}">0</div>
                        <div class="stat-label text-muted">Technologies</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section id="services" class="py-5">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">What I Do</span>
                <h2 class="title">My <span class="text-gradient-gold">Services</span></h2>
                <div class="divider"></div>
            </div>
            <div class="row g-4 mt-2">
                @php
                    $services = [
                        ['Custom Web Development', 'bi-code-slash', 'Building secure, scalable, and user-friendly web applications tailored to your business needs.'],
                        ['Laravel Application Development', 'bi-laravel', 'Expert Laravel development with clean architecture, proper validation, and production-ready code.'],
                        ['School Management Systems', 'bi-mortarboard', 'Complete school management solutions with student, teacher, attendance, and results management.'],
                        ['Business Websites', 'bi-briefcase', 'Professional business websites that represent your brand and convert visitors into customers.'],
                        ['Company Portals', 'bi-building', 'Custom company portals with role-based access, dashboards, and administrative tools.'],
                        ['Inventory Management Systems', 'bi-box-seam', 'Comprehensive inventory management with real-time tracking, reporting, and alerts.'],
                        ['Dashboard Development', 'bi-speedometer2', 'Data-driven dashboards with charts, analytics, and real-time reporting capabilities.'],
                        ['API Integration', 'bi-cloud-arrow-up', 'Seamless integration with third-party APIs, payment gateways, and external services.'],
                        ['Website Maintenance', 'bi-tools', 'Ongoing website maintenance, updates, and technical support to keep your site running smoothly.'],
                        ['Database Design', 'bi-database', 'Efficient database design and optimization for performance, scalability, and data integrity.'],
                        ['Website Deployment', 'bi-rocket-takeoff', 'Professional deployment with CI/CD, server configuration, and security best practices.'],
                        ['Technical Support', 'bi-headset', 'Reliable technical support and consultation to help your business grow with technology.'],
                    ];
                @endphp
                @foreach ($services as $index => $service)
                    <div class="col-md-6 col-lg-4 reveal" style="animation-delay:{{ ($index % 3) * 0.1 }}s">
                        <div class="service-card h-100">
                            <div class="service-icon">
                                <i class="bi {{ $service[1] }}"></i>
                            </div>
                            <h5>{{ $service[0] }}</h5>
                            <p class="text-muted">{{ $service[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Skills Section --}}
    <section id="skills" class="py-5" style="background:linear-gradient(135deg,rgba(59,130,246,0.03),rgba(212,175,55,0.03))">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">My Expertise</span>
                <h2 class="title">Technical <span class="text-gradient-gold">Skills</span></h2>
                <div class="divider"></div>
            </div>
            <div class="row g-5 mt-2">
                @php
                    $categoryNames = ['backend' => 'Backend', 'frontend' => 'Frontend', 'tools' => 'Tools'];
                    $categoryIcons = ['backend' => 'bi-server', 'frontend' => 'bi-window-stack', 'tools' => 'bi-tools'];
                @endphp
                @foreach (['backend', 'frontend', 'tools'] as $cat)
                    @if (isset($skills[$cat]) && $skills[$cat]->count() > 0)
                        <div class="col-lg-4 reveal" style="animation-delay:{{ $loop->index * 0.1 }}s">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <i class="bi {{ $categoryIcons[$cat] }} fs-3 text-gradient-gold"></i>
                                <h4 class="fw-bold mb-0">{{ $categoryNames[$cat] }}</h4>
                            </div>
                            @foreach ($skills[$cat] as $skill)
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">
                                            @if ($skill->icon_class)
                                                <i class="bi {{ $skill->icon_class }} me-1" style="color:#d4af37"></i>
                                            @endif
                                            {{ $skill->name }}
                                        </span>
                                        <span class="skill-percent">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="skill-progress">
                                        <div class="skill-progress-bar" data-progress="{{ $skill->proficiency }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Projects Section --}}
    <section id="projects" class="py-5">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">My Work</span>
                <h2 class="title">Featured <span class="text-gradient-gold">Projects</span></h2>
                <div class="divider"></div>
            </div>

            {{-- Project Filters --}}
            <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 project-filter reveal">
                <button class="filter-btn active" data-filter="all">All</button>
                @foreach ($categories as $category)
                    <button class="filter-btn" data-filter="{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            </div>

            {{-- Project Grid --}}
            <div class="row g-4">
                @forelse ($projects as $project)
                    <div class="col-md-6 col-lg-4 project-item reveal-scale" data-category="{{ $project->category_id }}" style="animation-delay:{{ ($loop->index % 3) * 0.1 }}s">
                        <div class="project-card">
                            <div class="project-image">
                                @if ($project->image_path)
                                    <a href="{{ asset('storage/' . $project->image_path) }}" data-lightbox>
                                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}">
                                    </a>
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100" style="background:linear-gradient(135deg,#1a1a1a,#2a2a2a)">
                                        <i class="bi bi-code-slash" style="font-size:4rem;color:#d4af37;opacity:0.3"></i>
                                    </div>
                                @endif
                                <div class="project-overlay">
                                    <h5 class="fw-bold">{{ $project->title }}</h5>
                                    <p class="small mb-3">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
                                    <div class="d-flex gap-2 justify-content-center">
                                        @if ($project->project_url && $project->project_url !== '#')
                                            <a href="{{ $project->project_url }}" target="_blank" class="btn btn-gold btn-sm">
                                                <i class="bi bi-box-arrow-up-right me-1"></i>Visit
                                            </a>
                                        @endif
                                        @if ($project->image_path)
                                            <a href="{{ asset('storage/' . $project->image_path) }}" data-lightbox class="btn btn-outline-gold btn-sm">
                                                <i class="bi bi-zoom-in me-1"></i>View
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="project-info">
                                <span class="project-category">{{ $project->category->name ?? 'Project' }}</span>
                                <h5>{{ $project->title }}</h5>
                                <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="bi bi-folder-x" style="font-size:3rem;opacity:0.3"></i>
                        <p class="mt-3">Projects coming soon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section id="testimonials" class="py-5" style="background:linear-gradient(135deg,rgba(212,175,55,0.03),rgba(59,130,246,0.03))">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">Client Feedback</span>
                <h2 class="title">Testimo<span class="text-gradient-gold">nials</span></h2>
                <div class="divider"></div>
            </div>

            @if ($testimonials->count() > 0)
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($testimonials as $testimonial)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="testimonial-card reveal">
                                            <div class="testimonial-quote">
                                                <i class="bi bi-quote"></i>
                                            </div>
                                            <div class="testimonial-rating">
                                                @for ($i = 0; $i < $testimonial->rating; $i++) <i class="bi bi-star-fill"></i> @endfor
                                            </div>
                                            <p class="testimonial-content">"{{ $testimonial->content }}"</p>
                                            <div class="testimonial-author">
                                                @if ($testimonial->avatar_path)
                                                    <img src="{{ asset('storage/' . $testimonial->avatar_path) }}" alt="{{ $testimonial->author_name }}">
                                                @else
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background:rgba(212,175,55,0.15);color:#d4af37">
                                                        <i class="bi bi-person-fill fs-4"></i>
                                                    </div>
                                                @endif
                                                <div class="author-info">
                                                    <h6>{{ $testimonial->author_name }}</h6>
                                                    <p class="text-muted">{{ $testimonial->author_role }}@if ($testimonial->author_company) @ {{ $testimonial->author_company }}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($testimonials->count() > 1)
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <button class="btn btn-outline-gold rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width:44px;height:44px">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="btn btn-outline-gold rounded-circle" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width:44px;height:44px">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-center text-muted py-5">Testimonials coming soon!</p>
            @endif
        </div>
    </section>

    {{-- Project Cost Calculator Section --}}
    <section id="calculator" class="py-5">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">Project Budget</span>
                <h2 class="title">Cost <span class="text-gradient-gold">Calculator</span></h2>
                <div class="divider"></div>
            </div>

            <div class="row g-4 mt-2 justify-content-center">
                <div class="col-lg-10">
                    <div class="calculator-card reveal">
                        <div class="row g-4">
                            {{-- Left: Inputs --}}
                            <div class="col-lg-7">
                                {{-- Project Type --}}
                                <div class="mb-4">
                                    <label class="calc-label">
                                        <i class="bi bi-diagram-3 me-2"></i>Project Type
                                    </label>
                                    <div class="project-type-grid">
                                        <button type="button" class="project-type-btn active" data-type="landing" data-base="{{ $calcSettings['base_landing'] }}">
                                            <i class="bi bi-file-earmark-code"></i>
                                            <span>Landing Page</span>
                                        </button>
                                        <button type="button" class="project-type-btn" data-type="business" data-base="{{ $calcSettings['base_business'] }}">
                                            <i class="bi bi-building"></i>
                                            <span>Business Website</span>
                                        </button>
                                        <button type="button" class="project-type-btn" data-type="school" data-base="{{ $calcSettings['base_school'] }}">
                                            <i class="bi bi-mortarboard"></i>
                                            <span>School Website</span>
                                        </button>
                                        <button type="button" class="project-type-btn" data-type="ecommerce" data-base="{{ $calcSettings['base_ecommerce'] }}">
                                            <i class="bi bi-bag-check"></i>
                                            <span>E-commerce</span>
                                        </button>
                                        <button type="button" class="project-type-btn" data-type="webapp" data-base="{{ $calcSettings['base_webapp'] }}">
                                            <i class="bi bi-window-stack"></i>
                                            <span>Web Application</span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Number of Pages --}}
                                <div class="mb-4">
                                    <label class="calc-label">
                                        <i class="bi bi-files me-2"></i>Number of Pages
                                        <span class="page-count-badge" id="page-count-display">1</span>
                                    </label>
                                    <input type="range" class="form-range calc-range" id="page-count" min="1" max="30" value="1" data-per-page="{{ $calcSettings['per_page'] }}" data-included="{{ $calcSettings['included_pages'] }}">
                                    <div class="d-flex justify-content-between mt-1">
                                        <small class="text-muted">1 page</small>
                                        <small class="text-muted">30 pages</small>
                                    </div>
                                    <small class="text-muted d-block mt-1">First {{ $calcSettings['included_pages'] }} pages included in base price. Each additional page: &#8358;{{ number_format($calcSettings['per_page']) }}</small>
                                </div>

                                {{-- Extra Features --}}
                                <div>
                                    <label class="calc-label">
                                        <i class="bi bi-gear-wide-connected me-2"></i>Extra Features
                                    </label>
                                    <div class="features-grid">
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_seo'] }}">
                                            <i class="bi bi-search"></i> SEO Optimization
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_payment'] }}">
                                            <i class="bi bi-credit-card"></i> Payment Gateway
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_auth'] }}">
                                            <i class="bi bi-shield-lock"></i> User Authentication
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_dashboard'] }}">
                                            <i class="bi bi-speedometer2"></i> Admin Dashboard
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_api'] }}">
                                            <i class="bi bi-cloud-arrow-up"></i> API Integration
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_chat'] }}">
                                            <i class="bi bi-chat-dots"></i> Live Chat
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_cms'] }}">
                                            <i class="bi bi-database-gear"></i> Content Management (CMS)
                                        </label>
                                        <label class="feature-chip">
                                            <input type="checkbox" class="feature-checkbox" data-cost="{{ $calcSettings['feat_email'] }}">
                                            <i class="bi bi-envelope-paper"></i> Email Setup
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Right: Cost Display --}}
                            <div class="col-lg-5">
                                <div class="cost-display-panel">
                                    <div class="cost-breakdown">
                                        <div class="cost-row">
                                            <span class="cost-label-text" id="breakdown-type">Landing Page</span>
                                            <span class="cost-value" id="breakdown-type-cost">&#8358;{{ number_format($calcSettings['base_landing']) }}</span>
                                        </div>
                                        <div class="cost-row" id="breakdown-pages-row">
                                            <span class="cost-label-text" id="breakdown-pages-text">Extra Pages (0)</span>
                                            <span class="cost-value" id="breakdown-pages-cost">₦0</span>
                                        </div>
                                        <div class="cost-row" id="breakdown-features-row" style="display:none">
                                            <span class="cost-label-text">Extra Features</span>
                                            <span class="cost-value" id="breakdown-features-cost">₦0</span>
                                        </div>
                                    </div>

                                    <hr style="border-color:#2a2a2a;margin:1rem 0">

                                    <div class="total-cost-label">
                                        <i class="bi bi-calculator me-2"></i>Estimated Total
                                    </div>
                                    <div class="total-cost-amount text-gradient-gold" id="total-cost">&#8358;{{ number_format($calcSettings['base_landing']) }}</div>

                                    <div class="cost-note">
                                        <i class="bi bi-info-circle me-1"></i>
                                        This is an estimate. Final pricing depends on specific requirements. Let's discuss the details!
                                    </div>

                                    <div class="d-flex gap-2 mt-3">
                                        <button type="button" class="btn btn-gold flex-grow-1" id="get-quote-btn">
                                            <i class="bi bi-send me-2"></i>Get a Quote
                                        </button>
                                        <button type="button" class="btn btn-outline-gold" id="calc-reset-btn">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="py-5">
        <div class="container py-5">
            <div class="section-heading text-center reveal">
                <span class="subtitle">Get In Touch</span>
                <h2 class="title">Contact <span class="text-gradient-gold">Me</span></h2>
                <div class="divider"></div>
            </div>

            <div class="row g-5 mt-2">
                {{-- Contact Info --}}
                <div class="col-lg-5 reveal-left">
                    <h3 class="fw-bold mb-4">Let's Work Together!</h3>
                    <p class="text-muted mb-4" style="line-height:1.8">
                        Have a project in mind? I'm available for freelance work and full-time opportunities. Let's build something amazing together.
                    </p>

                    <div class="d-flex flex-column gap-3">
                        @if (!empty($settings['email']))
                            <a href="mailto:{{ $settings['email'] }}" class="text-decoration-none">
                                <div class="contact-info-card">
                                    <div class="contact-icon"><i class="bi bi-envelope-fill"></i></div>
                                    <div>
                                        <div class="contact-label text-muted">Email</div>
                                        <div class="contact-value">{{ $settings['email'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if (!empty($settings['phone']))
                            <a href="tel:{{ $settings['phone'] }}" class="text-decoration-none">
                                <div class="contact-info-card">
                                    <div class="contact-icon"><i class="bi bi-telephone-fill"></i></div>
                                    <div>
                                        <div class="contact-label text-muted">Phone</div>
                                        <div class="contact-value">{{ $settings['phone'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if (!empty($settings['whatsapp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" class="text-decoration-none">
                                <div class="contact-info-card" style="background:rgba(37,211,102,0.05);border-color:rgba(37,211,102,0.2) !important">
                                    <div class="contact-icon" style="background:rgba(37,211,102,0.1);color:#25d366"><i class="bi bi-whatsapp"></i></div>
                                    <div>
                                        <div class="contact-label text-muted">WhatsApp</div>
                                        <div class="contact-value">{{ $settings['whatsapp'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if (!empty($settings['github_url']))
                            <a href="{{ $settings['github_url'] }}" target="_blank" class="text-decoration-none">
                                <div class="contact-info-card">
                                    <div class="contact-icon"><i class="bi bi-github"></i></div>
                                    <div>
                                        <div class="contact-label text-muted">GitHub</div>
                                        <div class="contact-value">{{ $settings['github_url'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if (!empty($settings['linkedin_url']))
                            <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="text-decoration-none">
                                <div class="contact-info-card">
                                    <div class="contact-icon" style="background:rgba(10,102,194,0.1);color:#0a66c2"><i class="bi bi-linkedin"></i></div>
                                    <div>
                                        <div class="contact-label text-muted">LinkedIn</div>
                                        <div class="contact-value">{{ $settings['linkedin_url'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>

                    @if (isset($settings['cv_path']) && $settings['cv_path'])
                        <a href="{{ route('download.cv') }}" class="btn btn-gold mt-4 px-4 py-2">
                            <i class="bi bi-download me-2"></i>Download CV
                        </a>
                    @endif
                </div>

                {{-- Contact Form --}}
                <div class="col-lg-7 reveal-right">
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Your Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Abideen" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Your Email</label>
                                <input type="email" class="form-control" name="email" placeholder="abideen@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="Project Discussion">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" rows="6" placeholder="Tell me about your project..." required style="min-height:150px"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-gold px-5 py-2">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="footer-section" style="background:#080808;border-top:1px solid #1a1a1a">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand text-gradient-gold mb-3">Abideen.dev</div>
                    <p class="text-muted small" style="line-height:1.8;max-width:320px">
                        Full-Stack Developer & Project Manager building secure, scalable, and user-friendly web applications for businesses, schools, and organizations.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        @if (!empty($settings['github_url']))
                            <a href="{{ $settings['github_url'] }}" target="_blank" class="social-link" style="color:#e0e0e0;background:rgba(255,255,255,0.05)"><i class="bi bi-github"></i></a>
                        @endif
                        @if (!empty($settings['linkedin_url']))
                            <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="social-link" style="color:#0a66c2;background:rgba(10,102,194,0.1)"><i class="bi bi-linkedin"></i></a>
                        @endif
                        @if (!empty($settings['whatsapp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" class="social-link" style="color:#25d366;background:rgba(37,211,102,0.1)"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#home" class="text-muted">Home</a></li>
                        <li><a href="#about" class="text-muted">About</a></li>
                        <li><a href="#services" class="text-muted">Services</a></li>
                        <li><a href="#projects" class="text-muted">Projects</a></li>
                        <li><a href="#contact" class="text-muted">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="fw-bold mb-3">Services</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#services" class="text-muted">Web Development</a></li>
                        <li><a href="#services" class="text-muted">Laravel Apps</a></li>
                        <li><a href="#services" class="text-muted">School Systems</a></li>
                        <li><a href="#services" class="text-muted">API Integration</a></li>
                        <li><a href="#services" class="text-muted">Database Design</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <ul class="list-unstyled footer-links">
                        @if (!empty($settings['email']))
                            <li><a href="mailto:{{ $settings['email'] }}" class="text-muted"><i class="bi bi-envelope me-2"></i>{{ $settings['email'] }}</a></li>
                        @endif
                        @if (!empty($settings['phone']))
                            <li><a href="tel:{{ $settings['phone'] }}" class="text-muted"><i class="bi bi-telephone me-2"></i>{{ $settings['phone'] }}</a></li>
                        @endif
                        <li><a href="#" class="text-muted"><i class="bi bi-geo-alt me-2"></i>{{ $settings['location'] ?? 'Nigeria' }}</a></li>
                    </ul>
                </div>
            </div>
            <hr style="border-color:#1a1a1a;margin-top:2rem">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 gap-2">
                <p class="text-muted small mb-0">&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Abideen.dev' }}. All rights reserved.</p>
                <p class="text-muted small mb-0">Designed & built with <i class="bi bi-heart-fill text-danger"></i> by Akingbehin Abideen</p>
            </div>
        </div>
    </footer>

    {{-- Back to Top Button --}}
    <button class="back-to-top btn btn-gold" id="back-to-top" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    {{-- Toast Container --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast-container" style="z-index:9998"></div>

    {{-- Lightbox --}}
    <div class="modal" id="lightbox" style="display:none;z-index:9999">
        <div class="modal-dialog modal-fullscreen" style="background:transparent">
            <div class="modal-content" style="background:transparent;border:none">
                <div class="modal-body p-0 d-flex align-items-center justify-content-center" style="min-height:100vh">
                    <button class="btn btn-lg position-absolute top-0 end-0 m-3 text-white" id="lightbox-close" style="font-size:2rem;background:rgba(0,0,0,0.5);border:none">
                        <i class="bi bi-x-lg"></i>
                    </button>
                    <button class="btn btn-lg position-absolute top-50 translate-middle-y start-0 m-3 text-white" id="lightbox-prev" style="font-size:2rem;background:rgba(0,0,0,0.5);border:none">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <img id="lightbox-image" src="" alt="Project Image" style="max-width:90%;max-height:90vh;border-radius:12px">
                    <button class="btn btn-lg position-absolute top-50 translate-middle-y end-0 m-3 text-white" id="lightbox-next" style="font-size:2rem;background:rgba(0,0,0,0.5);border:none">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
