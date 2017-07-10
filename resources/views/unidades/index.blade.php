@extends('layouts.app')
@section('title','Unidades - '.config('app.name'))
@section('header','Unidades')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Unidades </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($unidades) }}</h3>
          <p>unidades</p>
        </div>
        <div class="icon">
          <i class="fa fa-map-o"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-warning">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-map-o"></i> Unidades</h3>
	        <span class="pull-right">
						<a href="{{ route('unidades.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo unidad</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Productor</th>
								<th class="text-center">Unidad</th>
								<th class="text-center">Lotes</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($unidades as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td><a href="{{route('productores.index').'/'.$d->productor_id}}">{{$d->productor->nombres." ".$d->productor->apellidos}}</a></td>
									<td>{{$d->unidad}}</td>
									<td>{{$d->lotes_qty()}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('unidades.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('unidades/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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