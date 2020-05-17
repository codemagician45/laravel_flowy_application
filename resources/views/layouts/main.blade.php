<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{config("app.name")}} - @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}?v={{Cache::get('JsCssVersion', '1')}}" defer></script>
        @if($vue ?? false) <script src="{{ asset('js/vue.js') }}?v={{Cache::get('JsCssVersion', '1')}}" defer></script> @endif

        <!-- CSS -->
        <link href="{{ asset('css/base.css') }}?v={{Cache::get('JsCssVersion', '1')}}" rel="stylesheet">

    </head>
    <body>

    {{-- afterBody --}}
    @stack('afterBody')

    <!-- Header -->
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

        <div class="app-header header-shadow">

            <div class="app-header__logo">
                <div class="logo-src"></div>
            </div>

            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="app-header__content">
                <div class="app-header-left"></div>
                <div class="app-header-right">

                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">

                                <div class="widget-content-left header-user-info">
                                    <div class="widget-heading">{{Auth::user()->name}}</div>
                                    <div class="widget-subheading"><a href="{{route("logout")}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> Uitloggen &raquo;</a></div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">

                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                    </button>
                    </span>
                </div>

                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Kwaliteitssystemen</li>
                            <li class="{{ (request()->routeIs('phases')) ? 'mm-active' : '' }}">
                                <a href="{{ route('phases') }}">
                                    <i class="metismenu-icon pe-7s-home"></i>Fases
                                </a>
                                <ul class="mm-collapse mm-show" style="">
                                    <li>
                                        <a href="dropdowns.html">
                                            <i class="metismenu-icon">
                                            </i>1. Verwervingsfase
                                        </a>
                                    </li>
                                    <li>
                                        <a href="icons.html">
                                            <i class="metismenu-icon">
                                            </i>2. Transitiefase
                                        </a>
                                    </li>
                                    <li>
                                        <a href="badges-labels.html">
                                            <i class="metismenu-icon">
                                            </i>3. Onderhoudsfase
                                        </a>
                                    </li>
                                    <li>
                                        <a href="cards.html">
                                            <i class="metismenu-icon">
                                            </i>4. Overdracht en Nazorg
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
            </div>

        </div>
        @stack('scripts')
    </body>
</html>
