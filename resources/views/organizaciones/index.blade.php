@extends('layouts.app')
@section('title','Organizaciones - '.config('app.name'))
@section('header','Organizaciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Organizaciones </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>{{ count($organizaciones) }}</h3>
          <p>organizaciones</p>
        </div>
        <div class="icon">
          <i class="fa fa-building"></i>
        </div>
      </div>
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
    	<div class="box box-purple">
	      <div class="box-header with-border">
	        <h3 class="box-title"><i class="fa fa-building"></i> Organizaciones</h3>
	        <span class="pull-right">
						<a href="{{ route('organizaciones.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva organizacion</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Organizacion</th>
								<th class="text-center">Productores</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($organizaciones as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$d->organizacion}}</td>
									<td>{{$d->productores_qty()}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('organizaciones.index').'/'.$d->id }}"><i class="fa fa-search"></i></a>
										<a href="{{ url('organizaciones/'.$d->id.'/edit') }}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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