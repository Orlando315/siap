@extends('layouts.app')
@section('title','Productores - '.config('app.name'))
@section('header','Productores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Productores </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count($productores) }}</h3>
          <p>productores</p>
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
	        <h3 class="box-title"><i class="fa fa-user-circle"></i> Productores</h3>
	        <span class="pull-right">
						<a href="{{ route('productores.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo producto</a>
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
							@foreach($productores as $d)
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
@endsection