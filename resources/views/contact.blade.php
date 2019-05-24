@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-xl-9 col-12">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_form.title') }}</h2>
                    <div class="content">
                        <form action="{{ route('contact-form.store') }}" method="post">
                            @csrf
                            <input-field
                                id="email_input"
                                name="email"
                                placeholder="{{ __('portfolio.contact_form.email.placeholder') }}"
                                popover-title="{{ __('portfolio.contact_form.email.popover_title') }}"
                                popover-content="{!! __('portfolio.contact_form.email.popover_content') !!}"
                                label="{{ __('portfolio.contact_form.email.label') }}"
                                icon-class="{{ __('portfolio.contact_form.email.icon') }}"
                                validation="email"
                            ></input-field>
                            <input-field
                                id="name_input"
                                name="name"
                                placeholder="{{ __('portfolio.contact_form.name.placeholder') }}"
                                popover-title="{{ __('portfolio.contact_form.name.popover_title') }}"
                                popover-content="{!! __('portfolio.contact_form.name.popover_content') !!}"
                                label="{{ __('portfolio.contact_form.name.label') }}"
                                icon-class="{{ __('portfolio.contact_form.name.icon') }}"
                            ></input-field>
                            <input-field
                                id="message_input"
                                name="message"
                                placeholder="{{ __('portfolio.contact_form.message.placeholder') }}"
                                label="{{ __('portfolio.contact_form.message.label') }}"
                                icon-class="{{ __('portfolio.contact_form.message.icon') }}"
                                v-bind:is-text-area="true"
                                v-bind:text-area-cols="30"
                                v-bind:text-area-rows="10"
                            ></input-field>
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
            <div class="card-item-outer col-xl-3 col-12">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_details') }}</h2>
                    <div class="content">
                        <ul class="list-unstyled">
                            <li>Daniel de Cloet</li>
                            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ __('portfolio.author.email') }}">{{ __('portfolio.author.email') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
