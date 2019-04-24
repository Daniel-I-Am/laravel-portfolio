@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-12">
                <div class="card-item">
                    <h2 class="title">Foutmelding</h2>
                    <div class="content">
                        <p class="content">
                            @yield('error_message', __('portfolio.errors.default.error'))
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
                        @section('tips')
                            {!! __('portfolio.errors.default.tips') !!}
                        @show
                        @yield('what_now')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection