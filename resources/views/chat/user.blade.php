@extends('layouts.main')

@section('main')
<div class="row">
    <div class="col-md-8 py-5">
        <div class="mb-3">
            <div class="text-center">
                <a href="{{ route('chat.start', $user->id) }}" class="btn btn-primary">Start Chat with {{ $user->name }}</a>
            </div>
        </div>
    </div>
</div>

@endsection