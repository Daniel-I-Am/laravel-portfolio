@extends('errors.base_error')

@section('error_message')
    Helaas konden wij deze pagina niet vinden.
@endsection

@section('what_now')
    <p>
        Snel naar:
    </p>
    <ul>
        @if(url()->previous() != url()->current())
            <li><a href="{{ url()->previous() }}">{{ __('portfolio.page_previous') }}</a></li>
        @endif
        <li><a href="{{ route('index') }}">{{ __('portfolio.home') }}</a></li>
        <li><a href="{{ route('profile') }}">{{ __('portfolio.profile') }}</a></li>
        <li><a href="{{ route('dashboard') }}">{{ __('portfolio.dashboard') }}</a></li>
    </ul>
    <p>Hulp nodig? <a href="{{ route('contact') }}">Neem contact op!</a></p>
@endsection