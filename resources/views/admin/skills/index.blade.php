@extends('admin.layouts.app')

@section('title', 'Skills')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Skills</h4>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-gold">
        <i class="bi bi-plus-lg me-1"></i>Add New Skill
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Proficiency</th>
                        <th>Icon</th>
                        <th>Sort</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skills as $skill)
                        <tr>
                            <td data-label="Name">{{ $skill->name }}</td>
                            <td data-label="Category">
                                @if ($skill->category === 'backend')
                                    <span class="badge" style="background:rgba(212,175,55,0.2);color:#d4af37">Backend</span>
                                @elseif ($skill->category === 'frontend')
                                    <span class="badge" style="background:rgba(59,130,246,0.2);color:#60a5fa">Frontend</span>
                                @else
                                    <span class="badge bg-secondary">Tools</span>
                                @endif
                            </td>
                            <td data-label="Proficiency">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height:6px;max-width:120px">
                                        <div class="progress-bar" style="width:{{ $skill->proficiency }}%;background:linear-gradient(135deg,#d4af37,#e8c547)"></div>
                                    </div>
                                    <span class="small text-muted">{{ $skill->proficiency }}%</span>
                                </div>
                            </td>
                            <td data-label="Icon"><i class="bi {{ $skill->icon_class ?: 'bi-code-slash' }}" style="color:#d4af37"></i></td>
                            <td data-label="Sort">{{ $skill->sort_order }}</td>
                            <td data-label="Actions" class="text-end">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="d-inline" onsubmit="return confirm('Delete this skill?')">
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
                            <td colspan="6" class="text-center text-muted py-4">No skills found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $skills->links() }}
</div>
@endsection
