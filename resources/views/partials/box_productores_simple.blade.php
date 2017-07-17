@foreach($productores AS $d)
	{{$ciclo->reset()}}
  <h3 style="margin:0">
  	{{$d->productor->nombres." ".$d->productor->apellidos}}
  </h3>
	@foreach($ciclo->unidades($d->productor_id) AS $u)
	{{$ciclo->iteraciones($loop->count)}}
	@if($resumen===false)
		<div >
			<table class="table table-bordered table-condensed" style="margin:0;position:relative;">
				<thead>
					<tr>
						<th class="text-center bg-primary" colspan="10">
							<h4 style="padding:0;margin:0">{{$u->unidad->unidad}}</h4>
						</th>
					</tr>
  				<tr>
  				@foreach($u->actividades() AS $actividad)
  					<th class="text-center th-pdf" width="10%">{{$actividad->actividad}}</th>
  				@endforeach
  				</tr>
				</thead>
				<tbody>
  				<tr>
  				@foreach($u->actividades() AS $actividad)
  					<td class="text-center" style="font-size: 12px !important">
  						{!!$ciclo->valoracion($actividad->status,$actividad->actividad,true)!!}
  					</td>
  				@endforeach
  				</tr>
					</tr>
				</tbody>
			</table>
		</div>
	@endif
	@endforeach
	<div >
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th class="text-center" colspan="10" style="background-color:#373737">
						<h4 style="padding:0;margin:0;color:#fff">RESUMEN</h4>
					</th>
				</tr>
				<tr>
					<th class="text-center th-pdf" width="10%">Suelo</th>
					<th class="text-center th-pdf" width="10%">Lab. Suelo</th>
					<th class="text-center th-pdf" width="10%">Planificacion</th>
					<th class="text-center th-pdf" width="10%">Vuelo</th>
					<th class="text-center th-pdf" width="10%">Tejido</th>
					<th class="text-center th-pdf" width="10%">Lab. Tejido</th>
					<th class="text-center th-pdf" width="10%">Esp. Tejido</th>
					<th class="text-center th-pdf" width="10%">Procesamiento</th>
					<th class="text-center th-pdf" width="10%">Mapa</th>
					<th class="text-center th-pdf" width="10%">Attr</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('suelo',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('lab_suelo',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('planificacion',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('vuelo',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('tejido',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('lab_tejido',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('esp_tejido',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('procesamiento',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('mapa',true)!!}
					</td>
					<td class="text-center" style="font-size: 12px !important">
						{!!$ciclo->promedio('attr',true)!!}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@endforeach