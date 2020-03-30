<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light h3">
        @section('nombreGimnasio')
          @isset($gimnasio)
              <b>{{ $gimnasio->nombre }}</b>
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
            @section('usuario')
            {{ Auth::user()->name }} {{ Auth::user()->apellido }}
            @show
          </a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @section('sidebarNenu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fal fa-dumbbell"></i>
              <p>
                 Gimnasio
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/gimnasios/administrar" class="nav-link">
                  <i class="fal fa-circle nav-icon"></i>
                  <p>Administración</p>
                </a>
              </li>
              @isset($gimnasio)
              <li class="nav-item">
                <a href="/clientes/administrar/{{ $gimnasio->id }}" class="nav-link">
                  <i class="fal fa-circle nav-icon"></i>
                  <p>
                    Clientes
                    <span class="badge badge-secondary right">{{ $gimnasio->getClientes() }}</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/gimnasios/{{ $gimnasio->id }}/estadistica" class="nav-link">
                  <i class="fal fa-circle nav-icon"></i>
                  <p>Estadística</p>
                </a>
              </li>
              @endisset
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fad fa-stream"></i>
              <p>
                Especialidades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @isset($gimnasio)
              <li class="nav-item">
                <a href="/especialidades/{{ $gimnasio->id }}/administrar" class="nav-link">
                  <i class="fal fa-circle nav-icon"></i>
                  <p>Administración</p>
                </a>
              </li>
              @endisset
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fad fa-cog"></i>
              <p>
                Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @isset($gimnasio)
              <li class="nav-item">
                <a href="/email_configuracion/{{ $gimnasio->id }}/edit" class="nav-link">
                  <i class="fal fa-circle nav-icon"></i>
                  <p>Correos automáticos</p>
                </a>
              </li>
              @endisset
            </ul>
          </li>
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
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
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