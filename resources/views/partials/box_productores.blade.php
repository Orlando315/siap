@foreach($productores AS $d)
	{{$ciclo->reset()}}
	<div class="col-md-12">
  	<div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
        	<i class="fa fa-user-circle"></i>{{$d->productor->nombres." ".$d->productor->apellidos}}
        	<small><a href="{{route('productores.index').'/'.$d->id}}">(Ver detalles)</a></small>
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
      					<th class="text-center" width="10%">Suelo</th>
      					<th class="text-center" width="10%">Lab. Suelo</th>
      					<th class="text-center" width="10%">Planificacion</th>
      					<th class="text-center" width="10%">Vuelo</th>
      					<th class="text-center" width="10%">Tejido</th>
      					<th class="text-center" width="10%">Lab. Tejido</th>
      					<th class="text-center" width="10%">Esp. Tejido</th>
      					<th class="text-center" width="10%">Procesamiento</th>
      					<th class="text-center" width="10%">Mapa</th>
      					<th class="text-center" width="10%">Attr.</th>
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->suelo>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="suelo" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->suelo,'suelo')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->suelo< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="suelo" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->lab_suelo>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="lab_suelo" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->lab_suelo,'lab_suelo')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->lab_suelo< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="lab_suelo" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->planificacion>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="planificacion" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->planificacion,'planificacion')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->planificacion< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="planificacion" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->vuelo>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="vuelo" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->vuelo,'vuelo')!!}
    							@if($ciclo->status===1)
      						{!!$u->actividad->vuelo< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="vuelo" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
   	   						{!!$u->actividad->tejido>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="tejido" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->tejido,'tejido')!!}
    							@if($ciclo->status===1)
  	    						{!!$u->actividad->tejido< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="tejido" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
    	  						{!!$u->actividad->lab_tejido>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="lab_tejido" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->lab_tejido,'lab_tejido')!!}
    							@if($ciclo->status===1)
    	  						{!!$u->actividad->lab_tejido< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="lab_tejido" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->esp_tejido>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="esp_tejido" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->esp_tejido,'esp_tejido')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->esp_tejido< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="esp_tejido" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->procesamiento>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="procesamiento" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->procesamiento,'procesamiento')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->procesamiento< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="procesamiento" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->mapa_web>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="mapa_web" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->mapa_web,'mapa_web')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->mapa_web< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="mapa_web" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
      					<td class="text-center">
      						@if($ciclo->status===1)
      							{!!$u->actividad->attr_web>0?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="attr_web" data-id="'.$u->actividad->id.'" data-opt="-1"><i class="fa fa-caret-square-o-left"></i></button>':''!!}
      						@endif
      						{!!$ciclo->valoracion($u->actividad->attr_web,'attr_web')!!}
    							@if($ciclo->status===1)
      							{!!$u->actividad->attr_web< 2?'<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#estModal" data-campo="attr_web" data-id="'.$u->actividad->id.'" data-opt="1"><i class="fa fa-caret-square-o-right"></i></button>':''!!}
      						@endif
      					</td>
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
      					<th class="text-center" width="10%">Attr.</th>
      				</tr>
      			</thead>
      			<tbody>
      				<tr>
      					<td class="text-center">
      						{!!$ciclo->promedio('suelo')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('lab_suelo')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('planificacion')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('vuelo')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('tejido')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('lab_tejido')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('esp_tejido')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('procesamiento')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('mapa_web')!!}
      					</td>
      					<td class="text-center">
      						{!!$ciclo->promedio('attr_web')!!}
      					</td>
      				</tr>
      			</tbody>
      		</table>
      	</div>
			</div>
		</div>
  </div>
@endforeach