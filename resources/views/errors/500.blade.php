@extends('errors.base_error')

@section('status_code', 500)

@section('error_message')
    {!! __('portfolio.errors.404.error') !!}
@endsection

@section('tips')
    @if(__('portfolio.errors.404.tips') != 'portfolio.errors.404.tips')
        <p>{!! __('portfolio.errors.404.tips') !!}</p>
    @endif
@endsection

@section('what_now')
    <ul>
        @if(url()->previous() != url()->current())
            <li><a href="{{ url()->previous() }}">{{ __('portfolio.page_previous') }}</a></li>
        @endif
        <li><a href="{{ route('index') }}">{{ __('portfolio.home') }}</a></li>
        <li><a href="{{ route('profile') }}">{{ __('portfolio.profile') }}</a></li>
        <li><a href="{{ route('dashboard') }}">{{ __('portfolio.dashboard') }}</a></li>
    </ul>
    <p>{{ __('portfolio.need_help') }}? <a href="{{ route('contact') }}">{{ __('portfolio.contact_us') }}!</a></p>
@endsection
