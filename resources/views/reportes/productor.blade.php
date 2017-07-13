<!DOCTYPE html>
<html lang="en">
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
      <h1>{{$productor->nombres." ".$productor->apellidos}} </h1>
    </header>
    <main>
    	<div style="float:left;position:relative;min-height:1px;padding-right:7px;width:49%">
	      <ul class="list-group list-group-unbordered">
	        <li class="list-group-item">
	          <b>Cedula/RIF</b> <span class="pull-right">{{  $productor->tipo."-".number_format($productor->identificacion,0,",",".") }}</span>
	        </li>
	        <li class="list-group-item">
	          <b>Email</b> <span class="pull-right">{{ $productor->email }}</span>
	        </li>
          <li class="list-group-item">
            <b>Contacto</b> <span class="pull-right">{{$productor->contacto?$productor->contacto:'N/A'}}</span>
          </li>
          <li class="list-group-item">
            <b>Telefono pesonal</b> <span class="pull-right">{{$productor->tlf_personal?$productor->tlf_personal:'N/A'}}</span>
          </li>
	      </ul>
      </div>
    	<div style="float:left;position:relative;min-height:1px;padding-right:7px;padding-left:7px;width:49%">
	      <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Oficina</b> <span class="pull-right">{{$productor->tlf_oficina?$productor->tlf_oficina:'N/A'}}</span>
          </li>
          <li class="list-group-item">
            <b>Administracion</b> <span class="pull-right">{{$productor->tlf_administracion?$productor->tlf_administracion:'N/A'}}</span>
          </li>
	        <li class="list-group-item">
	          <b>Estado</b> <span class="pull-right">{{$productor->estado}}</span>
	        </li>
	        <li class="list-group-item">
	          <b>Direccion</b> <span class="pull-right">{{$productor->direccion?$productor->direccion:'N/A'}}</span>
	        </li>
	      </ul>
      </div>
      <div class="clearfix">
      </div>
      <div style="float:left;position:relative;min-height:1px;padding-right:15px;padding-left:15px;width:100%">
      	<h3 class="text-center">Unidades de produción</h3>
	      <table class="table data-table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Unidad</th>
							<th class="text-center">Ubicacion</th>
							<th class="text-center">Lotes</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@foreach($unidades as $d)
							<tr>
								<td>{{$loop->index+1}}</td>
								<td>{{$d->unidad}}</td>
								<td>{{$d->ubicacion}}</td>
								<td>{{$d->lotes_qty()}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
    </main>
    <footer>
      Sistema Integrado de Apoyo al productor, c.a. | <b>Fecha:</b>{{ date("d-m-Y") }}
    </footer>
  </body>
</html>