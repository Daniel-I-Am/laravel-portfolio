@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-12">
                <div class="card-item">
                    <h2 class="title">Foutmelding</h2>
                    <div class="content">
                        <p class="content">
                            @yield('error_message', 'Helaas konden wij deze pagina niet vinden.')
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-item-outer col-12">
                <div class="card-item">
                    <h2 class="title">Wat nu?</h2>
                    <div class="content">
                        @yield('what_now')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection