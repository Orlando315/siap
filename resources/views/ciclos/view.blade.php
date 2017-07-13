@extends('layouts.app')
@section('title','Ciclos - '.config('app.name'))
@section('header','Ciclos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('ciclos.index')}}">Ciclos </a> </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('ciclos.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    @if($ciclo->status===1)
	    <a class="btn btn-flat btn-success" href="{{ url('ciclos/'.$ciclo->id.'/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <a class="btn btn-flat btn-primary" href="{{ url('ciclos/add/'.$ciclo->id) }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar unidad</a>
	    <button class="btn btn-flat btn-warning" data-toggle="modal" data-target="#closeModal"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Cerrar ciclo</button>
	    @endif
	    <a class="btn btn-flat btn-default" href="{{ route('reportes.ciclo',['id'=>$ciclo->id])}}"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
	    <!--
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	    -->
		</section>

		<section>
			<div class="row">
				<div class="col-md-12">&nbsp;</div>
				<div class="col-md-12">
					@include('partials.flash')
				</div>
				<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile">
              <p class="text-muted text-center">{{$ciclo->created_at}}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Ciclo</b> <span class="pull-right">{{$ciclo->ciclo}}</span>
                </li>
                <li class="list-group-item">
                  <b>Año</b> <span class="pull-right">{{$ciclo->anio}}</span>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <span class="pull-right">{!! $ciclo->status===1?'<span class="label label-success">Abierto</span>':'<span class="label label-danger">Cerrado</span>' !!}</span>
                </li>
                <li class="list-group-item">
                  <b>Productores</b> <span class="pull-right">{{$ciclo->productores_qty()}}</span>
                </li>
                <li class="list-group-item">
                  <b>Unididades</b> <span class="pull-right">{{$ciclo->unidades_qty()}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-info">
            <div class="box-body">
              <p class="text-center"><b>Leyenda</b></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <p><span class="label label-danger">Nada</span> No se ha iniciado la actividad.</p>
                </li>
                <li class="list-group-item">
                  <p><span class="label label-warning">Medio</span> En proceso.</p>
                </li>
                <li class="list-group-item">
                  <p><span class="label label-success">Completo</span> La actividad fue completada en su totalidad.</p>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
			</div>
			<div class="row">
				@include('partials.box_productores');
			</div>
		</section>

		<div id="closeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel">
	    <div class="modal-dialog modal-danger" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title" id="closeModalLabel">Cerrar ciclo</h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{route('ciclos.index').'/cerrar/'.$ciclo->id}}" method="POST">
	              <input type="hidden" name="_method" value="PATCH">
	              {{ csrf_field() }}
	              <h4 class="text-center">¿Esta seguro de cerrar este ciclo?</h4><br>
	              <p class="text-center help-text">Esta accion no se puede deshacer.</p>
	              <center>
	                <button class="btn btn-flat btn-danger btn-outline" type="submit">Cerrar ciclo</button>
	              </center>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>

		<div id="estModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="estModalLabel">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title" id="estModalLabel">Avanzar <b><span id="actividad"></span></b> </h4>
	        </div>
	        <div class="modal-body">
	          <div class="row">
	            <form class="col-md-8 col-md-offset-2" action="{{route('actividad.avanzar')}}" method="POST">
	              <input type="hidden" name="_method" value="PATCH">
	              <input type="hidden" name="ciclo_id" value="{{$ciclo->id}}">
	              <input id="actividad_id" type="hidden" name="actividad_id" value="0">
	              <input id="campo" type="hidden" name="campo" value="">
	              <input id="opt" type="hidden" name="opt" value="">
	              {{ csrf_field() }}
	              <h4 class="text-center">¿Esta seguro que desea <b><span id="msj"></span></b> esta actividad?</h4><br>
	              <center>
	                <button class="btn btn-flat btn-danger" type="submit">Aceptar</button>
	                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
	              </center>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#estModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var campo  = button.data('campo');
			  var id     = button.data('id');
			  var opt    = button.data('opt');
			  var msj    = '';
			  if(opt>0){
			  	msj = 'Avanzar';
			  }else{
			  	msj = 'Retrasar';
			  }

			  console.log(msj);

			  var modal = $(this);
			  modal.find('#actividad_id').val(id);
			  modal.find('#campo').val(campo);
			  modal.find('#actividad').text(Up(campo.replace("_",". ")));
			  modal.find('#opt').val(opt);
			  modal.find('#msj').text(msj);
			});
		});

		function Up(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
		}
	</script>
@endsection