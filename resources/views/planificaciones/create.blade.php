@extends('layouts.app')
@section('title','Planificaciones - '.config('app.name'))
@section('header','Planificaciones')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('planificaciones.index')}}">Planificaciones </a> </li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
	<!-- Formulario -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form id="test" class="" action="{{route('planificaciones.store')}}" method="POST">
				{{ method_field('POST') }}
				{{ csrf_field() }}
				<h4>Agregar planificacion</h4>
				<div class="form-group {{ $errors->has('productor_id')?'has-error':'' }}">
					<label class="control-label" for="productor_id">Productor: *</label>
					<select id="productor_id" class="form-control" name="productor_id" required>
						<option value="">Seleccione...</option>
						@foreach($productores AS $d)
							<option value="{{$d->id}}">{{$d->nombres." ".$d->apellidos}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group {{$errors->has('unidad')?'has-error':''}}">
					<label class="control-label" for="unidad">Unidad de Producción: *</label>
					<select id="unidad" class="form-control" name="unidad" required disabled>
					</select>
				</div>

				<div class="form-group {{$errors->has('lote')?'has-error':''}}">
					<label class="control-label" for="lote">Lote: *</label>
					<select id="lote" class="form-control" name="lote" required disabled>
					</select>
				</div>

				<div class="form-group {{$errors->has('fecha_siembra')?'has-error':''}}"">
					<label class="control-label" for="fecha_siembra">Fecha de siembra: *</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						<input id="fecha_siembra" type="text" class="form-control" name="fecha_siembra" style="width:100px" required>
					</div>
				</div>

				<div class="form-group {{$errors->has('variacion')?'has-error':''}}"">
					<label class="control-label" for="variacion">Variacion:</label>
					<input id="variacion" type="text" class="form-control" name="variacion">
				</div>

				<div class="form-group {{$errors->has('cultivo')?'has-error':''}}"">
					<label class="control-label" for="cultivo">Cultivo:</label>
					<input id="cultivo" type="text" class="form-control" name="cultivo">
				</div>

				<div class="form-group {{$errors->has('superficie')?'has-error':''}}"">
					<label class="control-label" for="superficie">Superficie:</label>
					<input id="superficie" type="text" class="form-control" name="superficie">
				</div>

				<div class="form-group {{$errors->has('fecha_vuelo')?'has-error':''}}"">
					<label class="control-label" for="fecha_vuelo">Fecha de Vuelo/Muestreo: *</label>
					<input id="fecha_vuelo" type="text" class="form-control" name="fecha_vuelo" required>
				</div>

				<div class="form-group {{$errors->has('plan')?'has-error':''}}"">
					<label class="control-label" for="plan">Plan de vuelo:</label>
					<input id="plan" type="text" class="form-control" name="plan">
				</div>

				<div class="form-group {{$errors->has('superficie_planteada')?'has-error':''}}"">
					<label class="control-label" for="superficie_planteada">Superficie planteada:</label>
					<input id="superficie_planteada" type="text" class="form-control" name="superficie_planteada">
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
					<a class="btn btn-flat btn-default" href="{{route('planificaciones.index')}}"><i class="fa fa-reply"></i> Volver</a>
					<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

			$('#fecha_siembra').datepicker({
				autoclose: true,
  			format: "dd-mm-yyyy",
  			endtDate: 'today'
			});

			$('#fecha_vuelo').datepicker({
				autoclose: true,
  			format: "dd-mm-yyyy",
  			startDate: 'today'
			});

			$('#productor_id').change(function(){
				var productor = $(this).val();
				$.ajax({
					type: 'POST',
	 				cache: false,
	 				url: "{{route('unidades.search')}}",
	 				data : $('#test').serialize(),
	 				dataType: 'JSON',
					success: function(r){
						$('#lote').empty().prop('disabled',true);
						if(r.length>0){
							$('#unidad').empty().prop('disabled',false).append('<option value="">Seleccione...</option>');
							$.each(r,function(k,v){
								$('#unidad').append('<option value="'+v.id+'">'+v.unidad+'</option>');
							});
						}else{
							$('#unidad').empty().prop('disabled',true);
						}
					},
					error: function(){
					},
					complete: function(){

					}
				});
			});

			$('#unidad').change(function(){
				var unidad = $(this).val();
				$.ajax({
					type: 'POST',
	 				cache: false,
	 				url: "{{route('lotes.search')}}",
	 				data : $('#test').serialize(),
	 				dataType: 'JSON',
					success: function(r){
						if(r.length>0){
							$('#lote').empty().prop('disabled',false).append('<option value="">Seleccione...</option>');
							$.each(r,function(k,v){
								$('#lote').append('<option value="'+v.id+'">'+v.lote+' | '+(v.nombre?v.nombre:'(Sin nombre)')+'</option>');
							});
						}else{
							$('#lote').empty().prop('disabled',true);
						}
					},
					error: function(){
					},
					complete: function(){

					}
				});
			});
			

			$('#productor_id').change();

	  });//

	</script>
@endsection