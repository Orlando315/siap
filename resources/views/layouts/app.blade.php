<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title',config('app.name'))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- favicon / icons
    ============================================ -->
		<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/logo.png') }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{asset('css/Styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    
	  <style type="text/css">
	    .perfil{
			  position: relative;
			  background: #fff;
			  border: 1px solid #f4f4f4;
			  padding: 20px;
			  margin: 10px 25px;
			}
			.table-condensed tbody>tr>td{
				padding: 5px 0;
			}
			.btn-arrows .btn-default.btn-xs{
				padding: 0 3px !important;
			}
	  </style>
  </head>

  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('login')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img class="img-responsive" src="{{ asset('images/logo.png') }}" alt="Logo" style="height:30px;margin:10px 0 0 0"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <b style="font-size: 18px">
              <img src="{{ asset('images/logo.png') }}" alt="logo" height="50px">
            </b>
          </span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <li>
              	<a href="{{ route('ciclos.search') }}"><i class="fa fa-search-plus" aria-hidden="true"></i> Busqueda</a>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ Auth::user()->nombres }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>{{ Auth::user()->email }}</p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a class="btn btn-flat btn-default" href="{{route('perfil')}}"><i class="fa fa-user"></i> Mi perfil</a>
                    </div>
                    <div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-flat btn-default" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</button>
                      </form>
                    </div>
                    <div class="pull-left">
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>

            <li>
              <a href="{{route('index')}}">
              	<i class="fa fa-home" aria-hidden="true"></i> <span>Inicio</span>
              </a>
            </li>

            <li>
            	<a href="{{ route('ciclos.index') }}">
            		<i class="fa fa-spinner"></i> <span>Ciclos</span>
            	</a>
            </li>

            <li>
            	<a href="{{ route('planificaciones.index') }}">
            		<i class="fa fa-arrows"></i> <span>Planificaciones</span>
            	</a>
            </li>

            <li>
            	<a href="{{ route('organizaciones.index') }}">
            		<i class="fa fa-building"></i> <span>Organizaciones</span>
            	</a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Ver usuarios</a></li>
                <li><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i>Agregar usuario</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-circle"></i>
                <span>Tecnicos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('tecnicos.index') }}"><i class="fa fa-circle-o"></i>Ver tecnicos</a></li>
                <li><a href="{{ route('tecnicos.create') }}"><i class="fa fa-circle-o"></i>Agregar tecnico</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-id-card-o "></i>
                <span>Productores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('productores.index') }}"><i class="fa fa-circle-o"></i>Ver productores</a></li>
                <li><a href="{{ route('productores.create') }}"><i class="fa fa-circle-o"></i>Agregar productor</a></li>
              </ul>
            </li>
<!--
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Configuracion</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              </ul>
            </li>
-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1 class="text-center">
            @yield('header')
          </h1>
          @yield('breadcrumb')
        </section>
        <!-- Main content -->
        <div class="content">
        	@yield('content')
        </div>
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <strong>Sistema Integrado de Apoyo al Productor, C.A. </strong>
      </footer>
    </div>
      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	$('div.alert').not('.alert-important').delay(7000).slideUp(300);

        $('.data-table').DataTable({
          responsive: true,
          language: {
          	url:'{{asset("js/spanish.json")}}'
          }
        });
      })
    </script>

    @yield('script')
  </body>
</html>


