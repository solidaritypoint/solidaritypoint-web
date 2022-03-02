<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('welcome', ['locale' => app()->getLocale()])}}">
            <img src="{{asset('storage/sp-logo.png')}}" alt="" width="30" height="25">
            SolidarityPoint
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    @auth
                        <a class="nav-link" aria-current="page"
                           href="{{route(auth()->user()->role.'.home', ['locale' => app()->getLocale()])}}">{{__('navigation.home')}}</a>
                    @else
                        <a class="nav-link" aria-current="page" href="#">{{__('navigation.home')}}</a>
                    @endauth
                </li>
                @auth
                    @switch(auth()->user()->role)
                        @case('driver')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                               aria-expanded="false">Dovozy</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                       href="{{route('driver.locations', ['locale' => app()->getLocale()])}}">{{__('navigation.locations')}}</a>
                                </li>
                                <li><a class="dropdown-item"
                                       href="{{route('driver.offered_rides', ['locale'=> app()->getLocale()])}}">{{__('navigation.offered_rides')}}</a>
                                </li>
                            </ul>
                        </li>
                        @break
                        @case('quartermaster')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                               aria-expanded="false">{{__('navigation.accommodations')}}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                       href="#">{{__('navigation.my_accommodations_offers')}}</a></li>
                                <li><a class="dropdown-item"
                                       href="#">{{__('navigation.accommodations_request')}}</a></li>
                                <li><a class="dropdown-item" href="#">{{__('navigation.equipment_request')}}</a>
                                </li>
                            </ul>
                        </li>
                        @break
                    @endswitch
                @endauth
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-expanded="false">{{__('navigation.profile')}}</a>
                        <ul class="dropdown-menu" style="right: 0; left: unset">
                            <li><a class="dropdown-item" href="#">{{__('navigation.edit_profile')}}</a></li>
                            <li>
                                <form method="post" action="{{route('logout', ['locale' => app()->getLocale()])}}">
                                    @csrf
                                    <button class='dropdown-item' type="submit">{{__('navigation.logout')}}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown" style="right: 0; left: unset">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-expanded="false">{{__('navigation.register')}}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                   href="{{route('register.driver', ['locale' => app()->getLocale()])}}">{{__('navigation.register_driver')}}</a>
                            </li>
                            <li><a class="dropdown-item"
                                   href="{{route('register.refugee',['locale' => app()->getLocale()])}}">{{__('navigation.register_refugee')}}</a>
                            </li>
                            <li><a class="dropdown-item" href="{{route('register.quartermaster', ['locale' => app()->getLocale()])}}">{{__('navigation.register_quartermaster')}}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('login', ['locale' => app()->getLocale()])}}">{{__('navigation.login')}}</a>
                    </li>
                @endauth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-expanded="false">{{__('navigation.language')}}</a>
                    <ul class="dropdown-menu"  style="right: 0; left: unset">
                        <li><a class="dropdown-item" href="/en/welcome">{{__('navigation.language_en')}}</a></li>
                        <li><a class="dropdown-item" href="/cs/welcome">{{__('navigation.language_cs')}}</a></li>
                        <li><a class="dropdown-item" href="/pl/welcome">{{__('navigation.language_pl')}}</a></li>
                        <li><a class="dropdown-item" href="/sk/welcome">{{__('navigation.language_sk')}}</a></li>
                        <li><a class="dropdown-item" href="/hu/welcome">{{__('navigation.language_hu')}}</a></li>
                        <li><a class="dropdown-item" href="/ro/welcome">{{__('navigation.language_ro')}}</a></li>
                        <li><a class="dropdown-item" href="/de/welcome">{{__('navigation.language_de')}}</a></li>
                        <li><a class="dropdown-item" href="/ua/welcome">{{__('navigation.language_ua')}}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
