<form action="{{ route('notification.show', ['id' => $notification->id]) }}" method="post">
    @csrf
    <button class="dropdown-item list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $notification->data["title"] }}</h5>
            <small class="text-muted">{{ $notification->created_at->fromNow() }}</small>
        </div>
        <small class="text-muted">{{ $notification->data['subtitle'] }}</small>
        <p class="mb-1">{!! str_limit($notification->data['description']) !!}</p>
    </button>
</form>
