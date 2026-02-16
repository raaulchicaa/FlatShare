<!-- Navigation -->

<nav>

    @if(Auth::check())
        <p>Has iniciado sesión como <strong>{{ Auth::user()->name }}</strong></p>
    @endif

    <a href="{{ route('home') }}">Inicio</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('piso_list') }}">Pisos</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('usuario_list') }}">Usuarios</a>
    &nbsp;&nbsp;&nbsp;
    @if(Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
                <button type="submit" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                    {{ __('Log out') }}
                </button>
        </form>   
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Registro</a>
    @endif
    
</nav>