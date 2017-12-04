<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clínica Médica') }}</title>

    <!-- Styles -->
    <!-- rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"-->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <!--link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"-->
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Clínica Médica') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    @unless (Auth::guest())
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <li><a href="{{ route('agendaConsulta')}}">Agenda<span class="sr-only">(current)</span></a></li>
                        @unless(Auth::user()->perfil == 2)
                        <li><a href="{{ route('reagendamentoConsulta')}}">Reagendamento</a></li>
                        <li><a href="{{ route('controleExames')}}">Controle de Exames</a></li>
                        @endunless
                        @if(Auth::user()->perfil == 2)
                        <li><a href="{{ route('pacientes')}}">Pacientes</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('agenda')}}">Agenda Profissional</a></li>
                                <li role="separator" class="divider"></li>
                                @unless(Auth::user()->perfil == 2)
                                <li><a href="{{ route('pacientes')}}">Pacientes</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('profissionais')}}">Profissionais</a></li>
                                <li><a href="{{ route('ocupacoes')}}">Ocupação</a></li>
                                <li role="separator" class="divider"></li>
                                @endunless
                                <li><a href="{{ route('medicamentos')}}">Medicamento</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endunless
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->perfil == 1 ? 'Administrador: ' : (Auth::user()->perfil == 2 ? 'Médico: ' : 'Recepção: ')}}<span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" role="menu">
                                <!--div class="panel panel-default"-->
                                    <div class="panel-heading">{{ Auth::user()->name }}</div>
                                    <div class="panel-body">
                                        @if(Auth::user()->perfil == 1)
                                        <li class="list-group-item"><a href="{{route('usuarios')}}">Usuários</a></li>
                                        <li class="list-group-item"><a href="{{ route('register') }}">Novo Usuário</a></li>
                                        @endif
                                        <li class="list-group-item">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        </li>
                                    </div>
                                <!--/div--> 
                            </ul>
                            <!--ul class="dropdown-menu" role="menu">
                                <!--@if(Auth::user()->perfil == 1)
                                <li><a href="{{route('usuarios')}}">Usuários</a></li>
                                <li><a href="{{ route('register') }}">Novo Usuário</a></li>
                                <li role="separator" class="divider"></li>
                                @endif
                                <li>
                                    
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul-->
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    
    <script type="text/javascript"  src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/script-mask.js') }}"></script>
    
    @yield('post-script')
</body>

</html>
