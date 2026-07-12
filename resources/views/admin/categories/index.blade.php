@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Categories</h4>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-1"></i>Add New Category
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Projects</th>
                        <th>Sort</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td data-label="Name">{{ $category->name }}</td>
                            <td data-label="Icon">
                                @if ($category->icon)
                                    <i class="bi {{ $category->icon }}" style="color:#d4af37;font-size:1.1rem"></i> {{ $category->icon }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td data-label="Projects">{{ $category->projects_count }}</td>
                            <td data-label="Sort">{{ $category->sort_order }}</td>
                            <td data-label="Actions" class="text-end">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $categories->links() }}
</div>
@endsection
