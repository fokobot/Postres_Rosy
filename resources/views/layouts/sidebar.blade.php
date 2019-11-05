<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{asset('app/index.html')}}">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div> -->
    <div class="sidebar-brand-text mx-3">Postres Rosy<sup></sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Inicio</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menú
  </div>

  <li class="nav-item">
    <a class="nav-link" href="/#/clientes">
      <i class="fas fa-fw fa-user-friends"></i>
      <span>Clientes</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/#/productos">
      <i class="fas fa-fw fa-th-list"></i>
      <span>Productos</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/#/ventas">
      <i class="fas fa-fw fa-cart-arrow-down"></i>
      <span>Ventas</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/#/gastos">
      <i class="fas fa-fw fa-coins"></i>
      <span>Gastos</span>
    </a>
  </li>

  @can('menu', App\Empleado::class)
  <li class="nav-item">
    <a class="nav-link" href="/#/empleados">
      <i class="fas fa-fw fa-id-badge"></i>
      <span>Empleados</span>
    </a>
  </li>
  @endcan

  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item">
    <a class="nav-link" href="{{route('logout')}}">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Cerrar sesión</span>
    </a>
  </li>

</ul>
<!-- End of Sidebar -->