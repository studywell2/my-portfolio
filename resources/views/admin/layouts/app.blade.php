<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }} Admin</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230a0a0a'/><text x='50' y='68' font-size='52' font-weight='bold' text-anchor='middle' fill='%23d4af37' font-family='monospace'>&lt;/&gt;</text></svg>">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body { background: #0a0a0a; overflow-x: hidden; }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background: #121212;
            border-right: 1px solid #2a2a2a;
            z-index: 1030;
            transition: transform 0.3s ease;
        }

        .admin-sidebar .sidebar-brand {
            padding: 1.5rem 1.25rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.4rem;
            border-bottom: 1px solid #2a2a2a;
            letter-spacing: -0.5px;
        }

        .admin-sidebar .nav-link {
            color: #a0a0a0;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            font-size: 0.925rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 0;
            transition: all 0.2s ease;
        }

        .admin-sidebar .nav-link:hover {
            background: rgba(212,175,55,0.08);
            color: #d4af37;
        }

        .admin-sidebar .nav-link.active {
            background: rgba(212,175,55,0.12);
            color: #d4af37;
            border-left: 3px solid #d4af37;
        }

        .admin-sidebar .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .admin-main {
            margin-left: 250px;
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

        .admin-topbar {
            background: #121212;
            border-bottom: 1px solid #2a2a2a;
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .admin-content {
            padding: 2rem 1.5rem;
        }

        .card {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 12px;
        }

        .form-control, .form-select {
            background: #121212;
            border-color: #2a2a2a;
            color: #e0e0e0;
        }

        .form-control:focus, .form-select:focus {
            background: #121212;
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.15);
            color: #e0e0e0;
        }

        .table {
            color: #e0e0e0;
        }

        .table > :not(caption) > * > * {
            background-color: transparent;
            border-color: #2a2a2a;
        }

        .table thead th {
            border-bottom: 2px solid #2a2a2a;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            color: #a0a0a0;
        }

        .page-link {
            background: #1a1a1a;
            border-color: #2a2a2a;
            color: #e0e0e0;
        }

        .page-link:hover {
            background: #2a2a2a;
            border-color: #2a2a2a;
            color: #d4af37;
        }

        .page-item.active .page-link {
            background: #d4af37;
            border-color: #d4af37;
            color: #000;
        }

        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: inline-block;
            }
        }

        @media (max-width: 767.98px) {
            .admin-content {
                padding: 1rem 1rem;
            }

            .admin-topbar {
                padding: 0.75rem 1rem;
            }

            .admin-table-mobile thead {
                display: none;
            }

            .admin-table-mobile,
            .admin-table-mobile tbody,
            .admin-table-mobile tr,
            .admin-table-mobile td {
                display: block;
                width: 100%;
            }

            .admin-table-mobile tr {
                margin-bottom: 1rem;
                border: 1px solid #2a2a2a;
                border-radius: 12px;
                padding: 0.75rem 1rem;
            }

            .admin-table-mobile td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: none;
                padding: 0.5rem 0;
                text-align: right;
            }

            .admin-table-mobile td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #a0a0a0;
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-right: 1rem;
                white-space: nowrap;
            }

            .admin-table-mobile td:last-child {
                justify-content: flex-end;
                padding-top: 0.75rem;
                border-top: 1px solid #2a2a2a;
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1029;
        }

        .sidebar-overlay.show {
            display: block;
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <nav class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand text-gradient-gold">Abideen.dev</div>
        <ul class="nav flex-column pt-2">
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.projects.*')) active @endif" href="{{ route('admin.projects.index') }}">
                    <i class="bi bi-folder2-open"></i> Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.categories.*')) active @endif" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.skills.*')) active @endif" href="{{ route('admin.skills.index') }}">
                    <i class="bi bi-bar-chart-line"></i> Skills
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.testimonials.*')) active @endif" href="{{ route('admin.testimonials.index') }}">
                    <i class="bi bi-chat-quote"></i> Testimonials
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.messages.*')) active @endif" href="{{ route('admin.messages.index') }}">
                    <i class="bi bi-envelope"></i> Messages
                    @php $unread = \App\Models\ContactMessage::unread()->count(); @endphp
                    @if ($unread > 0)
                        <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.settings.*')) active @endif" href="{{ route('admin.settings.edit') }}">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
            <li class="nav-item mt-3 border-top border-secondary pt-3">
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Site
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="document.getElementById('adminSidebar').classList.remove('show'); this.classList.remove('show')"></div>

    {{-- Main Content --}}
    <div class="admin-main">
        <div class="admin-topbar d-flex align-items-center">
            <button class="btn btn-link sidebar-toggle text-decoration-none text-light p-0 me-3" onclick="document.getElementById('adminSidebar').classList.toggle('show'); document.getElementById('sidebarOverlay').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h5 class="mb-0 fw-bold text-truncate">@yield('title', 'Dashboard')</h5>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-sm-inline">Welcome, {{ auth()->user()->name }}</span>
            </div>
        </div>

        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i><strong>Validation errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
