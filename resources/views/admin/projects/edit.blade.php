@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Edit Project</h4>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $project->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description', $project->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project Image</label>
                    @if ($project->image_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="rounded" style="width:120px;height:80px;object-fit:cover">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="image_path" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hero Image (Case Study)</label>
                    @if ($project->hero_image_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $project->hero_image_path) }}" alt="Hero" class="rounded" style="width:120px;height:80px;object-fit:cover">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="hero_image_path" accept="image/*">
                    <small class="text-muted">Leave empty to keep current</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project URL</label>
                    <input type="url" class="form-control @error('project_url') is-invalid @enderror" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://...">
                    @error('project_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">GitHub URL</label>
                    <input type="url" class="form-control @error('github_url') is-invalid @enderror" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/...">
                    @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" value="1" @checked(old('is_featured', $project->is_featured))>
                        <label class="form-check-label" for="is_featured">Featured Project</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}">
                </div>
            </div>

            {{-- Case Study Details --}}
            <hr class="my-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-file-earmark-text me-2"></i>Case Study Details <small class="text-muted fw-normal">(optional)</small></h5>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Overview</label>
                    <textarea class="form-control" name="overview" rows="3">{{ old('overview', $project->overview) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Problem Statement</label>
                    <textarea class="form-control" name="problem_statement" rows="3">{{ old('problem_statement', $project->problem_statement) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">My Solution</label>
                    <textarea class="form-control" name="solution" rows="3">{{ old('solution', $project->solution) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Key Features <small class="text-muted">(comma-separated)</small></label>
                    <input type="text" class="form-control" name="key_features" value="{{ old('key_features', is_array($project->key_features) ? implode(', ', $project->key_features) : '') }}" placeholder="Student Management, Attendance, Fee Tracking">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Technologies Used <small class="text-muted">(comma-separated)</small></label>
                    <input type="text" class="form-control" name="technologies_used" value="{{ old('technologies_used', is_array($project->technologies_used) ? implode(', ', $project->technologies_used) : '') }}" placeholder="Laravel, PHP, MySQL, JavaScript, Bootstrap">
                </div>
                <div class="col-12">
                    <label class="form-label">Challenges Faced</label>
                    <textarea class="form-control" name="challenges" rows="3">{{ old('challenges', $project->challenges) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">How I Solved Them</label>
                    <textarea class="form-control" name="challenges_solved" rows="3">{{ old('challenges_solved', $project->challenges_solved) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Results & Impact</label>
                    <textarea class="form-control" name="results_impact" rows="3">{{ old('results_impact', $project->results_impact) }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-check-lg me-1"></i>Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
