@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Edit Category</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Icon (Bootstrap Icon class)</label>
                    <input type="text" class="form-control" name="icon" value="{{ old('icon', $category->icon) }}" placeholder="bi-mortarboard">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-check-lg me-1"></i>Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
