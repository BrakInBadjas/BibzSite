<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{{__('layout/general.navigation_toggle')}}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('index') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{ Request::path() == 'home' ? 'active' : ''}}"><a href="{{ route('home') }}">Home</a></li>
                @if (Auth::check())
                    <li class="dropdown {{ (strpos(Request::path(), 'adtjes') !== false) ? 'active' : ''}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{__('models/adtje.title')}}
                            @if(($count = Adtje::where('user_id', Auth::user()->id)->open()->count()) > 0)
                                <span class="badge">{{$count}}</span>
                            @endif
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('adtjes.index') }}">{{__('models/adtje.title')}}</a></li>
                            <li><a href="{{ route('adtjes.create') }}">{{__('models/adtje.add')}}</a></li>
                            <li><a href="{{ route('adtjes.validate') }}">{{__('models/adtje.check')}} <span class="badge">{{Adtje::shouldVote()->count()}}</span></a></li>
                        </ul>
                    </li>

                    <li class="dropdown {{ (strpos(Request::path(), 'quotes') !== false) ? 'active' : ''}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{__('models/quote.title')}} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('quotes.index') }}">{{__('models/quote.title')}}</a></li>
                            <li><a href="{{ route('quotes.create') }}">{{__('models/quote.add')}}</a></li>
                        </ul>
                    </li>

                <li class="dropdown {{ (strpos(Request::path(), 'buddies') !== false) ? 'active' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{__('models/drinking_buddies.title')}} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('buddies.index') }}">{{__('models/drinking_buddies.title')}}</a></li>
                        <li><a href="{{ route('buddies.create') }}">{{__('models/drinking_buddies.add')}}</a></li>
                    </ul>
                </li>


                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{__('auth/general.login')}}</a></li>
                    <li><a href="{{ route('register') }}">{{__('auth/general.register')}}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('profile.show', ['id' => Auth::user()->id])}}"><i class="fa fa-btn  fa-user fa-fw" aria-hidden="true"></i>
                                    Profiel
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a id="open-bug-report" data-toggle="modal" data-target="#bug-report-modal"><i class="fa fa-btn  fa-bug fa-fw" aria-hidden="true"></i>
                                    Report Bug
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fa fa-btn  fa-sign-out fa-fw" aria-hidden="true"></i>
                                    {{__('auth/general.logout')}}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
