<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('smTitle')</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="{{asset('app/css/bootstrap.min.css')}}" />

    <!-- Custom fonts for this template-->
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('app/css/paper-kit.css')}}" />
    <link rel="stylesheet" href="{{asset('app/css/nucleo-icons.css')}}" />
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    @stack('styles')
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <nav class="navbar navbar-expand-md bg-danger">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-menu-icon" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
      Habitaciones
      <i class="fa fa-bed"></i>
    </a>
    <div class="collapse navbar-collapse" id="navbar-menu-icon">
        <ul class="navbar-nav ml-auto">
            @if (!Auth::guest())
              <li class="nav-item">
                <a class="nav-link" href="{{route('crear')}}">
                  <i class="nc-icon nc-simple-add" aria-hidden="true"></i> Añadir Habitación
                </a>
              </li>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#pk" role="button" aria-haspopup="true" aria-expanded="false"><i class="nc-icon nc-settings-gear-65" aria-hidden="true"></i></a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-danger">
                    <li class="dropdown-header">
                      {{Auth::user()->nombres}}</li>
                    <a class="dropdown-item" href="{{route('logout')}}">Cerrar Sesión</a>
                      Mis publicaciones
                    </a>
                    <div class="dropdown-divider"></div>
                      Mi perfil
                    </a>
                </ul>
            </div>
            @else
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#pk" role="button" aria-haspopup="true" aria-expanded="false"><i class="nc-icon nc-single-02" aria-hidden="true"></i>Cuenta</a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-danger">
                    <a class="dropdown-item" href="{{route('login')}}">Iniciar Sesión</a>
                    <a class="dropdown-item" href="{{route('register')}}"> Registro</a>
                </ul>
              </div>
            @endif
        </ul>
    </div>
</nav>
<div class="wrapper">
    @yield('content')
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                  <h1>¡Cliente creado con exito!</h1>
                  <button type="button" class="btn btn-success">Crear otro cliente</button>
                </ul>
            </nav>
            <div class="credits ml-auto">
                <span class="copyright">

                </span>
            </div>
        </div>
    </div>
  </footer>

  <!-- Core JS Files -->
  <script src="{{asset('app/js/jquery-3.2.1.js')}}"></script>
  <script src="{{asset('app/js/jquery-ui-1.12.1.custom.min.js')}}"></script>
  <script src="{{asset('app/js/popper.js')}}"></script>
  <script src="{{asset('app/js/bootstrap.min.js')}}"></script>

  <!-- Switches -->
  <script src="{{asset('app/js/bootstrap-switch.min.js')}}"></script>

  <!--  Plugins for Slider -->
  <script src="{{asset('app/js/nouislider.js')}}"></script>

  <!--  Plugins for DateTimePicker -->
  <script src="{{asset('app/js/moment.min.js')}}"></script>
  <script src="{{asset('app/js/bootstrap-datetimepicker.min.js')}}"></script>

  <!--  Paper Kit Initialization and functons -->
  <script src="{{asset('app/js/paper-kit.js?v=2.1.0')}}"></script>
  @stack('scripts')
</body>
</html>
