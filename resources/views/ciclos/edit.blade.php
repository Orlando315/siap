@extends('layouts.app')
@section('title','Ciclos - '.config('app.name'))
@section('header','Ciclos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-dashboard" aria-hidden="true"></i> Inicio</a></li>
	  <li> Ciclos </li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('ciclos/'.$ciclo->id) }}" method="POST" enctype="multipart/form-data">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4>Editar ciclo</h4>
					<div class="form-group {{ $errors->has('ciclo')?'has-error':'' }}">
						<label class="control-label" for="ciclo">Ciclo: *</label>
						<input id="ciclo" class="form-control" type="text" name="ciclo" value="{{ old('ciclo')?old('ciclo'):$ciclo->ciclo }}" placeholder="Ciclo">
					</div>
					
					<div class="form-group {{ $errors->has('anio')?'has-error':'' }}">
						<label class="control-label" for="anio">Año: *</label>
						<input id="anio" class="form-control" type="text" name="anio" value="{{ old('anio')?old('anio'):$ciclo->anio }}" placeholder="Año">
					</div>

					@if (count($errors) > 0)
          <div class="alert alert-danger alert-important">
	          <ul>
	            @foreach($errors->all() as $error)
	               <li>{{$error}}</li>
	             @endforeach
	           </ul>  
          </div>
        	@endif

					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('ciclos.index')}}"><i class="fa fa-reply"></i> Volver</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#anio').datepicker({
				autoclose: true,
  			format: "yyyy",
  			startView: "years", 
  			minViewMode: "years",
  			endDate: 'today'
			});
	  });
	</script>
@endsection