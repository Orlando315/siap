@extends('layouts.app')

@section('title','Ciclos - '.config('app.name'))
@section('header','Ciclos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ciclos </li>
	</ol>
@endsection
@section('content')

<div class="content">
	<section>
		<a class="btn btn-flat btn-default" href="{{ route('ciclos.index') }}"><i class="fa fa-reply"></i> Volver</a>
	</section>

	<section>
		<div class="row">
			<div class="col-md-12">&nbsp;</div>
			<div class="col-md-8 col-md-offset-2">
        <div class="box box-danger">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-spinner"></i> Ciclos - Busqueda</h3>
		      </div>
	      	<div class="box-body">
	      		<div class="row">
	      			<div class="col-md-12">
			      		<form id="form-search" action="" method="POST">
			      			{{ csrf_field() }}
			      			<div class="col-md-8 col-md-offset-2">
					        	<div class="form-group">
											<label class="control-label" for="ciclo">Ciclo: *</label>
											<select id="ciclo" class="form-control" name="ciclo" required>
												<option value="">Seleccion...</option>
												@foreach($ciclos AS $d)
													<option value="{{$d->id}}">{{$d->anio." | ".$d->ciclo}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label class="control-label" for="ciclo">Organizaciones: </label>
											<select id="organizacion" class="form-control" name="organizacion" disabled>
												<option value="">Seleccion...</option>
											</select>											
										</div>
										<div class="form-group">
											<label class="control-label" for="productores">Resumen: *</label>
											<input type="checkbox" value="true" name="resumen">
											<p class="help-text">Mostrar solo el resumen</p>
										</div>
										<hr>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label" for="productores">Productores: *</label>
											<div id="productores" style="border:1px solid #ccc; padding: 10px">
											</div>
										</div>
									</div>
									<div class="col-md-6 col-md-offset-3">
								    <div class="alert alert-danger" style="display:none">
								      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								      <strong class="text-center">Debe seleccionar un productor</strong> 
								  	</div>
								  </div>
									<center>
										<input id="buscar" class="btn btn-flat btn-block btn-success" type="submit" value="Buscar">
									</center>
				        </form>
				    	</div>
				    </div>
					</div>
					<div class="overlay" style="display:none">
					  <i class="fa fa-refresh fa-spin"></i>
					</div>
				</div>
      </div>
		</div>

		<div class="row" id="box-productores">
			
		</div>
	</section>
</div>
@endsection

@section('script')
 	<script type="text/javascript">
	 	$(document).ready(function(){
	 		$('#ciclo').on('change',function(){
	 			if($('#ciclo').val() != ""){
		 			$('.overlay').show();
		 			var form = $('#form-search');
		 			$.ajax({
		 				type: 'POST',
		 				cache: false,
		 				url: "{{route('ciclos.searchProductores')}}",
		 				data : form.serialize(),
		 				dataType: 'JSON',
		 				success: function(r){
		 					$('#productores').empty();
		 					if(r.organizaciones.length > 0){
		 						console.log(r.organizaciones);
			 					$('#organizacion').prop('disabled',false);
			 					$('#organizacion').empty();
			 					$('#organizacion').append('<option value="" name="organizacion">Seleccione...</option>');
			 					$.each(r.organizaciones,function(k,v){
			 						$('#organizacion').append('<option value="'+v.id+'" name="organizacion">'+v.organizacion+'</option>');
			 					});
		 					}else{
		 						$('#organizacion').prop('disabled',true);
		 					}

		 					if(r.productores.length > 0){
		 						$('#buscar').prop('disabled',false);
			 					$.each(r.productores,function(k,v){
			 						$('#productores').append('<label class="checkbox-inline"><input type="checkbox" id="'+v.id+'" class="check-p" value="'+v.id+'" name="productores[]">'+v.nombre+'</label>');
			 					});
			 				}else{
			 					$('#buscar').prop('disabled',true);
			 					$('#productores').append('<p class="text-center bg-danger">No hay productores en este ciclo.</p>');
			 				}
		 				},
		 				complete: function(){
		 					$('.overlay').hide();
		 				}
		 			});
		 		}
	 		});

	 		$('#organizacion').on('change',function(){
	 			if($('#ciclo').val() != ""){
		 			$('.overlay').show();
		 			var form = $('#form-search');
		 			$.ajax({
		 				type: 'POST',
		 				cache: false,
		 				url: "{{route('ciclos.searchProductores')}}",
		 				data: form.serialize(),
		 				dataType: 'JSON',
		 				success: function(r){
		 					$('#productores').empty();
		 					if(r.productores.length > 0){
		 						$('#buscar').prop('disabled',false);
			 					$.each(r.productores,function(k,v){
			 						$('#productores').append('<label class="checkbox-inline"><input type="checkbox" id="'+v.id+'" class="check-p" value="'+v.id+'" name="productores[]">'+v.nombre+'</label>');
			 					});
			 				}else{
			 					$('#buscar').prop('disabled',true);
			 					$('#productores').append('<p class="text-center bg-danger">No hay productores en este ciclo.</p>');
			 				}
		 				},
		 				complete: function(){
		 					$('.overlay').hide();
		 				}
		 			});
		 		}
	 		});

	 		$('#form-search').on('submit',function(e){
	 			e.preventDefault();
	 			if(!$(".check-p").is(':checked')){
	 				$('#box-productores').html('');
	 				$('.alert').show().delay(3000).hide('slow');
	 			}else{
	 				$('.overlay').show();
		 			var form = $('#form-search');
		 			$.ajax({
		 				type: 'POST',
		 				cache: false,
		 				url: "{{route('ciclos.searchProductores')}}/true",
		 				data : form.serialize(),
		 				success: function(r){
		 					$('#box-productores').html(r);
		 				},
		 				complete: function(){
		 					$('.overlay').hide();
		 				}
		 			});
	 			}	
	 		});
	 	});
 	</script>
@endsection