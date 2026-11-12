@extends('admin.layout')

@section('title', 'Contact Inquiries')
@section('page_title', 'Inquiries & Messages')

@section('content')
  <div class="admin-card">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">Inbox ({{ $messages->total() }})</h2>
        <p style="color: var(--admin-muted); font-size: 0.875rem;">Messages submitted via the contact form on Bijuys.</p>
      </div>
    </div>

    <div class="table-responsive">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Status</th>
            <th>Date & Time</th>
            <th>Sender Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($messages as $msg)
            <tr style="{{ !$msg->is_read ? 'background-color: rgba(99, 102, 241, 0.05); font-weight: 600;' : '' }}">
              <td>
                @if(!$msg->is_read)
                  <span class="badge-pill badge-primary">Unread</span>
                @else
                  <span class="badge-pill" style="background-color: rgba(148, 163, 184, 0.15); color: var(--admin-muted);">Read</span>
                @endif
              </td>
              <td><span style="font-size: 0.825rem; color: var(--admin-muted);">{{ $msg->created_at->format('M d, Y h:i A') }}</span></td>
              <td>{{ $msg->name }}</td>
              <td><a href="mailto:{{ $msg->email }}" style="color: var(--admin-primary); text-decoration: none;">{{ $msg->email }}</a></td>
              <td>{{ Str::limit($msg->subject, 32) }}</td>
              <td style="text-align: right;">
                <div style="display: inline-flex; gap: 0.5rem;">
                  <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-secondary btn-sm">Read</a>
                  <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; color: var(--admin-muted); padding: 3rem;">
                No messages received yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($messages->hasPages())
      <div style="margin-top: 1.5rem;">
        {{ $messages->links() }}
      </div>
    @endif
  </div>
@endsection
