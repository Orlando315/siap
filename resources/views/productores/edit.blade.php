@extends('layouts.app')
@section('title','Productores - '.config('app.name'))
@section('header','Productores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Productores </li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="" action="{{ url('productores/'.$productor->id) }}" method="POST" enctype="multipart/form-data">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4>Editar productor</h4>
					<div class="form-group {{ $errors->has('tecnico')?'has-error':'' }}">
						<label class="control-label" for="tecnico">Tecnico: *</label>
						<select id="tecnico" class="form-control" type="text" name="tecnico">
							<option value="">Seleccione...</option>
							@foreach($tecnicos AS $d)
								<option value="{{$d->id}}" @if(old('tecnico')) {{ old('tecnico')==$d->id?'selected':''}} @else {{$productor->tecnico->id==$d->id?'selected':''}} @endif >{{$d->nombres." ".$d->apellidos}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">Nombres: *</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):$productor->nombres }}" placeholder="Nombres">
					</div>
					
					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos: </label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):$productor->apellidos }}" placeholder="Apellidos">
					</div>
					
					<div class="form-group {{ $errors->has('tipo')?'has-error':'' }}">
						<label class="control-label" for="tipo">Documento tipo: *</label>
						<select id="tipo" name="tipo" class="form-control">
							<option value="">Seleccione...</option>
							<option value="V" @if(old('tipo')) {{ old('tipo')==='V'?'selected':''}} @else {{$productor->tipo==='V'?'selected':''}} @endif >V</option>
							<option value="E" @if(old('tipo')) {{ old('tipo')==='E'?'selected':''}} @else {{$productor->tipo==='E'?'selected':''}} @endif >E</option>
							<option value="J" @if(old('tipo')) {{ old('tipo')==='J'?'selected':''}} @else {{$productor->tipo==='J'?'selected':''}} @endif >J</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('identificacion')?'has-error':'' }}">
						<label class="control-label" for="identificacion">Cedula/RIF: *</label>
						<input id="identificacion" class="form-control" type="text" name="identificacion" value="{{ old('identificacion')?old('identificacion'):$productor->identificacion }}" placeholder="Apellidos">
					</div>

					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email: *</label>
						<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):$productor->email }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('estado')?'has-error':'' }}">
						<label class="control-label" for="estado">Estado: *</label>
						<select id="estado" class="form-control" name="estado">
							<option selected="selected" value="">Seleccione...</option>
							<option value="Amazonas" @if(old('estado')) {{ old('estado')=='Amazonas'?'selected':''}} @else {{$productor->estado=='Amazonas'?'selected':''}} @endif>Amazonas</option>
							<option value="Anzoategui" @if(old('estado')) {{ old('estado')=='Anzoategui'?'selected':''}} @else {{$productor->estado=='Anzoategui'?'selected':''}} @endif>Anzoátegui</option>
							<option value="Apure" @if(old('estado')) {{ old('estado')=='Apure'?'selected':''}} @else {{$productor->estado=='Apure'?'selected':''}} @endif>Apure</option>
							<option value="Aragua" @if(old('estado')) {{ old('estado')=='Aragua'?'selected':''}} @else {{$productor->estado=='Aragua'?'selected':''}} @endif>Aragua</option>
							<option value="Barinas" @if(old('estado')) {{ old('estado')=='Barinas'?'selected':''}} @else {{$productor->estado=='Barinas'?'selected':''}} @endif>Barinas</option>
							<option value="Bolivar" @if(old('estado')) {{ old('estado')=='Bolivar'?'selected':''}} @else {{$productor->estado=='Bolivar'?'selected':''}} @endif>Bolívar</option>
							<option value="Carabobo" @if(old('estado')) {{ old('estado')=='Carabobo'?'selected':''}} @else {{$productor->estado=='Carabobo'?'selected':''}} @endif>Carabobo</option>
							<option value="Cojedes" @if(old('estado')) {{ old('estado')=='Cojedes'?'selected':''}} @else {{$productor->estado=='Cojedes'?'selected':''}} @endif>Cojedes</option>
							<option value="Delta Amacuro" @if(old('estado')) {{ old('estado')=='Delta Amacuro'?'selected':''}} @else {{$productor->estado=='Delta Amacuro'?'selected':''}} @endif>Delta Amacuro</option>
							<option value="Distrito Capital" @if(old('estado')) {{ old('estado')=='Distrito Capital'?'selected':''}} @else {{$productor->estado=='Distrito Capital'?'selected':''}} @endif>Distrito Capital</option>
							<option value="Falcon" @if(old('estado')) {{ old('estado')=='Falcon'?'selected':''}} @else {{$productor->estado=='Falcon'?'selected':''}} @endif>Falcón</option>
							<option value="Guarico" @if(old('estado')) {{ old('estado')=='Guarico'?'selected':''}} @else {{$productor->estado=='Guarico'?'selected':''}} @endif>Guárico</option>
							<option value="Lara" @if(old('estado')) {{ old('estado')=='Lara'?'selected':''}} @else {{$productor->estado=='Lara'?'selected':''}} @endif>Lara</option>
							<option value="Merida" @if(old('estado')) {{ old('estado')=='Merida'?'selected':''}} @else {{$productor->estado=='Merida'?'selected':''}} @endif>Mérida</option>
							<option value="Miranda" @if(old('estado')) {{ old('estado')=='Miranda'?'selected':''}} @else {{$productor->estado=='Miranda'?'selected':''}} @endif>Miranda</option>
							<option value="Monagas" @if(old('estado')) {{ old('estado')=='Monagas'?'selected':''}} @else {{$productor->estado=='Monagas'?'selected':''}} @endif>Monagas</option>
							<option value="Nueva Esparta" @if(old('estado')) {{ old('estado')=='Nueva Esparta'?'selected':''}} @else {{$productor->estado=='Nueva Esparta'?'selected':''}} @endif>Nueva Esparta</option>
							<option value="Portuguesa" @if(old('estado')) {{ old('estado')=='Portuguesa'?'selected':''}} @else {{$productor->estado=='Portuguesa'?'selected':''}} @endif>Portuguesa</option>
							<option value="Sucre" @if(old('estado')) {{ old('estado')=='Sucre'?'selected':''}} @else {{$productor->estado=='Sucre'?'selected':''}} @endif>Sucre</option>
							<option value="Tachira" @if(old('estado')) {{ old('estado')=='Tachira'?'selected':''}} @else {{$productor->estado=='Tachira'?'selected':''}} @endif>Tachira</option>
							<option value="Trujillo" @if(old('estado')) {{ old('estado')=='Trujillo'?'selected':''}} @else {{$productor->estado=='Trujillo'?'selected':''}} @endif>Trujillo</option>
							<option value="Vargas" @if(old('estado')) {{ old('estado')=='Vargas'?'selected':''}} @else {{$productor->estado=='Vargas'?'selected':''}} @endif>Vargas</option>
							<option value="Yaracuy" @if(old('estado')) {{ old('estado')=='Yaracuy'?'selected':''}} @else {{$productor->estado=='Yaracuy'?'selected':''}} @endif>Yaracuy</option>
							<option value="Zulia" @if(old('estado')) {{ old('estado')=='Zulia'?'selected':''}} @else {{$productor->estado=='Zulia'?'selected':''}} @endif>Zulia</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Telefono personal: *</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):$productor->tlf_personal }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_oficina')?'has-error':'' }}">
						<label class="control-label" for="tlf_oficina">Telefono oficina:</label>
						<input id="tlf_oficina" class="form-control" type="text" name="tlf_oficina" value="{{ old('tlf_oficina')?old('tlf_oficina'):$productor->tlf_oficina }}" placeholder="Telefono oficina">
					</div>

					<div class="form-group {{ $errors->has('tlf_administracion')?'has-error':'' }}">
						<label class="control-label" for="tlf_administracion">Telefono administracion:</label>
						<input id="tlf_administracion" class="form-control" type="text" name="tlf_administracion" value="{{ old('tlf_administracion')?old('tlf_administracion'):$productor->tlf_administracion }}" placeholder="Telefono administracion">
					</div>

					<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
						<label class="control-label" for="direccion">Direccion: </label>
						<input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion')?old('direccion'):$productor->direccion }}" placeholder="direccion">
					</div>

					<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
						<label class="control-label" for="contacto">Persona de contacto: </label>
						<input id="contacto" class="form-control" type="text" name="contacto" value="{{ old('contacto')?old('contacto'):$productor->contacto }}" placeholder="Persona de contacto">
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