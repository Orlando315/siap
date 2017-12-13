@extends('layouts.app')
@section('title','Tecnicos - '.config('app.name'))
@section('header','Tecnicos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Tecnicos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count($tecnicos) }}</h3>
          <p>tecnicos</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-circle"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-purple">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-user-circle"></i> Tecnicos</h3>
	        <span class="pull-right">
	        	<a href="{{ route('reportes.tecnicos') }}" class="btn btn-flat btn-default"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
						<a href="{{ route('tecnicos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo tecnico</a>
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
							@foreach($tecnicos as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{number_format($d->cedula,0,",",".")}}</td>
									<td>{{$d->nombres}}</td>
									<td>{{$d->apellidos}}</td>
									<td>{{$d->email}}</td>
									<td>{{$d->tlf_personal}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('tecnicos.show',[$d->id]) }}" title="Ver"><i class="fa fa-search"></i></a>
										<a class="btn btn-flat btn-success btn-sm" href="{{ route('tecnicos.edit',[$d->id]) }}" title="Editar"><i class="fa fa-edit"></i></a>
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