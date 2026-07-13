<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $project->title }} — Case Study. {{ $project->category->name ?? '' }} project by {{ $settings['hero_title'] ?? 'Abideen' }}. {{ \Illuminate\Support\Str::limit($project->overview ?? $project->description, 150) }}">
    <meta name="keywords" content="{{ $project->title }}, case study, {{ $project->category->name ?? 'project' }}, {{ $settings['hero_title'] ?? 'Abideen' }}">
    <meta property="og:title" content="{{ $project->title }} — Case Study">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit($project->overview ?? $project->description, 150) }}">
    <meta property="og:type" content="article">
    <title>{{ $project->title }} — Case Study | {{ $settings['site_name'] ?? 'Abideen.dev' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/portfolio.js'])
</head>
<body style="background: #0a0a0a; color: #e0e0e0;">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="main-navbar">
        <div class="container">
            <a class="navbar-brand text-gradient-gold" href="{{ route('home') }}">Abideen.dev</a>
            <button class="navbar-toggler border-0 p-1 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navOffcanvas" aria-label="Toggle navigation">
                <i class="bi bi-list text-light" style="font-size:1.4rem"></i>
            </button>
            <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#calculator">Cost Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>
                    <li class="nav-item">
                        <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
                            <i id="theme-icon" class="bi bi-sun"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}#contact" class="btn btn-gold btn-sm px-3">Hire Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Mobile Offcanvas Nav --}}
    <div class="offcanvas offcanvas-end nav-offcanvas" tabindex="-1" id="navOffcanvas">
        <div class="offcanvas-header">
            <span class="offcanvas-title text-gradient-gold">Menu</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav gap-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#projects">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#calculator">Cost Calculator</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>
                <li class="nav-item mt-2">
                    <button class="theme-toggle" id="theme-toggle-mobile" aria-label="Toggle theme">
                        <i id="theme-icon-mobile" class="bi bi-sun"></i>
                    </button>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('home') }}#contact" class="btn btn-gold btn-sm px-3 w-100">Hire Me</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Case Study --}}
    <article class="case-study-page">
        {{-- Hero --}}
        <header class="case-study-hero" style="padding-top: 120px">
            <div class="container">
                <a href="{{ route('home') }}#projects" class="btn btn-outline-gold btn-sm mb-4">
                    <i class="bi bi-arrow-left me-2"></i>Back to Projects
                </a>
                <div class="reveal is-visible">
                    <span class="subtitle">{{ $project->category->name ?? 'Project' }}</span>
                    <h1 class="case-study-title">{{ $project->title }}</h1>
                    @if ($project->technologies_used)
                        <div class="case-study-tech-badges mt-3">
                            @foreach ((array) $project->technologies_used as $tech)
                                <span class="tech-badge">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        @if ($project->project_url && $project->project_url !== '#')
                            <a href="{{ $project->project_url }}" target="_blank" class="btn btn-gold px-4 py-2">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Live Demo
                            </a>
                        @endif
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-gold px-4 py-2">
                                <i class="bi bi-github me-2"></i>Source Code
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        {{-- Hero Image --}}
        @if ($project->hero_image_path || $project->image_path)
            <div class="container">
                <div class="case-study-hero-image reveal is-visible">
                    <img src="{{ asset('storage/' . ($project->hero_image_path ?? $project->image_path)) }}" alt="{{ $project->title }}" loading="lazy">
                </div>
            </div>
        @endif

        {{-- Body --}}
        <div class="container py-5">
            <div class="row g-5">
                {{-- Main Content --}}
                <div class="col-lg-8">
                    @if ($project->overview)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-info-circle me-2"></i>Project Overview</h2>
                            <p class="case-study-text">{{ $project->overview }}</p>
                        </section>
                    @endif

                    @if ($project->problem_statement)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-exclamation-triangle me-2"></i>The Problem</h2>
                            <p class="case-study-text">{{ $project->problem_statement }}</p>
                        </section>
                    @endif

                    @if ($project->solution)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-lightbulb me-2"></i>My Solution</h2>
                            <p class="case-study-text">{{ $project->solution }}</p>
                        </section>
                    @endif

                    @if ($project->key_features && count((array) $project->key_features) > 0)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-stars me-2"></i>Key Features</h2>
                            <div class="case-study-features">
                                @foreach ((array) $project->key_features as $feature)
                                    <div class="feature-pill">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if ($project->challenges)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-hurdle me-2"></i>Challenges Faced</h2>
                            <p class="case-study-text">{{ $project->challenges }}</p>
                        </section>
                    @endif

                    @if ($project->challenges_solved)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-shield-check me-2"></i>How I Solved Them</h2>
                            <p class="case-study-text">{{ $project->challenges_solved }}</p>
                        </section>
                    @endif

                    @if ($project->results_impact)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-graph-up-arrow me-2"></i>Results & Impact</h2>
                            <div class="results-card">
                                <p class="case-study-text mb-0">{{ $project->results_impact }}</p>
                            </div>
                        </section>
                    @endif

                    {{-- Gallery --}}
                    @if ($project->gallery && count((array) $project->gallery) > 0)
                        <section class="case-study-section">
                            <h2 class="case-study-heading"><i class="bi bi-images me-2"></i>Project Gallery</h2>
                            <div class="case-study-gallery">
                                @foreach ((array) $project->gallery as $image)
                                    <a href="{{ asset('storage/' . $image) }}" data-lightbox class="gallery-thumb">
                                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }} screenshot" loading="lazy">
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="col-lg-4">
                    <div class="case-study-sidebar">
                        <div class="sidebar-card">
                            <h6 class="sidebar-title">Project Info</h6>
                            <ul class="sidebar-list">
                                <li>
                                    <span class="sidebar-label">Category</span>
                                    <span class="sidebar-value">{{ $project->category->name ?? 'N/A' }}</span>
                                </li>
                                <li>
                                    <span class="sidebar-label">Featured</span>
                                    <span class="sidebar-value">{{ $project->is_featured ? 'Yes' : 'No' }}</span>
                                </li>
                                @if ($project->technologies_used)
                                    <li>
                                        <span class="sidebar-label">Tech Stack</span>
                                        <span class="sidebar-value">
                                            @foreach ((array) $project->technologies_used as $tech)
                                                <span class="tech-badge-sm">{{ $tech }}</span>
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        @if ($project->project_url || $project->github_url)
                            <div class="sidebar-card">
                                <h6 class="sidebar-title">Links</h6>
                                <div class="d-flex flex-column gap-2">
                                    @if ($project->project_url && $project->project_url !== '#')
                                        <a href="{{ $project->project_url }}" target="_blank" class="btn btn-gold btn-sm w-100">
                                            <i class="bi bi-box-arrow-up-right me-2"></i>Live Demo
                                        </a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-gold btn-sm w-100">
                                            <i class="bi bi-github me-2"></i>Source Code
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="sidebar-card text-center">
                            <h6 class="sidebar-title">Want a Similar Project?</h6>
                            <p class="text-muted small mb-3">Let's discuss your requirements and build something great together.</p>
                            <a href="{{ route('home') }}#contact" class="btn btn-gold btn-sm w-100">
                                <i class="bi bi-envelope me-2"></i>Get in Touch
                            </a>
                        </div>
                    </div>
                </aside>
            </div>

            {{-- Related Projects --}}
            @if ($relatedProjects->count() > 0)
                <section class="related-projects">
                    <h3 class="text-center mb-4 reveal is-visible">Related Projects</h3>
                    <div class="row g-4">
                        @foreach ($relatedProjects as $related)
                            <div class="col-md-4">
                                <a href="{{ route('case-study.show', $related->slug) }}" class="related-project-card">
                                    <div class="related-project-img">
                                        @if ($related->image_path)
                                            <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}" loading="lazy">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100" style="background:linear-gradient(135deg,#1a1a1a,#2a2a2a)">
                                                <i class="bi bi-code-slash" style="font-size:2.5rem;color:#d4af37;opacity:0.3"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="related-project-info">
                                        <span class="related-project-cat">{{ $related->category->name ?? '' }}</span>
                                        <h6>{{ $related->title }}</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>

    {{-- Footer --}}
    <footer class="footer-section" style="background:#080808;border-top:1px solid #1a1a1a">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-4 gap-2">
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
