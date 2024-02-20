<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="Logo" class="d-inline-block align-text-top" src="{{ asset('images/favicon.png') }}" width="30"
                     height="30">
                Inicio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.index') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employee.index') }}">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('supplier.index') }}">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.index') }}">Categorías</a>
                    </li>
                    @if( auth()->user() && auth()->user()->role == 'admin' )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.store') }}">Nuevo cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employee.store') }}">Nuevo empleado</a>
                        </li>
                    @endif
                </ul>
                @if( $user )
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-dark me-1" style="color: #FFFFFF8C" type="submit">
                            <i class="bi bi-box-arrow-right"></i>
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login.client') }}" class="btn btn-dark me-1" style="color: #FFFFFF8C">Iniciar
                        sesión</a>
                @endif
                <span class="navbar-text">
                    <a href="{{ route('profile.index') }}" class="btn btn-dark me-1" style="color: #FFFFFF8C">
                        <i class="bi bi-person-circle"></i> &nbsp;{{ $user->name ?? 'Invitado' }}
                    </a>
                </span>
                @if($user)
                    <div class="position-relative">
                        <i class="bi bi-cart-fill" style="color: #FFFFFF8C; font-size: 1.5rem"></i>
                        <div class="bg-light rounded-circle cart-count">{{count(session('cart') ?? [])}}</div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
