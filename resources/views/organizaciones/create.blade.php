@extends('layouts.app')
@section('title','Productores - '.config('app.name'))
@section('header','Productores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('productores.index')}}">Productores </a> </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('productores') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Agregar productor</h4>
					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">Nombres: *</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):''}}" placeholder="Nombres">
					</div>
					
					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos:</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):''}}" placeholder="Apellidos">
					</div>

					<div class="form-group {{ $errors->has('tipo')?'has-error':'' }}">
						<label class="control-label" for="tipo">Tipo: *</label>
						<select id="tipo" name="tipo" class="form-control">
							<option value="">Seleccione...</option>
							<option value="V" @if(old('tipo')) {{ old('tipo')==='V'?'selected':''}} @endif >V</option>
							<option value="E" @if(old('tipo')) {{ old('tipo')==='E'?'selected':''}} @endif >E</option>
							<option value="J" @if(old('tipo')) {{ old('tipo')==='J'?'selected':''}} @endif >J</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('identificacion')?'has-error':'' }}">
						<label class="control-label" for="identificacion">Cedula/RIF: *</label>
						<input id="identificacion" class="form-control" type="text" name="identificacion" value="{{ old('identificacion')?old('identificacion'):''}}" placeholder="Cedula/RIF">
					</div>

					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email: *</label>
						<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Telefono personal: *</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):'' }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_oficina')?'has-error':'' }}">
						<label class="control-label" for="tlf_oficina">Telefono oficina:</label>
						<input id="tlf_oficina" class="form-control" type="text" name="tlf_oficina" value="{{ old('tlf_oficina')?old('tlf_oficina'):'' }}" placeholder="Telefono oficina">
					</div>

					<div class="form-group {{ $errors->has('tlf_administracion')?'has-error':'' }}">
						<label class="control-label" for="tlf_administracion">Telefono administracion:</label>
						<input id="tlf_administracion" class="form-control" type="text" name="tlf_administracion" value="{{ old('tlf_administracion')?old('tlf_administracion'):'' }}" placeholder="Telefono administracion">
					</div>

					<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
						<label class="control-label" for="direccion">Direccion: </label>
						<input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion')?old('direccion'):'' }}" placeholder="direccion">
					</div>

					<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
						<label class="control-label" for="contacto">Persona de contacto: </label>
						<input id="contacto" class="form-control" type="text" name="contacto" value="{{ old('contacto')?old('contacto'):'' }}" placeholder="Persona de contacto">
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
						<a class="btn btn-flat btn-default" href="{{route('productores.index')}}"><i class="fa fa-reply"></i> Volver</a>
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