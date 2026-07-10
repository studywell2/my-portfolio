@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Projects</h4>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-1"></i>Add New Project
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Sort</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td style="width:60px">
                                @if ($project->image_path)
                                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="rounded" style="width:50px;height:38px;object-fit:cover">
                                @else
                                    <div class="rounded d-flex align-items-center justify-content-center" style="width:50px;height:38px;background:#1a1a1a;border:1px solid #2a2a2a">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->category->name ?? '—' }}</td>
                            <td>
                                @if ($project->is_featured)
                                    <span class="badge" style="background:rgba(212,175,55,0.2);color:#d4af37">Featured</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>{{ $project->sort_order }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="d-inline" onsubmit="return confirm('Delete this project?')">
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
                            <td colspan="6" class="text-center text-muted py-4">No projects found. Click "Add New Project" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $projects->withQueryString()->links() }}
</div>
@endsection
