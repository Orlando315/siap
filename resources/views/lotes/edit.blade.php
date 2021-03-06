@extends('layouts.app')
@section('title','Lotes - '.config('app.name'))
@section('header','Lotes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('lotes.index')}}">Lotes </a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ route('lotes.index').'/'.$lote->id }}" method="POST" enctype="multipart/form-data">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4>Editar Lote</h4>
					<div class="form-group {{ $errors->has('lote')?'has-error':'' }}">
						<label class="control-label" for="lote">Lote: *</label>
						<input id="lote" class="form-control" type="text" name="lote" value="{{ old('lote')?old('lote'):$lote->lote}}" placeholder="Lote" required>
					</div>

					<div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
						<label class="control-label" for="nombre">Nombre: </label>
						<input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):$lote->nombre}}" placeholder="Nombre">
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
						<a class="btn btn-flat btn-default" href="{{route('unidades.index').'/'.$lote->unidad_id}}"><i class="fa fa-reply"></i> Volver</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
			</div>
		</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

	  });
	</script>
@endsection