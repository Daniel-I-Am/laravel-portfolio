<footer class="page-footer font-small cyan darken-3">
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center">
                    @foreach(config('portfolio.social', [['link' => 'https://www.github.com/Daniel-I-Am', 'icon' => 'fab fa-github']]) as $social)
                        <a href="{{ $social['link'] }}" class="social-button mx-2">
                            <i class="{{ $social['icon'] }} fa-3x"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-right py-3 pr-4">&copy; {{ \Carbon\Carbon::today()->year }} Copyright:
        {{ __('portfolio.author.name') }}
    </div>
</footer>
