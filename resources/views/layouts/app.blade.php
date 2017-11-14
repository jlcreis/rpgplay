<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'RPG Play') }}</title>

	<!-- Styles -->
	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('jquery/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
			<!-- botão menu -->
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent"
			 aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
			<!-- Imagem -->
			<a class="navbar-brand" href="{{ url('/') }}">
            <img src="/img/IMG001.gif" width="40" heigth="40" alt="d20"> <!--{{ config('app.name', 'rpgPlay') }}-->
            </a>
			<div class="collapse navbar-collapse" id="navbarMenu">
				<!-- Menu -->
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('partidas') }}">Partidas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('personagens') }}">Personagens</a>
					</li>
				</ul>
				<!-- Autenticação do usuário -->
				
                @auth
				<div class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->nome }} <span class="caret"></span>
                    </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="{{ Auth::user()->id == 1 ? route('jogadores', Auth::user()->id): route('jogador', Auth::user()->id)}}">Configurar</a>
						<a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sair
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
					</div>
				</div>
				@endauth
			</div>
		</nav>
		@yield('content')
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('jquery/jquery-3.2.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('jquery/jquery.mask.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('jquery/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
	@yield('post-script')
</body>

</html>