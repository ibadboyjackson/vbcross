<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')  {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet">
    @livewireStyles
    @trixassets
    @stack('styles')
    <style>
        trix-editor {
            height: 150px !important;
            max-height: 150px !important;
            overflow-y: auto !important;
        }
    </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md bg-white shadow-sm nav-pills">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo1.png') }}" width="80px" height="30px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'public.posts' ? 'active' : '' }} {{ Route::currentRouteName() == 'post.comment' ? 'active' : '' }} " href="{{ route('public.posts') }}">{{ __('Posts') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'stories' ? 'active' : '' }}" href="{{ route('stories') }}">{{ __('News and Stories') }}</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'login' ? 'active' : '' }} " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'register' ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::user()->getRoleNames()->first() == 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.manage-users' ? 'active' : '' }}"
                                   href="{{ route('admin.manage-users') }}">{{ __('Manage Users') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}"
                                   href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.message.index' ? 'active' : '' }}"
                                   href="{{ route('admin.message.index') }}">{{ __('Chat Messages') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'admin.story.index' ? 'active' : '' }}"
                                   href="{{ route('admin.story.index') }}">{{ __('Story') }}</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'post.index' ? 'active' : '' }}" href="{{ route('post.index') }}">{{ __('Your Posts') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Route::currentRouteName() == 'chat' ? 'active' : '' }} {{ Route::currentRouteName() == 'chat.arena' ? 'active' : '' }} {{ Route::currentRouteName() == 'chat.online.members' ? 'active' : '' }}" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Chat @if($unreadMessagesCount)<span class="badge badge-danger">{{ $unreadMessagesCount === 0 ? '' : $unreadMessagesCount }}</span>@endif
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('chat') }}">Inbox @if($unreadMessagesCount)<span class="badge badge-danger">{{ $unreadMessagesCount === 0 ? '' : $unreadMessagesCount }}</span>@endif</a>
                                <a class="dropdown-item" href="{{ route('chat.arena') }}">Chat Arena</a>
                                <a class="dropdown-item" href="{{ route('chat.online.members') }}">Online Members</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }} {{ Route::currentRouteName() == 'profile.public' ? 'active' : '' }} dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                @if(Auth::user()->getRoleNames()->first() == 'user')
                                    <a class="dropdown-item" href="{{ route('profile.public' , Auth::id()) }}">Public
                                        Profile</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

@include('sweetalert::alert')
<!-- Scripts -->
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
