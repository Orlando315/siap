@extends('layouts.app')
@section('title','Unidad - '.config('app.name'))
@section('header','Unidad')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> <a href="{{route('unidades.index')}}">Unidades </a> </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
<!-- Formulario -->
		<section>
	    <a class="btn btn-flat btn-default" href="{{ route('unidades.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
	    <a class="btn btn-flat btn-success" href="{{ route('unidades.edit',[$unidad->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
	    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
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
              <h3 class="profile-username text-center">{{$unidad->productor->nombres." ".$unidad->productor->apellidos}}</h3>

              <p class="text-muted text-center"><a href="{{route('productores.show',[$unidad->productor->id])}}">(Ver productor) </a></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Unidad</b> <span class="pull-right">{{$unidad->unidad}}</span>
                </li>
                <li class="list-group-item">
                  <b>Ubicacion</b> <span class="pull-right">{{$unidad->ubicacion}}</span>
                </li>
                <li class="list-group-item">
                  <b>Lotes</b> <span class="pull-right">{{$unidad->lotes_qty()}}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-9">
        	<div class="box box-danger">
			      <div class="box-header with-border">
			        <h3 class="box-title"><i class="fa fa-braille"></i> Lotes</h3>
			        <span class="pull-right">
			        	<a class="btn btn-flat btn-success" href="{{route('lotes.create').'/'.$unidad->id}}"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Lote</a>
			        </span>
			      </div>
		      	<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Lote</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($lotes as $d)
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$d->lote}}</td>
											<td>{{$d->nombre}}</td>
											<td>
												<a class="btn btn-sm btn-flat btn-success" href="{{route('lotes.edit',[$d->id])}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
												<button class="btn btn-sm btn-flat btn-danger" data-toggle="modal"  data-target="#delLoteModal" data-id="{{$d->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
        </div>
			</div>
		</section>
	</div>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar unidad</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delProduct" class="col-md-8 col-md-offset-2" action="{{route('unidades.destroy',[$unidad->id])}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar esta unidad?</h4><br>
              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


	<div id="delLoteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delLoteModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delLoteModalLabel">Eliminar Lote</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form id="delLote" class="col-md-8 col-md-offset-2" action="#" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="id" value="0">
              <h4 class="text-center">¿Esta seguro de eliminar este lote?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
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
			$('#delLoteModal').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget);
			  var id     = button.data('id');

			  var modal = $(this);
			  modal.find('#lote').val(id);
			  modal.find('#delLote').attr('action',"{{route('lotes.index')}}/"+id);
			});
		});
	</script>
@endsection