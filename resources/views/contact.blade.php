@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-9">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_form.title') }}</h2>
                    <div class="content">
                        <form action="{{ route('contact-form.store') }}">
                            <div class="form-group">
                                <label for="email_input">{{ __('portfolio.contact_form.email.label') }}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{!! __('portfolio.contact_form.email.icon') !!}</div>
                                    </div>
                                    <input type="email" class="form-control" id="email_input" placeholder="{{ __('portfolio.contact_form.email.placeholder') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name_input">{{ __('portfolio.contact_form.name.label') }}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{!! __('portfolio.contact_form.name.icon') !!}</div>
                                    </div>
                                    <input type="text" class="form-control" id="name_input" placeholder="{{ __('portfolio.contact_form.name.placeholder') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message_input">{{ __('portfolio.contact_form.message.label') }}</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{!! __('portfolio.contact_form.message.icon') !!}</div>
                                    </div>
                                    <textarea name="message" id="message_input" cols="30" rows="10" class="form-control" placeholder="{{ __('portfolio.contact_form.message.placeholder')  }}"></textarea>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">{!! __('portfolio.contact_form.submit.icon') !!}</div>
                                </div>
                                <input type="submit" class="form-control" id="name_input" value="{{ __('portfolio.contact_form.submit.value') }}">
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