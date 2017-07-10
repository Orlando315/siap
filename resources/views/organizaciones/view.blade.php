@extends('layouts.app')
@section('title','Organizacion - '.config('app.name'))
@section('header','Organizacion')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('organizaciones.index')}}">Organizaciones </a> </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('organizaciones.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ url('organizaciones/'.$organizacion->id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <!--
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	    -->
		</section>

		<section>
			<div class="row">
				<div class="col-md-12">&nbsp;</div>
				<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{$organizacion->organizacion}}</h3>

              <p class="text-muted text-center">Registrada {{$organizacion->created_at}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Productores</b> <span class="pull-right">{{ $organizacion->productores_qty() }}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
        	<div class="box box-danger">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-users-circle"></i> Productores</h3>
			        <span class="pull-right">
			        	<a class="btn btn-flat btn-success" href="{{route('productores.create').'/'.$organizacion->id}}"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Productor</a>
			        </span>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Cedula/RIF</th>
										<th class="text-center">Nombres</th>
										<th class="text-center">Apellidos</th>
										<th class="text-center">Email</th>
										<th class="text-center">Telefono</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($organizacion->productores() as $d)
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$d->tipo."-".number_format($d->identificacion,0,",",".")}}</td>
											<td>{{$d->nombres}}</td>
											<td>{{$d->apellidos}}</td>
											<td>{{$d->email}}</td>
											<td>{{$d->tlf_personal}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ route('productores.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
												<a href="{{ url('productores/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
        </div>
			</div>
		</section>
	</div>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar organizacion</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delProduct" class="col-md-8 col-md-offset-2" action="#" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
              <h4 class="text-center">Esta seguro de eliminar este curso?</h4><br>

              <div class="form-group">
                <div class="progress" style="display:none">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  </div>
                </div>
                <div class="alert" style="display:none" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span id="msj"></span></div>
              </div>
              <center>
                <button class="btn btn-flat btn-danger" type="submit">Save</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection