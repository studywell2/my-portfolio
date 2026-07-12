@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- Hero Section --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-house me-2"></i>Hero Section</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Site Name</label>
                            <input type="text" class="form-control" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hero Title (Your Name)</label>
                            <input type="text" class="form-control" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hero Subtitle</label>
                            <input type="text" class="form-control" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Typing Words (comma separated)</label>
                            <input type="text" class="form-control" name="typing_words" value="{{ old('typing_words', isset($settings['typing_words']) ? implode(', ', json_decode($settings['typing_words'], true) ?? []) : '') }}" placeholder="Full-Stack Developer, Laravel Expert, Project Manager">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hero Avatar</label>
                            <input type="file" class="form-control" name="hero_avatar" accept="image/*">
                            @if (isset($settings['hero_avatar']) && $settings['hero_avatar'])
                                @php
                                    $adminAvatarUrl = str_starts_with($settings['hero_avatar'], 'http') || str_starts_with($settings['hero_avatar'], '/')
                                        ? $settings['hero_avatar']
                                        : (file_exists(public_path('storage/' . $settings['hero_avatar']))
                                            ? asset('storage/' . $settings['hero_avatar'])
                                            : asset($settings['hero_avatar']));
                                @endphp
                                <div class="mt-2">
                                    <img src="{{ $adminAvatarUrl }}" alt="Avatar" class="rounded-circle" style="width:60px;height:60px;object-fit:cover">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Current Role</label>
                            <input type="text" class="form-control" name="current_role" value="{{ old('current_role', $settings['current_role'] ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-person me-2"></i>About Section</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Biography</label>
                        <textarea class="form-control" name="about_bio" rows="8">{{ old('about_bio', $settings['about_bio'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-contact me-2"></i>Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $settings['email'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" placeholder="+2348000000000">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="{{ old('location', $settings['location'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GitHub URL</label>
                            <input type="url" class="form-control" name="github_url" value="{{ old('github_url', $settings['github_url'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">LinkedIn URL</label>
                            <input type="url" class="form-control" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-bar-chart me-2"></i>Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <label class="form-label">Projects Completed</label>
                            <input type="number" class="form-control" name="stat_projects" value="{{ old('stat_projects', $settings['stat_projects'] ?? 0) }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Happy Clients</label>
                            <input type="number" class="form-control" name="stat_clients" value="{{ old('stat_clients', $settings['stat_clients'] ?? 0) }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Years Experience</label>
                            <input type="number" class="form-control" name="stat_experience" value="{{ old('stat_experience', $settings['stat_experience'] ?? 0) }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Technologies</label>
                            <input type="number" class="form-control" name="stat_technologies" value="{{ old('stat_technologies', $settings['stat_technologies'] ?? 0) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Calculator Pricing --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-calculator me-2"></i>Calculator Pricing</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Set the base prices for each project type and extra feature. These values are used by the cost calculator on your portfolio.</p>

                    <h6 class="fw-bold mb-3 text-gradient-gold">Project Type Base Prices</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-4">
                            <label class="form-label">Landing Page</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_base_landing" value="{{ old('calc_base_landing', $settings['calc_base_landing'] ?? 50000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label">Business Website</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_base_business" value="{{ old('calc_base_business', $settings['calc_base_business'] ?? 80000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label">School Website</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_base_school" value="{{ old('calc_base_school', $settings['calc_base_school'] ?? 150000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label">E-commerce</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_base_ecommerce" value="{{ old('calc_base_ecommerce', $settings['calc_base_ecommerce'] ?? 200000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label">Web Application</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_base_webapp" value="{{ old('calc_base_webapp', $settings['calc_base_webapp'] ?? 300000) }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 text-gradient-gold">Page Pricing</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-6">
                            <label class="form-label">Cost Per Extra Page</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_per_page" value="{{ old('calc_per_page', $settings['calc_per_page'] ?? 10000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <label class="form-label">Pages Included in Base</label>
                            <input type="number" class="form-control" name="calc_included_pages" value="{{ old('calc_included_pages', $settings['calc_included_pages'] ?? 5) }}" min="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 text-gradient-gold">Extra Feature Prices</h6>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <label class="form-label">SEO Optimization</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_seo" value="{{ old('calc_feat_seo', $settings['calc_feat_seo'] ?? 20000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Payment Gateway</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_payment" value="{{ old('calc_feat_payment', $settings['calc_feat_payment'] ?? 30000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">User Authentication</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_auth" value="{{ old('calc_feat_auth', $settings['calc_feat_auth'] ?? 25000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Admin Dashboard</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_dashboard" value="{{ old('calc_feat_dashboard', $settings['calc_feat_dashboard'] ?? 40000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">API Integration</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_api" value="{{ old('calc_feat_api', $settings['calc_feat_api'] ?? 35000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Live Chat</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_chat" value="{{ old('calc_feat_chat', $settings['calc_feat_chat'] ?? 15000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Content Management (CMS)</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_cms" value="{{ old('calc_feat_cms', $settings['calc_feat_cms'] ?? 35000) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Email Setup</label>
                            <div class="input-group">
                                <span class="input-group-text">&#8358;</span>
                                <input type="number" class="form-control" name="calc_feat_email" value="{{ old('calc_feat_email', $settings['calc_feat_email'] ?? 15000) }}" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CV Upload --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2"></i>CV Upload</h6>
                </div>
                <div class="card-body">
                    <label class="form-label">Upload CV (PDF, DOC, DOCX - max 5MB)</label>
                    <input type="file" class="form-control" name="cv_path" accept=".pdf,.doc,.docx">
                    @if (isset($settings['cv_path']) && $settings['cv_path'])
                        <div class="mt-2">
                            <a href="{{ route('download.cv') }}" class="text-decoration-none" style="color:#d4af37">
                                <i class="bi bi-download me-1"></i>Download Current CV
                            </a>
                        </div>
                    @else
                        <small class="text-muted">No CV uploaded yet.</small>
                    @endif
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="col-12">
            <button type="submit" class="btn btn-gold px-4">
                <i class="bi bi-check-lg me-1"></i>Save Settings
            </button>
        </div>
    </div>
</form>
@endsection
