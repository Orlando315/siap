@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</li>
	</ol>
@endsection
@section('content')

	<section class="content">
  @include('partials.flash')
	  <div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-spinner"></i> Ciclos</h3>
		        <span class="pull-right">
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
												<a  href="{{ route('ciclos.index').'/add/'.$d->id}}" class="btn btn-flat btn-success btn-sm" title="Agregar unidad al ciclo"><i class="fa fa-plus-circle"></i></a>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
	    <div class="col-md-12">
	      <div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-id-card-o "></i> Productores</h3>
		        <span class="pull-right">
		        	<a href="{{route('productores.create')}}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo productor</a>
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
	    </div><!-- /.col -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
@endsection