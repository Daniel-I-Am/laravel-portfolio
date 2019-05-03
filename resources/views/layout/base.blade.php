<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Portfolio')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
</head>
<body>
    @include('layout.header')
    <div id="app">
        @yield('body')
    </div>
    @if($errors->any() || session()->exists('success_message'))
        <div class="position-fixed col-lg-4 col-6" style="right: 1em; bottom: 3em;">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endforeach
            @elseif(session()->exists('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->pull('success_message') }}
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
        </div>
    @endif
    @include('layout.footer')
</body>
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</html>
