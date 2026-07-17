<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Live Code Playground — Write HTML, CSS, and JavaScript in real-time with instant preview. Experiment with code snippets and templates.">
    <meta name="keywords" content="code playground, live editor, HTML CSS JS editor, Monaco editor, web development tools">
    <title>Live Playground | {{ $settings['site_name'] ?? 'Abideen.dev' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/portfolio.js', 'resources/js/playground.js'])

    {{-- Monaco Editor (CDN) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.min.js"></script>
    {{-- JSZip (CDN) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('playground') }}">Playground</a></li>
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
                <li class="nav-item"><a class="nav-link" href="{{ route('playground') }}">Playground</a></li>
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

    {{-- Playground Page --}}
    <main class="playground-page" id="playground-page">
        {{-- Hero --}}
        <header class="playground-hero">
            <div class="container">
                <a href="{{ route('home') }}" class="btn btn-outline-gold btn-sm mb-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to Home
                </a>
                <span class="subtitle">Code · Preview · Experiment</span>
                <h1>Live <span class="text-gradient-gold">Playground</span></h1>
                <p>Write HTML, CSS, and JavaScript with live preview. Pick a template to get started, or build from scratch.</p>
            </div>
        </header>

        <div class="container">
            {{-- Template Selector --}}
            <div class="template-bar">
                <button type="button" class="template-btn active" data-template="landing">
                    <i class="bi bi-window-stack"></i> Landing Page
                </button>
                <button type="button" class="template-btn" data-template="login">
                    <i class="bi bi-box-arrow-in-right"></i> Login Form
                </button>
                <button type="button" class="template-btn" data-template="calculator">
                    <i class="bi bi-calculator"></i> Calculator
                </button>
                <button type="button" class="template-btn" data-template="todo">
                    <i class="bi bi-list-check"></i> Todo App
                </button>
                <button type="button" class="template-btn" data-template="navbar">
                    <i class="bi bi-menu-button-wide"></i> Navbar
                </button>
            </div>

            {{-- Toolbar --}}
            <div class="playground-toolbar">
                <button type="button" class="tool-btn btn-run" id="pg-run-btn">
                    <i class="bi bi-play-fill"></i> Run
                </button>
                <button type="button" class="tool-btn" id="pg-reset-btn">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
                <button type="button" class="tool-btn" id="pg-copy-btn">
                    <i class="bi bi-clipboard"></i> Copy
                </button>
                <button type="button" class="tool-btn btn-download" id="pg-download-btn">
                    <i class="bi bi-file-zip"></i> Download ZIP
                </button>
            </div>

            {{-- Editor + Preview Layout --}}
            <div class="playground-layout" id="playground-layout">
                {{-- Editor Pane --}}
                <div class="editor-pane">
                    <div class="editor-tabs">
                        <button type="button" class="editor-tab active" data-editor="html">
                            <i class="bi bi-filetype-html"></i> HTML
                        </button>
                        <button type="button" class="editor-tab" data-editor="css">
                            <i class="bi bi-filetype-css"></i> CSS
                        </button>
                        <button type="button" class="editor-tab" data-editor="js">
                            <i class="bi bi-filetype-js"></i> JS
                        </button>
                    </div>
                    <div class="editor-container">
                        <div class="editor-wrapper active" id="editor-html"></div>
                        <div class="editor-wrapper" id="editor-css"></div>
                        <div class="editor-wrapper" id="editor-js"></div>
                    </div>
                </div>

                {{-- Resizer --}}
                <div class="playground-resizer" id="pg-resizer"></div>

                {{-- Preview Pane --}}
                <div class="preview-pane">
                    <div class="preview-header">
                        <span class="preview-title">
                            <i class="bi bi-eye"></i> Live Preview
                        </span>
                        <div class="preview-actions">
                            <button type="button" class="preview-action-btn" id="pg-refresh-preview" title="Refresh preview">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>
                    <div class="preview-wrapper">
                        <iframe id="preview-iframe" sandbox="allow-scripts" title="Live Preview"></iframe>
                    </div>

                    {{-- Console Panel --}}
                    <div class="console-panel" id="console-panel">
                        <div class="console-header" id="console-header">
                            <span class="console-label">
                                <i class="bi bi-terminal"></i> Console
                            </span>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="console-clear-btn" id="console-clear-btn">
                                    <i class="bi bi-eraser me-1"></i>Clear
                                </button>
                                <i class="bi bi-chevron-down console-chevron"></i>
                            </div>
                        </div>
                        <div class="console-body" id="console-body">
                            <div class="console-empty">Console is ready. Errors will appear here.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Note --}}
            <p class="text-center text-muted small mt-3 mb-0">
                <i class="bi bi-info-circle me-1"></i>
                The preview updates automatically as you type. Use the Run button for an immediate refresh.
            </p>
        </div>
    </main>

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

    {{-- Live Chat Widget --}}
    @include('partials.live-chat')

</body>
</html>
