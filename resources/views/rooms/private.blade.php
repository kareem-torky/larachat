@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a href="#" class="d-flex align-items-center flex-shrink-0 py-3 link-dark text-decoration-none">
                <span class="fs-5 fw-semibold">Room with {{ $recipient->name }}</span>
            </a>

            <div id="message-box">

            </div>

            <form id="message-form">
                @csrf
                <textarea name="message" class="form-control mb-3" placeholder="Your message here ..."></textarea>

                <input type="submit" class="btn btn-primary" value="send">
            </form>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        let authUserName = '{{ $user->name }}'

        Echo.private(`private-room-{{ $room->id }}`)
        .listen('PrivateMessageSent', (e) => {
            if (e.sender.name == authUserName) {
                $('#message-box').append(`<p class='bg-primary rounded w-75 me-auto text-light p-3'>${e.message}</p>`)
            } else {
                $('#message-box').append(`<p class='bg-light rounded w-75 ms-auto p-3'>${e.message}</p>`)
            }
        });

        let roomPrivateSendRoute = "{{ route('room.private.send', $room->id) }}"

        $('#message-form').submit(function(e) {
            e.preventDefault()

            let formData = new FormData($('#message-form')[0])

            axios.post(roomPrivateSendRoute, formData)
            .then(function() {
                $('#message-form').trigger("reset")
            })
        })
    </script>
@endsection