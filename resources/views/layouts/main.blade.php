<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Larachat</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @yield('page-styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home.index') }}">Larachat</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#">{{ auth()->user()->name }}</a>
                  </li>
                  <li class="nav-item">
                    <a id="logout-btn" class="nav-link" href="#">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <div class="container-fluid">
            @yield('main')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            let logoutRoute = '{{ route("logout") }}'

            $('#logout-btn').click(function(e) {
                e.preventDefault()
                axios.post(logoutRoute)
                window.location.href = ''
            })
        </script>

        @yield('page-scripts')
    </body>
</html>
