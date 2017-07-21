<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Productores</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logo.png">
      </div>
      <span class="pull-right"><b>Fecha:</b>{{ date("d-m-Y") }}</span>
      <h1>Ciclo - {{$ciclo->ciclo}}</h1>
    </header>
    <div class="content">
			<div style="position:relative;float:left;width:25%">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Ciclo</b> <span class="pull-right">{{$ciclo->ciclo}}</span>
          </li>
          <li class="list-group-item">
            <b>Año</b> <span class="pull-right">{{$ciclo->anio}}</span>
          </li>
          <li class="list-group-item">
            <b>Estado</b> <span class="pull-right">{!! $ciclo->status===1?'<span class="label label-success">Abierto</span>':'<span class="label label-danger">Cerrado</span>' !!}</span>
          </li>
          <li class="list-group-item">
            <b>Productores</b> <span class="pull-right">{{$ciclo->productores_qty()}}</span>
          </li>
          <li class="list-group-item">
            <b>Unididades</b> <span class="pull-right">{{$ciclo->unidades_qty()}}</span>
          </li>
        </ul>
      </div>
      @if($tecnico)
      <div style="position:relative;float:left;width:40%;margin-left:20px">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Tecnico</b> <span class="pull-right">{{$tecnico->nombres." ".$tecnico->apellidos}}</span>
          </li>
          <li class="list-group-item">
            <b>Cedula</b> <span class="pull-right">{{number_format($tecnico->cedula,0,",",".")}}</span>
          </li>
          <li class="list-group-item">
            <b>Email</b> <span class="pull-right">{{ $tecnico->email }}</span>
          </li>
          <li class="list-group-item">
            <b>Telefono pesonal</b> <span class="pull-right">{{$tecnico->tlf_personal?$tecnico->tlf_personal:'N/A'}}</span>
          </li>
          <li class="list-group-item">
            <b>Opcional</b> <span class="pull-right">{{$tecnico->tlf_opcional?$tecnico->tlf_opcional:'N/A'}}</span>
          </li>
          <li class="list-group-item">
            <b>Estado</b> <span class="pull-right">{{$tecnico->estado}}</span>
          </li>
        </ul>
      </div>
      @endif
      <div class="clearfix"></div>
			@include('partials.box_productores_simple')
		</div>
    <footer>
      Sistema Integrado de Apoyo al productor, c.a.
    </footer>
  </body>
</html>