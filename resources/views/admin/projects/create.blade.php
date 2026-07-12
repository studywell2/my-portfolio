@extends('admin.layouts.app')

@section('title', 'Add New Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Add New Project</h4>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project Image</label>
                    <input type="file" class="form-control" name="image_path" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project URL</label>
                    <input type="url" class="form-control @error('project_url') is-invalid @enderror" name="project_url" value="{{ old('project_url') }}" placeholder="https://...">
                    @error('project_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" value="1" @checked(old('is_featured'))>
                        <label class="form-check-label" for="is_featured">Featured Project</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-check-lg me-1"></i>Create Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
