@extends('layouts.app')
@section('title','Ciclos - '.config('app.name'))
@section('header','Ciclos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ciclos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ count($ciclos) }}</h3>
          <p>Ciclos</p>
        </div>
        <div class="icon">
          <i class="fa fa-spinner"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-spinner"></i> Ciclos</h3>
	        <span class="pull-right">
	        	<a href="{{ route('ciclos.search') }}" class="btn btn-flat btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> Busqueda</a>
						<a href="{{ route('ciclos.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo ciclo</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Año</th>
								<th class="text-center">Ciclo</th>
								<th class="text-center">Status</th>
								<th class="text-center">Productores</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($ciclos as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$d->anio}}</td>
									<td>{{$d->ciclo}}</td>
									<td>{!! $d->status===1?'<span class="label label-success">Abierto</span>':'<span class="label label-danger">Cerrado</span>' !!}</td>
									<td>{{$d->productores_qty()}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('ciclos.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
										@if($d->status===1)
											<a  href="{{ route('ciclos.index').'/add/'.$d->id}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-plus-circle"></i></a>
										@endif
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