<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tecnicos</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logo.png">
      </div>
      <span class="pull-right"><b>Fecha:</b>{{ date("d-m-Y") }}</span>
      <h1>Tecnicos </h1>
    </header>
    <main>
      <table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Cedula/RIF</th>
						<th class="text-center">Nombres</th>
						<th class="text-center">Apellidos</th>
						<th class="text-center">Email</th>
						<th class="text-center">Telefono</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($tecnicos as $d)
						<tr>
							<td>{{$loop->index+1}}</td>
							<td>{{number_format($d->cedula,0,",",".")}}</td>
							<td>{{$d->nombres}}</td>
							<td>{{$d->apellidos}}</td>
							<td>{{$d->email}}</td>
							<td>{{$d->tlf_personal}}</td>
						</tr>
					@endforeach
				</tbody>
      </table>
    </main>
    <footer>
      Sistema Integrado de Apoyo al productor, c.a. | <b>Fecha:</b>{{ date("d-m-Y") }}
    </footer>
  </body>
</html>