@extends('layouts.app')
@section('title','Organizaciones - '.config('app.name'))
@section('header','Organizaciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('organizaciones.index')}}">Organizaciones </a> </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form class="" action="{{ url('organizaciones') }}" method="POST" enctype="multipart/form-data">
					{{ method_field('POST') }}
					{{ csrf_field() }}
					<h4>Agregar organizacion</h4>
					<div class="form-group {{ $errors->has('organizacion')?'has-error':'' }}">
						<label class="control-label" for="organizacion">Organizacion: *</label>
						<input id="organizacion" class="form-control" type="text" name="organizacion" value="{{ old('organizacion')?old('organizacion'):''}}" placeholder="Organizacion">
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
						<a class="btn btn-flat btn-default" href="{{route('organizaciones.index')}}"><i class="fa fa-reply"></i> Volver</a>
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