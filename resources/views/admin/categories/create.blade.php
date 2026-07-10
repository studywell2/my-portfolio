@extends('admin.layouts.app')

@section('title', 'Add New Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Add New Category</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Icon (Bootstrap Icon class)</label>
                    <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="bi-mortarboard">
                    <small class="text-muted">See <a href="https://icons.getbootstrap.com" target="_blank" style="color:#d4af37">bootstrap icons</a></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-check-lg me-1"></i>Create Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
