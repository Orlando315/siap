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
    <main class="content">
			<div style="position:relative;width:25%">
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
    	@include('partials.box_productores_simple')
    </main>
    <footer>
      Sistema Integrado de Apoyo al productor, c.a.
    </footer>
  </body>
</html>