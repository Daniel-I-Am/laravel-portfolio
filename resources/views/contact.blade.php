@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-9">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_form') }}</h2>
                    <div class="content">
                        <form action="{{ route('contact-form.store') }}">
                            <div class="form-group">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-item-outer col-3">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_details') }}</h2>
                    <div class="content">
                        <ul class="list-unstyled ml-4">
                            <li>Daniel de Cloet</li>
                            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ __('portfolio.author.email') }}">{{ __('portfolio.author.email') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection