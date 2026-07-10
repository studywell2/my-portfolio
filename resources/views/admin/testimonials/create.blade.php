@extends('admin.layouts.app')

@section('title', 'Add New Testimonial')

@section('content')
    <style>
        .form-control::file-selector-button,
        .form-control::-webkit-file-upload-button {
            background: #2a2a2a;
            color: #e0e0e0;
            border: none;
            padding: 0.375rem 0.75rem;
            margin-right: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        .form-control::file-selector-button:hover,
        .form-control::-webkit-file-upload-button:hover {
            background: #3a3a3a;
        }
        .form-check-input {
            background-color: #121212;
            border-color: #2a2a2a;
        }
        .form-check-input:checked {
            background-color: #d4af37;
            border-color: #d4af37;
        }
        .form-check-input:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.15);
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                    <h1 class="h3 mb-1 fw-bold">Add New Testimonial</h1>
                    <p class="text-muted mb-0">Create a new client testimonial.</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="author_name" class="form-label">Author Name <span class="text-danger">*</span></label>
                            <input type="text" name="author_name" id="author_name" class="form-control @error('author_name') is-invalid @enderror" value="{{ old('author_name') }}" placeholder="e.g. Jane Doe" required autofocus>
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="author_role" class="form-label">Author Role</label>
                                <input type="text" name="author_role" id="author_role" class="form-control @error('author_role') is-invalid @enderror" value="{{ old('author_role') }}" placeholder="e.g. Product Manager">
                                @error('author_role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="author_company" class="form-label">Author Company</label>
                                <input type="text" name="author_company" id="author_company" class="form-control @error('author_company') is-invalid @enderror" value="{{ old('author_company') }}" placeholder="e.g. Acme Inc.">
                                @error('author_company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="What did they say about your work?" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="avatar_path" class="form-label">Avatar</label>
                            <input type="file" name="avatar_path" id="avatar_path" class="form-control @error('avatar_path') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Optional. Max 2MB. JPG, PNG, WEBP or GIF.</div>
                            @error('avatar_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ (int) old('rating', 5) === $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                                <div class="form-text">Lower numbers appear first.</div>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" @checked(old('is_active', true))>
                            <label class="form-check-label" for="is_active">Active <span class="text-muted small">(visible on site)</span></label>
                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-gold">
                                <i class="bi bi-check-lg me-1"></i> Create Testimonial
                            </button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
