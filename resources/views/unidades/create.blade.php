@extends('layouts.app')
@section('title','Unidades - '.config('app.name'))
@section('header','Unidades')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('unidades.index')}}">Unidades </a> </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ route('unidades.index') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Agregar unidad</h4>

					<div class="form-group {{ $errors->has('productor')?'has-error':'' }}">
						<label class="control-label" for="productor">Productor: *</label>
						<select id="productor" name="productor" class="form-control">
							<option value="">Seleccione...</option>
							@foreach($productores as $d)
							<option value="{{$d->id}}" {{ $d->id==$id?'selected':'' }}>{{ $d->nombres." ".$d->apellidos }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('unidad')?'has-error':'' }}">
						<label class="control-label" for="unidad">Unidad: *</label>
						<input id="unidad" class="form-control" type="text" name="unidad" value="{{ old('unidad')?old('unidad'):'' }}" placeholder="Unidad" required>
					</div>

					<div class="form-group {{ $errors->has('ubicacion')?'has-error':'' }}">
						<label class="control-label" for="ubicacion">Ubicacion: *</label>
						<input id="ubicacion" class="form-control" type="text" name="ubicacion" value="{{ old('ubicacion')?old('ubicacion'):'' }}" placeholder="Ubicacion" required>
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
						<a class="btn btn-flat btn-default" href="{{route('unidades.index')}}"><i class="fa fa-reply"></i> Volver</a>
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