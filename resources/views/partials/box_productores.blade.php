@foreach($productores AS $d)
	{{$ciclo->reset()}}
	<div class="col-md-12">
  	<div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
        	<i class="fa fa-id-card-o"></i>
        	<a href="{{route('productores.index').'/'.$d->productor_id}}">
        		{{$d->productor->nombres." ".$d->productor->apellidos}}
        	</a>
        	@if(!$tecnico)
        	&nbsp;&nbsp;|&nbsp;&nbsp;
        	<i class="fa fa-user-circle"></i>
        	<a href="{{route('tecnicos.index').'/'.$d->productor->tecnico_id}}">
        		{{$d->productor->tecnico->nombres." ".$d->productor->tecnico->apellidos}}
        	</a>
        	&nbsp;&nbsp;
        	<a href="{{route('ciclos.tecnico',['ciclo'=>$ciclo->id,'tecnico'=>$d->productor->tecnico_id])}}" style="color:#444">
        		<i class="fa fa-search-plus"></i>	
        	</a>
        	@endif
        </h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
    	<div class="box-body" style="padding:0">
    		@foreach($ciclo->unidades($d->productor_id) AS $u)
    		{{$ciclo->iteraciones($loop->count)}}
    		@if($resumen===false)
    		<div class="col-md-12" style="padding:0;">
      		<table class="table table-bordered table-condensed" style="margin:0">
      			<thead>
							<tr>
								<th class="text-center bg-primary" colspan="10">
									<h4 style="padding:0;margin:0">{{$u->unidad->unidad}}
										<small><a href="{{route('unidades.index').'/'.$u->unidad->id}}" style="color:#fff"> (Ver detalles)</a></small>
									</h4>
								</th>
							</tr>
      				<tr>
      				@foreach($u->actividades() AS $actividad)
      					<th class="text-center" width="10%">{{$actividad->actividad}}</th>
      				@endforeach
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      				@foreach($u->actividades() AS $actividad)
      					<td class="text-center btn-arrows">
      						@if($ciclo->status===1 AND $update === true)
      							{!!$actividad->status>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="'.$actividad->actividad.'" data-id="'.$actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($actividad->status,$actividad->actividad,false,$actividad->fecha1,$actividad->fecha2)!!}
    							@if($ciclo->status===1 AND $update === true)
      							{!!$actividad->status<2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="'.$actividad->actividad.'" data-id="'.$actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      				@endforeach
      				</tr>
      			</tbody>
      		</table>
      	</div>
      	@endif
      	@endforeach
      	<div class="col-md-12" style="padding:0;">
      		<table class="table table-bordered table-condensed">
      			<thead>
							<tr>
								<th class="text-center" colspan="10" style="background-color:#373737"><h4 style="padding:0;margin:0;color:#fff">RESUMEN</h4></th>
							</tr>
      				<tr>
      					<th class="text-center" width="10%">Suelo</th>
      					<th class="text-center" width="10%">Lab. Suelo</th>
      					<th class="text-center" width="10%">Planificacion</th>
      					<th class="text-center" width="10%">Vuelo</th>
      					<th class="text-center" width="10%">Tejido</th>
      					<th class="text-center" width="10%">Lab. Tejido</th>
      					<th class="text-center" width="10%">Esp. Tejido</th>
      					<th class="text-center" width="10%">Procesamiento</th>
      					<th class="text-center" width="10%">Mapa</th>
      					<th class="text-center" width="10%">Attr</th>
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      					<td class="text-center">
      						{!!$ciclo->promedio('suelo',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('lab_suelo',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('planificacion',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('vuelo',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('tejido',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('lab_tejido',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('esp_tejido',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('procesamiento',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('mapa',true)!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('attr',true)!!}
      					</td>
      				</tr>
      			</tbody>
      		</table>
      	</div>
			</div>
		</div>
  </div>
@endforeach