@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Messages</h4>
    <div class="btn-group">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm {{ request()->has('filter') ? 'btn-outline-secondary' : 'btn-gold' }}">All</a>
        <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="btn btn-sm {{ request('filter') === 'unread' ? 'btn-gold' : 'btn-outline-secondary' }}">Unread</a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 admin-table-mobile">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td data-label="Name" class="fw-{{ $message->is_read ? 'normal' : 'bold' }}">
                                {{ $message->name }}
                                @if (!$message->is_read) <span class="badge bg-danger ms-1">New</span> @endif
                            </td>
                            <td data-label="Email">{{ $message->email }}</td>
                            <td data-label="Subject" class="text-truncate" style="max-width:200px">{{ $message->subject ?: '—' }}</td>
                            <td data-label="Date">{{ $message->created_at->diffForHumans() }}</td>
                            <td data-label="Status">
                                @if ($message->is_read)
                                    <span class="badge bg-secondary">Read</span>
                                @else
                                    <span class="badge bg-danger">Unread</span>
                                @endif
                            </td>
                            <td data-label="Actions" class="text-end">
                                <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="d-inline" onsubmit="return confirm('Delete this message?')">
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
                            <td colspan="6" class="text-center text-muted py-4">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $messages->withQueryString()->links() }}
</div>
@endsection
