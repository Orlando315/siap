@extends('layouts.app')
@section('title','Ciclos - '.config('app.name'))
@section('header','Ciclos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('ciclos.index')}}">Ciclos </a> </li>
	  <li class="active">Agregar al ciclo</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ route('ciclos.add_unidad') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4 class="text-center">Agregar productor al ciclo <b>{{$ciclo->ciclo}}</b></h4>
					<input type="hidden" name="ciclo" value="{{$ciclo->id}}">
					
					<div class="form-group {{ $errors->has('unidad')?'has-error':'' }}">
						<label class="control-label" for="unidad">Unidad:</label>
						<p class="help-text">Solo se muestran los productores con unidades registradas.</p>
						<select id="unidad" class="form-control" name="unidad" required>
							<option value="">Seleccione...</option>
							@foreach($productores AS $d)
								@if($d->unidades_qty()>0)
								<optgroup label="{{$d->nombres.' '.$d->apellidos}}">
									@foreach($d->unidades() AS $u)
							    	<option value="{{$u->id}}" @if(old('unidad')) {{ old('unidad')==$u->id?'selected':''}} @endif>- {{$u->unidad}}</option>
							    @endforeach
							  </optgroup>
							 	@endif
							@endforeach
						</select>
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
			$('#unidad').select2();
	  });
	</script>
@endsection