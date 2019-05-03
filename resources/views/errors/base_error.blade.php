@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <div class="card-item-outer">
                    <div class="card-item">
                        <h2 class="title">Foutmelding</h2>
                        <div class="content">
                            <p class="content">
                                @section('error_message')
                                    {!! __('portfolio.errors.default.error') !!}
                                @show
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-item-outer">
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
            <div class="card-item-outer col-xl-5 text-xl-left text-center">
                <p style="font-size: 20em;">@yield('status_code', 721)</p>
            </div>
        </div>
    </div>
@endsection
