@extends('layouts.main')

@section('main')
<div class="row">
    <div class="col-md-4">
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <a href="{{ route("chat.index") }}" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <span class="fs-5 fw-semibold">Chats</span>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
                @foreach ($users as $user)
                    <a href="{{ route('chat.index') . "?recipient=" . $user->id }}" class="list-group-item list-group-item-action @if($recipientId == $user->id) active @endif py-3 lh-tight" @if($recipientId == $user->id) aria-current="true" @endif>
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ $user->name }}</strong>
                            <small>Wed</small>
                        </div>
                        <div class="col-10 mb-1 small">Some placeholder content in a paragraph below the heading and date.</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @if ($recipientId)
        <div class="col-md-8 py-5">
            <div class="mb-3">
                @if($channel)
                    <textarea class="form-control" id="message-box" rows="3" placeholder="Type message here ..."></textarea>
                @else
                    <div class="text-center">
                        <a href="{{ route('chat.start') . "?recipient=$recipientId" }}" class="btn btn-primary">Start Chat</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

@endsection