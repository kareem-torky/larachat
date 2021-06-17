@extends('layouts.main')

@section('main')
<div class="row">
    <div class="col-md-4">
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;">
            <a href="{{ route('home.index') }}" class="d-flex align-items-center flex-shrink-0 py-3 link-dark text-decoration-none border-bottom">
                <span class="fs-5 fw-semibold">Chat rooms</span>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
                <a href="{{ route('room.public.get') }}" class="list-group-item list-group-item-action py-3 lh-tight">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">*** Public ***</strong>
                    </div>
                    <div class="col-10 mb-1 small">placeholder for last message ...</div>
                </a>

                @forelse ($rooms as $room)
                    <a href="{{ route('room.private.get', $room->id) }}" class="list-group-item list-group-item-action py-3 lh-tight">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{ $room->getRecipientForAuthId()->name }}</strong>
                        </div>
                        <div class="col-10 mb-1 small">placeholder for last message ...</div>
                    </a>
                @empty
                    <p>You have no rooms yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
            <a href="#" class="d-flex align-items-center flex-shrink-0 py-3 link-dark text-decoration-none border-bottom disabled">
                <span class="fs-5 fw-semibold">User suggestions</span>
            </a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('room.private.start', $user->id) }}" class="btn btn-sm btn-primary">Start chat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection