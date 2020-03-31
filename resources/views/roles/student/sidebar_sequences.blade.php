<div class="pr-2 bg-light d-flex justify-content-between card-header">
	@isset($sequence)
	<h6 class="mb-0">Secuencia {{$sequence->name}}</h6>
	@endif
</div>
<div class="card-body">
@if(isset($sequence))
	<div class="mb-3 fs--1 text-justify">
		<span><strong>Los invitamos a:</strong></span>
		@if ($sequence->objetives != "")
		<ul class="navbar-nav flex-column">
		  @foreach(explode('|', $sequence->objetives) as $obj) 
			<li class="nav-item list-style-inside">
				<span>{{$obj}}</span>
			</li>
		  @endforeach
		</ul> 
		@endif
	</div>
	<nav class="pr-sm-6 pl-sm-6 pr-md-2 pl-md-2 pr-lg-3 pl-lg-3 fs--2 font-weight-semi-bold row navbar text-center">
		<a class="cursor-pointer" href="{{route('student.sequences_section_1',['empresa'=>auth('afiliadoempresa')->user()->company_name(), 'sequence_id' => $sequence->id])}}">
			<img src="{{asset('/images/icons/situacionGeneradora_Mesa de trabajo 1.png')}}" height= "auto" width="50px">
			<span class="d-flex" style="top: 69px;width: 45px;">Situación Generadora</span>
		</a>
		<a class="cursor-pointer" href="{{route('student.sequences_section_2',['empresa'=>auth('afiliadoempresa')->user()->company_name(), 'sequence_id' => $sequence->id])}}">
			<img src="{{asset('/images/icons/rutaViaje_Mesa de trabajo 1.png')}}" height= "auto" width="50px">
			<span class="d-flex" style="top: 69px;width: 45px;">Mapa de ruta</span>
		</a>
		<div class="cursor-pointer mt-md-2">
			<img src="{{asset('/images/icons/iconoGuiaSaberes_Mesa de trabajo 1.png')}}" height= "auto" width="50px">
			<span class="d-flex" style="top: 69px;width: 45px;">Guía de saberes</span>
		</div>
		<div class="cursor-pointer mt-md-2">
			<img src="{{asset('/images/icons/puntoEncuentro_Mesa de trabajo 1.png')}}" height= "auto" width="50px">
			<span class="d-flex" style="top: 69px;width: 45px;">Punto de encuentro</span>
		</div>
	</nav>
@endif
</div>
