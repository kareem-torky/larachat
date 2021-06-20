@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a href="#" class="d-flex align-items-center flex-shrink-0 py-3 link-dark text-decoration-none">
                <span class="fs-5 fw-semibold">Public room</span>
            </a>

            <form id="message-form">
                @csrf
                <textarea name="message" class="form-control mb-3" placeholder="Your message here ..."></textarea>

                <input type="submit" class="btn btn-primary mb-3" value="send">
            </form>

            <div id="message-box">
                @foreach ($latestMessages as $message)
                    @if($message->user_id == $user->id)
                        <p class='bg-primary rounded w-75 me-auto text-light p-3'>{{ $message->content }}</p>
                    @else
                        <p class='bg-light rounded w-75 ms-auto p-3'>{{ $message->user->name }}: {{ $message->content }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let authUserName = '{{ $user->name }}'

        Echo.private(`public-room`)
        .listen('PublicMessageSent', (e) => {
            if (e.sender.name == authUserName) {
                $('#message-box').prepend(`<p class='bg-primary rounded w-75 me-auto text-light p-3'>${e.message}</p>`)
            } else {
                $('#message-box').prepend(`<p class='bg-light rounded w-75 ms-auto p-3'>${e.sender.name}: ${e.message}</p>`)
            }
        });

        let roomPublicSendRoute = "{{ route('room.public.send') }}"

        $('#message-form').submit(function(e) {
            e.preventDefault()

            let formData = new FormData($('#message-form')[0])
            axios.post(roomPublicSendRoute, formData)
            .then(function() {
                $('#message-form').trigger("reset")
            })
        })
    </script>
@endsection