@extends('admin.layouts.app')

@section('title', 'Add New Skill')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Add New Skill</h4>
    <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.skills.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Skill Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                        <option value="">Select Category</option>
                        <option value="backend" @selected(old('category') == 'backend')>Backend</option>
                        <option value="frontend" @selected(old('category') == 'frontend')>Frontend</option>
                        <option value="tools" @selected(old('category') == 'tools')>Tools</option>
                    </select>
                    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Proficiency: <span id="profValue" style="color:#d4af37">{{ old('proficiency', 80) }}%</span></label>
                    <input type="range" class="form-range" name="proficiency" min="0" max="100" value="{{ old('proficiency', 80) }}" oninput="document.getElementById('profValue').textContent=this.value+'%'">
                    @error('proficiency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Icon Class (Bootstrap Icons)</label>
                    <input type="text" class="form-control" name="icon_class" value="{{ old('icon_class') }}" placeholder="bi-laravel">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-check-lg me-1"></i>Create Skill
                    </button>
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
