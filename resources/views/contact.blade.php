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
                                placeholder="user@example.com"
                                popover-title="Voer een geldige email in"
                                popover-content="Een e-mailadres moet een enkel @ teken hebben en eindigen op een domein (example.com).<br>Example: user@example.com"
                                label="Voer het e-mailadres in waar wij u kunnen bereiken."
                                icon-class="fas fa-envelope"
                                validation="email"
                            ></input-field>
                            <input-field
                                id="name_input"
                                name="name"
                                placeholder="Voer uw naam in"
                                popover-title="Voer uw naam in"
                                popover-content="De naam waar u graag mee angesproken wilt worden."
                                label="Voer uw naam in"
                                icon-class="fas fa-user"
                            ></input-field>
                            <input-field
                                id="message_input"
                                name="message"
                                placeholder="Voer hier uw bericht in"
                                label="Feedback"
                                icon-class="fas fa-comment"
                                is-text-area="true"
                                text-area-cols="30"
                                text-area-rows="10"
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
