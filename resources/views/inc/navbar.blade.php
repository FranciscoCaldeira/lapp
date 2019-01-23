<nav class="navbar navbar-inverse"> <!-- navbar-default fica branco -->
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
            <a class="navbar-brand" href="/"> {{config('app.name','LAPP')}} </a>
        </div>
        
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav"> <!-- meu nav +++ -->
                <!-- <li><a href="/">Home</a></li> -->
                <li><a href="/about">About</a></li>
                <li><a href="/posts">Posts</a></li>
            </ul>
                        @auth
                            <!-- tudo o que for autenticado -->
                        @endauth 
                        @guest
                            <!-- tudo o que for n autenticado -->
                        @endguest
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    
                    <ul class="dropdown-menu" role="menu">
                        <li> <a href="/dashboard">dashboard</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
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