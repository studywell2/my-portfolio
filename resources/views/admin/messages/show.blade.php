@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Message Details</h4>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Messages
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="text-muted small text-uppercase fw-600 mb-1">From</div>
                <div class="fs-5 fw-bold">{{ $message->name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase fw-600 mb-1">Email</div>
                <a href="mailto:{{ $message->email }}" class="text-decoration-none" style="color:#d4af37">{{ $message->email }}</a>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase fw-600 mb-1">Subject</div>
                <div class="fs-6">{{ $message->subject ?: '—' }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small text-uppercase fw-600 mb-1">Date</div>
                <div class="fs-6">{{ $message->created_at->format('M d, Y \a\t h:i A') }}</div>
            </div>
        </div>

        <hr style="border-color:#2a2a2a">

        <div class="mb-4">
            <div class="text-muted small text-uppercase fw-600 mb-2">Message</div>
            <div class="p-3 rounded" style="background:#121212;border:1px solid #2a2a2a">
                {{ $message->message }}
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-gold">
                <i class="bi bi-reply me-1"></i>Reply via Email
            </a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
