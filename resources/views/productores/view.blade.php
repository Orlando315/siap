@extends('layouts.app')
@section('title','Productor - '.config('app.name'))
@section('header','Productores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('productores.index')}}">Productores </a> </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('productores.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ url('productores/'.$productor->id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <a class="btn btn-flat btn-default" href="{{ route('reportes.productor',['id'=>$productor->id]) }}"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
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
              <h3 class="profile-username text-center">{{$productor->nombres." ".$productor->apellidos}}</h3>

              <p class="text-muted text-center">Productor</p>

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
            <!-- /.box-body -->
          </div>
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{$productor->tecnico->nombres." ".$productor->tecnico->apellidos}}</h3>

              <p class="text-muted text-center">Tecnico <a href="{{route('tecnicos.show',[$productor->tecnico->id])}}">(ver detalles)</a></p>
	
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cedula/RIF</b> <span class="pull-right">{{ number_format($productor->tecnico->cedula,0,",",".") }}</span>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <span class="pull-right">{{ $productor->tecnico->email }}</span>
                </li>
                <li class="list-group-item">
                  <b>Telefono pesonal</b> <span class="pull-right">{{$productor->tecnico->tlf_personal?$productor->tecnico->tlf_personal:'N/A'}}</span>
                </li>
                <li class="list-group-item">
                  <b>Opcional</b> <span class="pull-right">{{$productor->tecnico->tlf_opcional?$productor->tecnico->tlf_opcional:'N/A'}}</span>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <span class="pull-right">{{$productor->tecnico->estado}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
        	<div class="box box-success">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-map-o"></i> Unidades de produccion</h3>
			        <span class="pull-right">
			        	<a class="btn btn-flat btn-success" href="{{route('unidades.create').'/'.$productor->id}}"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Unidad</a>
			        </span>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Unidad</th>
										<th class="text-center">Ubicacion</th>
										<th class="text-center">Lotes</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($unidades as $d)
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$d->unidad}}</td>
											<td>{{$d->ubicacion}}</td>
											<td>{{$d->lotes_qty()}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ route('unidades.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
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
          <h4 class="modal-title" id="delModalLabel">Eliminar productor</h4>
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