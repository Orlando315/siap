<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Organizaciones</title>
    <link rel="stylesheet" href="css/pdf.css" media="all" />
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logo.png">
      </div>
      <span class="pull-right"><b>Fecha:</b>{{ date("d-m-Y") }}</span>
      <h1>Organizaciones</h1>
    </header>
    <main>
      <table class="table table-bordered">
      	<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Organizacion</th>
						<th class="text-center">Productores</th>
						<th class="text-center">Registrado</th>
					</tr>
				</thead>
				<tbody class="text-center">
				@foreach($organizaciones as $d)
					<tr>
						<td>{{$loop->index+1}}</td>
						<td>{{$d->organizacion}}</td>
						<td>{{$d->productores_qty()}}</td>
						<td>{{$d->created_at}}</td>
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