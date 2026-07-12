@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 mb-1 fw-bold">Testimonials</h1>
            <p class="text-muted mb-0">Manage client testimonials displayed on your portfolio.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold">
            <i class="bi bi-plus-lg me-1"></i> Add New Testimonial
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if ($testimonials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table-mobile">
                        <thead>
                            <tr>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Active</th>
                                <th>Sort Order</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td data-label="Author">
                                        <div class="d-flex align-items-center gap-3">
                                            @if ($testimonial->avatar_path)
                                                <img src="{{ asset('storage/' . $testimonial->avatar_path) }}" alt="{{ $testimonial->author_name }}" class="rounded-circle" width="40" height="40" style="object-fit: cover">
                                            @else
                                                <span class="rounded-circle d-inline-flex align-items-center justify-content-center bg-secondary" style="width:40px;height:40px">
                                                    <i class="bi bi-person"></i>
                                                </span>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $testimonial->author_name }}</div>
                                                <div class="small text-muted">
                                                    {{ implode(', ', array_filter([$testimonial->author_role, $testimonial->author_company])) ?: '—' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Rating">
                                        <span class="rating-stars" style="color: #d4af37">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                            @endfor
                                        </span>
                                        <span class="badge bg-secondary-subtle text-secondary ms-1">{{ $testimonial->rating }}/5</span>
                                    </td>
                                    <td data-label="Active">
                                        @if ($testimonial->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td data-label="Sort Order">{{ $testimonial->sort_order }}</td>
                                    <td data-label="Actions" class="text-end">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-gold" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $testimonials->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-chat-quote" style="font-size: 3rem; color: #2a2a2a"></i>
                    <h4 class="mt-3">No testimonials yet</h4>
                    <p class="text-muted">Start by adding your first testimonial.</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-gold">
                        <i class="bi bi-plus-lg me-1"></i> Add New Testimonial
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
