@extends('layouts.app')
@section('title','Tenicos - '.config('app.name'))
@section('header','Tenicos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('tecnicos.index')}}">Tenicos </a> </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('tecnicos') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Agregar tecnico</h4>
					<div class="form-group {{ $errors->has('nombres')?'has-error':'' }}">
						<label class="control-label" for="nombres">Nombres: *</label>
						<input id="nombres" class="form-control" type="text" name="nombres" value="{{ old('nombres')?old('nombres'):''}}" placeholder="Nombres">
					</div>
					
					<div class="form-group {{ $errors->has('apellidos')?'has-error':'' }}">
						<label class="control-label" for="apellidos">Apellidos: *</label>
						<input id="apellidos" class="form-control" type="text" name="apellidos" value="{{ old('apellidos')?old('apellidos'):''}}" placeholder="Apellidos">
					</div>

					<div class="form-group {{ $errors->has('cedula')?'has-error':'' }}">
						<label class="control-label" for="cedula">Cedula: *</label>
						<input id="cedula" class="form-control" type="text" name="cedula" value="{{ old('cedula')?old('cedula'):''}}" placeholder="Cedula">
					</div>

					<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
						<label class="control-label" for="email">Email: *</label>
						<input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email">
					</div>

					<div class="form-group {{ $errors->has('estado')?'has-error':'' }}">
						<label class="control-label" for="estado">Estado: *</label>
						<select id="estado" class="form-control" name="estado">
							<option selected="selected" value="">Seleccione...</option>
							<option value="Amazonas" @if(old('estado')) {{ old('estado')=='Amazonas'?'selected':''}} @endif>Amazonas</option>
							<option value="Anzoategui" @if(old('estado')) {{ old('estado')=='Anzoategui'?'selected':''}} @endif>Anzoátegui</option>
							<option value="Apure" @if(old('estado')) {{ old('estado')=='Apure'?'selected':''}} @endif>Apure</option>
							<option value="Aragua" @if(old('estado')) {{ old('estado')=='Aragua'?'selected':''}} @endif>Aragua</option>
							<option value="Barinas" @if(old('estado')) {{ old('estado')=='Barinas'?'selected':''}} @endif>Barinas</option>
							<option value="Bolivar" @if(old('estado')) {{ old('estado')=='Bolivar'?'selected':''}} @endif>Bolívar</option>
							<option value="Carabobo" @if(old('estado')) {{ old('estado')=='Carabobo'?'selected':''}} @endif>Carabobo</option>
							<option value="Cojedes" @if(old('estado')) {{ old('estado')=='Cojedes'?'selected':''}} @endif>Cojedes</option>
							<option value="Delta Amacuro" @if(old('estado')) {{ old('estado')=='Delta Amacuro'?'selected':''}} @endif>Delta Amacuro</option>
							<option value="Distrito Capital" @if(old('estado')) {{ old('estado')=='Distrito Capital'?'selected':''}} @endif>Distrito Capital</option>
							<option value="Falcon" @if(old('estado')) {{ old('estado')=='Falcon'?'selected':''}} @endif>Falcón</option>
							<option value="Guarico" @if(old('estado')) {{ old('estado')=='Guarico'?'selected':''}} @endif>Guárico</option>
							<option value="Lara" @if(old('estado')) {{ old('estado')=='Lara'?'selected':''}} @endif>Lara</option>
							<option value="Merida" @if(old('estado')) {{ old('estado')=='Merida'?'selected':''}} @endif>Mérida</option>
							<option value="Miranda" @if(old('estado')) {{ old('estado')=='Miranda'?'selected':''}} @endif>Miranda</option>
							<option value="Monagas" @if(old('estado')) {{ old('estado')=='Monagas'?'selected':''}} @endif>Monagas</option>
							<option value="Nueva Esparta" @if(old('estado')) {{ old('estado')=='Nueva Esparta'?'selected':''}} @endif>Nueva Esparta</option>
							<option value="Portuguesa" @if(old('estado')) {{ old('estado')=='Portuguesa'?'selected':''}} @endif>Portuguesa</option>
							<option value="Sucre" @if(old('estado')) {{ old('estado')=='Sucre'?'selected':''}} @endif>Sucre</option>
							<option value="Tachira" @if(old('estado')) {{ old('estado')=='Tachira'?'selected':''}} @endif>Tachira</option>
							<option value="Trujillo" @if(old('estado')) {{ old('estado')=='Trujillo'?'selected':''}} @endif>Trujillo</option>
							<option value="Vargas" @if(old('estado')) {{ old('estado')=='Vargas'?'selected':''}} @endif>Vargas</option>
							<option value="Yaracuy" @if(old('estado')) {{ old('estado')=='Yaracuy'?'selected':''}} @endif>Yaracuy</option>
							<option value="Zulia" @if(old('estado')) {{ old('estado')=='Zulia'?'selected':''}} @endif>Zulia</option>
						</select>
					</div>

					<div class="form-group {{ $errors->has('tlf_personal')?'has-error':'' }}">
						<label class="control-label" for="tlf_personal">Telefono personal: *</label>
						<input id="tlf_personal" class="form-control" type="text" name="tlf_personal" value="{{ old('tlf_personal')?old('tlf_personal'):'' }}" placeholder="Telefono personal">
					</div>

					<div class="form-group {{ $errors->has('tlf_opcional')?'has-error':'' }}">
						<label class="control-label" for="tlf_opcional">Telefono opcional:</label>
						<input id="tlf_opcional" class="form-control" type="text" name="tlf_opcional" value="{{ old('tlf_opcional')?old('tlf_opcional'):'' }}" placeholder="Telefono opcional">
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
						<a class="btn btn-flat btn-default" href="{{route('tecnicos.index')}}"><i class="fa fa-reply"></i> Volver</a>
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