<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
  </head>

<body class="hold-transition login-page">
    <div class="login-logo">
    <center><img class="img-responsive" src="{{ asset('images/logo.png') }}" alt="Logo" style="height:135px"></center>
    </div><!-- /.login-logo -->
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Pagina no encontrada.</h3>

          <p>
            No pudimos encontrar la pagina que estas buscando.
            Podrias <a href="{{ route('index') }}">volver a Inicio</a>.
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
</body>