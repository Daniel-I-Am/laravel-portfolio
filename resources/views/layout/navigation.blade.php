<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    @foreach(config('portfolio.pages', [['route' => 'index', 'name' => 'portfolio.home']]) as $page)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route($page['route']) }}">{{ __($page['name']) }} @if(url()->current() === route($page['route']))<span class="sr-only">(current)</span>@endif</a>
        </li>
    @endforeach
</ul>
