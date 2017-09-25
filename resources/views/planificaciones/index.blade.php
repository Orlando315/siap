@extends('layouts.app')
@section('title','Planificaciones - '.config('app.name'))
@section('header','Planificaciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Planificaciones </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count($planificaciones) }}</h3>
          <p>planificaciones</p>
        </div>
        <div class="icon">
          <i class="fa fa-arrows"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-purple">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-arrows"></i> Planificaciones</h3>
	        <span class="pull-right">
						<a href="{{ route('planificaciones.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva planificacion</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Productor</th>
								<th class="text-center">Lote</th>
								<th class="text-center">F. Siembra</th>
								<th class="text-center">DDS</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($planificaciones as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$d->productor->nombres." ".$d->productor->apellidos}}</td>
									<td>{{$d->lote->lote."|".($d->lote->nombre?$d->lote->nombre:'N/A')}}</td>
									<td>{{$d->fecha_siembra}}</td>
									<td>X</td>
									<td>X</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('planificaciones.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('planificaciones/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection