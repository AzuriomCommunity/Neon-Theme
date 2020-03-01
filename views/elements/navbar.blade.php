<nav class="navbar navbar-expand-md navbar-dark text-uppercase" style="border: 2px solid #dadada;
    border-radius: 7px; outline: none;
    border-color: #A61EFF;
    box-shadow: 0 0 10px #A61EFF;">
    <div class="container">
        <a class="navbar-brand mr-4" href="{{ route('home') }}">
            @if(setting('logo'))
                <img src="{{ image_url(setting('logo')) }}" alt="Logo">
            @else
                {{ site_name() }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach($navbar as $element)
                    @if(!$element->isDropdown())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $element->name }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown{{ $element->id }}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $element->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                @foreach($element->elements as $childElement)
                                    <a class="dropdown-item" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if(Route::has('register'))
                        <a class="btn btn-success mx-1 my-2" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                    @endif
                    <a class="btn btn-outline-light mx-1 my-2" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                @else
                    <li class="nav-item dropdown">
                        <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                {{ trans('messages.nav.profile') }}
                            </a>

                            @if(Auth::user()->hasAdminAccess())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    {{ trans('messages.nav.admin') }}
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ trans('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                @if(config('theme.discord-invite'))
                <li class="nav-item dropdown" style="color: #FFF;">
                        <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ trans('theme::neon.config.resaux') }}<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @if(config('theme.twitter'))        
                            
                            <a href="https://twitter.com/{{ config('theme.twitter') }}" class="dropdown-item" style="float: left;" target="blank" style="">Twitter</a>
                            
                        @endif
                        @if(config('theme.discord-invite'))
                            <a href="{{ config('theme.discord-invite') }}" class="dropdown-item" style="float: left;" target="blank" style="">Discord</a>
                        @endif
                        @if(config('theme.ts'))
                            <a href="ts3server://{{ config('theme.ts') }}" class="dropdown-item" style="float: left;">TeamSpeak</a>
                        @endif
                        @if(config('theme.youtube'))
                            <a href="https://www.youtube.com/channel/{{ config('theme.youtube') }}" target="blank" class="dropdown-item" style="float: left;">Youtube</a>
                        @endif

                        </div>
                    </li>
                @endif
            </div>
        </div>
    </div>
</nav>
