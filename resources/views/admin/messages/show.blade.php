@extends('admin.layout')

@section('title', 'Inquiry from ' . $message->name)
@section('page_title', 'Inquiry Details')

@section('topbar_actions')
  <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">&larr; Back to Inbox</a>
@endsection

@section('content')
  <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card-header">
      <div>
        <h2 class="admin-card-title">{{ $message->subject }}</h2>
        <span style="font-size: 0.85rem; color: var(--admin-muted);">
          Received on {{ $message->created_at->format('F d, Y \a\t h:i A') }} ({{ $message->created_at->diffForHumans() }})
        </span>
      </div>

      <div style="display: flex; gap: 0.5rem;">
        <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-secondary btn-sm">
            {{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}
          </button>
        </form>

        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
      </div>
    </div>

    <!-- Sender Details -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; background-color: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1.25rem; margin-bottom: 1.5rem;">
      <div>
        <span style="font-size: 0.785rem; text-transform: uppercase; color: var(--admin-muted); display: block; margin-bottom: 0.25rem;">Sender Name</span>
        <strong style="font-size: 1.05rem;">{{ $message->name }}</strong>
      </div>

      <div>
        <span style="font-size: 0.785rem; text-transform: uppercase; color: var(--admin-muted); display: block; margin-bottom: 0.25rem;">Email Address</span>
        <a href="mailto:{{ $message->email }}" style="color: var(--admin-primary); font-size: 1.05rem; text-decoration: none;">{{ $message->email }}</a>
      </div>
    </div>

    <!-- Message Content -->
    <div style="margin-bottom: 2rem;">
      <h3 style="font-size: 0.875rem; text-transform: uppercase; color: var(--admin-muted); letter-spacing: 0.05em; margin-bottom: 0.75rem;">Message Body</h3>
      <div style="background-color: var(--admin-bg); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1.5rem; font-size: 1rem; line-height: 1.7; white-space: pre-wrap;">{{ $message->message }}</div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--admin-border); padding-top: 1.5rem;">
      <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">&larr; Back to Inquiries</a>
      <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: ' . $message->subject) }}" class="btn btn-primary">
        Reply via Email &rarr;
      </a>
    </div>
  </div>
@endsection
