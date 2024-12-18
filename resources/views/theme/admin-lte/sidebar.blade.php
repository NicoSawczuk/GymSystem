<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
    <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light h3">
      @section('nombreGimnasio')
      @isset($gimnasio)
      <b>
        @isset($gimnasio->reporte_configuracion)
        <img src="{{asset("storage/".$gimnasio->reporte_configuracion->logo)}}" class="brand-image img-circle"
          style="opacity: .8">
        @endisset
        {{ $gimnasio->nombre }}
      </b>
      @endisset
      @show
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <i class="fal fa-user-circle fa-2x"></i>
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @auth
          @section('usuario')
          {{ Auth::user()->name }} {{ Auth::user()->apellido }}
          @show
          @endauth
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @section('sidebarNenu')
        <li
          class="nav-item has-treeview {{ (request()->routeIs('gimnasios.*')) ? 'menu-open' : '' }} {{ (request()->routeIs('clientes.*')) ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ (request()->routeIs('gimnasios.*')) ? 'active bg-teal' : '' }} {{ (request()->routeIs('clientes.*')) ? 'active bg-teal' : '' }}">
            <i class="nav-icon fal fa-dumbbell"></i>
            <p>
              Gimnasio
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/gimnasios/administrar" class="nav-link">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Administración</p>
              </a>
            </li>
            @isset($gimnasio)
            <li class="nav-item">
              <a href="{{route('clientes.administrar',[$gimnasio->id,$gimnasio->slug()])}}"
                class="nav-link {{ (request()->routeIs('clientes.*')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('clientes.*')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>
                  Clientes
                  <span class="badge badge-secondary right">{{ $gimnasio->getClientes() }}</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('gimnasios.estadistica', [$gimnasio->id, $gimnasio->slug()])}}" class="nav-link"
                style="{{ (request()->routeIs('gimnasios.*')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Gráficos</p>
              </a>
            </li>
            @endisset
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (request()->routeIs('especialidades.*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->routeIs('especialidades.*')) ? 'active bg-teal' : '' }}">
            <i class="nav-icon fad fa-stream"></i>
            <p>
              Especialidades
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @isset($gimnasio)
            <li class="nav-item">
              <a href="{{route('especialidades.administrar',[$gimnasio->id, $gimnasio->slug()])}}"
                class="nav-link  {{ (request()->routeIs('especialidades.administrar')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('especialidades.administrar')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Administración</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('especialidades.administrarMisEspecialidades',[$gimnasio->id, $gimnasio->slug()])}}"
                class="nav-link  {{ (request()->routeIs('especialidades.administrarMisEspecialidades')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('especialidades.administrarMisEspecialidades')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Mis especialidades</p>
              </a>
            </li>
            @endisset
            @isset($gimnasio)
            <li class="nav-item">
              <a href="{{route('especialidades.estadistica', [$gimnasio->id, $gimnasio->slug()])}}"
                class="nav-link  {{ (request()->routeIs('especialidades.estadistica')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('especialidades.estadistica.*')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Gráficos</p>
              </a>
            </li>
            @endisset
          </ul>
        </li>
        <li class="nav-item has-treeview {{ (request()->routeIs('cuotas.*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->routeIs('cuotas.*')) ? 'active bg-teal' : '' }}">
            <i class="nav-icon fal fa-cash-register"></i>
            <p>
              Cuotas
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @isset($gimnasio)
            <li class="nav-item">
              <a href="{{route('cuotas.administrar', [$gimnasio->id, $gimnasio->slug()])}}"
                class="nav-link {{ (request()->routeIs('cuotas.administrar')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('cuotas.administrar')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>
                  Administración
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('cuotas.administrarMisCuotas', [$gimnasio->id, $gimnasio->slug()])}}"
                class="nav-link {{ (request()->routeIs('cuotas.administrarMisCuotas')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('cuotas.administrarMisCuotas')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Mis cuotas</p>
              </a>
            </li>
            @endisset
          </ul>
        </li>
        <li
          class="nav-item has-treeview {{ (request()->routeIs('email_configuracion.*')) ? 'menu-open' : '' }} {{ (request()->routeIs('reporte_configuracion.*')) ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ (request()->routeIs('email_configuracion.*')) ? 'active bg-teal' : '' }} {{ (request()->routeIs('reporte_configuracion.*')) ? 'active bg-teal' : '' }}">
            <i class="nav-icon fad fa-cog"></i>
            <p>
              Configuración
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @isset($gimnasio)
            <li class="nav-item">
              <a href="{{ route('email_configuracion.edit',[$gimnasio->id, $gimnasio->slug()]) }}"
                class="nav-link {{ (request()->routeIs('email_configuracion.edit')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('email_configuracion.edit')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Correos automáticos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('reporte_configuracion.edit',[$gimnasio->id, $gimnasio->slug()]) }}"
                class="nav-link {{ (request()->routeIs('reporte_configuracion.edit')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('reporte_configuracion.edit')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fad fa-circle nav-icon fa-xs"></i>
                <p>Reportes</p>
              </a>
            </li>
            @endisset
          </ul>
        </li>
        @can('users.index')
        <li class="nav-item has-treeview {{ (request()->routeIs('usuarios.*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->routeIs('usuarios.*')) ? 'active bg-teal' : '' }}">
            <i class="nav-icon fad fa-tools"></i>
            <p>
              Panel de administrador
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('usuarios.administrar') }}"
                class="nav-link {{ (request()->routeIs('usuarios.administrar')) ? 'active' : '' }}"
                style="{{ (request()->routeIs('usuarios.administrar')) ? 'color: #39cccc; background-color: #F0F1F2;' : '' }}">
                <i class="fal fa-users-cog nav-icon"></i>
                <p>Administrar usuarios</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fad fa-door-open"></i>
            <p>
              Mi sesión
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if (session('status'))
            <li class="nav-item">
              <a href="pages/examples/login.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Login</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/examples/register.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Register</p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="fas fa-sign-out nav-icon"></i>
                <p>Cerrar sesión</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
        @show
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>