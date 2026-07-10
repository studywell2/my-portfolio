@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-4 text-center">
            <div class="stat-icon mb-2"><i class="bi bi-folder2-open" style="font-size:2rem;color:#d4af37"></i></div>
            <div class="fs-2 fw-bold text-gradient-gold">{{ $stats['projects'] }}</div>
            <div class="text-muted small text-uppercase fw-600">Projects</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-4 text-center">
            <div class="mb-2"><i class="bi bi-envelope" style="font-size:2rem;color:#3b82f6"></i></div>
            <div class="fs-2 fw-bold" style="color:#60a5fa">{{ $stats['unread_messages'] }}</div>
            <div class="text-muted small text-uppercase fw-600">Unread Messages</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-4 text-center">
            <div class="mb-2"><i class="bi bi-chat-quote" style="font-size:2rem;color:#d4af37"></i></div>
            <div class="fs-2 fw-bold text-gradient-gold">{{ $stats['testimonials'] }}</div>
            <div class="text-muted small text-uppercase fw-600">Testimonials</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card p-4 text-center">
            <div class="mb-2"><i class="bi bi-bar-chart-line" style="font-size:2rem;color:#3b82f6"></i></div>
            <div class="fs-2 fw-bold" style="color:#60a5fa">{{ $stats['skills'] }}</div>
            <div class="text-muted small text-uppercase fw-600">Skills</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-envelope me-2"></i>Recent Messages</h6>
                <a href="{{ route('admin.messages.index') }}" class="text-decoration-none small" style="color:#d4af37">View All</a>
            </div>
            <div class="card-body p-0">
                @forelse ($recentMessages as $message)
                    <div class="d-flex align-items-center gap-3 p-3 border-bottom border-secondary" style="border-color:#2a2a2a !important">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:rgba(212,175,55,0.1);color:#d4af37">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <div class="fw-600 text-truncate">{{ $message->name }}
                                @if (!$message->is_read) <span class="badge bg-danger ms-1">New</span> @endif
                            </div>
                            <div class="text-muted small text-truncate">{{ $message->subject ?: $message->message }}</div>
                        </div>
                        <a href="{{ route('admin.messages.show', $message) }}" class="text-decoration-none" style="color:#d4af37">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-muted text-center p-4 mb-0">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-folder2-open me-2"></i>Recent Projects</h6>
                <a href="{{ route('admin.projects.index') }}" class="text-decoration-none small" style="color:#d4af37">View All</a>
            </div>
            <div class="card-body p-0">
                @forelse ($recentProjects as $project)
                    <div class="d-flex align-items-center gap-3 p-3 border-bottom border-secondary" style="border-color:#2a2a2a !important">
                        <div class="rounded d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:rgba(59,130,246,0.1);color:#60a5fa">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <div class="fw-600 text-truncate">{{ $project->title }}
                                @if ($project->is_featured) <span class="badge ms-1" style="background:rgba(212,175,55,0.2);color:#d4af37">Featured</span> @endif
                            </div>
                            <div class="text-muted small text-truncate">{{ $project->category->name ?? 'Uncategorized' }}</div>
                        </div>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-decoration-none" style="color:#d4af37">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-muted text-center p-4 mb-0">No projects yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
