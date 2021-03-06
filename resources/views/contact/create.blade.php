@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="card-item-outer col-xl-9 col-12">
                <div class="card-item">
                    <h2 class=title>{{ __('portfolio.contact_form.title') }}</h2>
                    <div class="content">
                        <form action="{{ route('contact-form.store') }}" method="post" id="contact_form">
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
                                v-bind:required="true"

                                @if(old('email'))
                                value="{{ old('email') }}"
                                @endif
                                @if(sizeof($errors->default->get('email')) !== 0)
                                v-bind:error_messages="{{json_encode($errors->default->get('email'))}}"
                                @endif
                            ></input-field>
                            <input-field
                                id="name_input"
                                name="name"
                                placeholder="{{ __('portfolio.contact_form.name.placeholder') }}"
                                popover-title="{{ __('portfolio.contact_form.name.popover_title') }}"
                                popover-content="{!! __('portfolio.contact_form.name.popover_content') !!}"
                                label="{{ __('portfolio.contact_form.name.label') }}"
                                icon-class="{{ __('portfolio.contact_form.name.icon') }}"
                                v-bind:required="true"

                                @if(old('name'))
                                value="{{ old('name') }}"
                                @endif
                                @if(sizeof($errors->default->get('name')) !== 0)
                                v-bind:error_messages="{{json_encode($errors->default->get('name'))}}"
                                @endif
                            ></input-field>
                            <input-field
                                id="message_input"
                                name="message"
                                placeholder="{{ __('portfolio.contact_form.message.placeholder') }}"
                                label="{{ __('portfolio.contact_form.message.label') }}"
                                icon-class="{{ __('portfolio.contact_form.message.icon') }}"
                                validation="message"
                                v-bind:required="true"
                                v-bind:is-text-area="true"
                                v-bind:text-area-cols="30"
                                v-bind:text-area-rows="10"

                                @if(old('message'))
                                value="{{ old('message') }}"
                                @endif
                                @if(sizeof($errors->default->get('message')) !== 0)
                                v-bind:error_messages="{{json_encode($errors->default->get('message'))}}"
                                @endif
                            ></input-field>
                            <p>Velden met een<span class="required-input-field"></span> zijn verplicht.</p>
                            <input-field
                                id="submit_button"
                                type="submit"
                                value="{{ __('portfolio.contact_form.submit.value') }}"
                                icon-class="{{ __('portfolio.contact_form.submit.icon') }}"
                                validation="none"
                                v-bind:should-validate="false"
                            ></input-field>
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
