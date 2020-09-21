@extends('roles.student.achievements.layout')

@section('achievements_layout')
<div class="row p-2 pl-md-4 pr-md-3" ng-controller="achievementsStudentCtrl" ng-init="initSequences(1)" >
    @if(isset($sequence))
        <div class="col-12 pr-sm-0">
            <div class="oval-line"></div>
            <button class="btn btn-sm fs-1">
                <a href="{{route('student.achievements',auth('afiliadoempresa')->user()->company_name())}}"><i class="fas fa-arrow-left"></i>
                </a>
            </button>
            <div class="row">
                <div class="col-auto">
                    <img class="imagen-sequence" src="{{asset($sequence['url_image'])}}" width="80px" height= "100px"/>
                </div>
                <div class="col-5 col-xl-4 mr-2 ml-2 fs--1">
                    <p class="font-weight-bold mb-1">Guía de aprendizaje</p>
                    <p class="fs-0" >{{$sequence['name']}}</p>
                </div>
                <div class="col-1 mt-3 mt-md-0 ml-5 ml-md-0" style="min-width: 186px;">
                     <label class="mt-md-fix" style="margin-left: -21px;"><strong> Progreso</strong></label> 
                    @if(isset($sequence['progress']))
                        @if($sequence['progress']==0)   
                            <i class="fa fa-circle mr-2 fs-1" style="color:#706B66" aria-hidden="true"></i><label class="">Sin iniciar</label>
                        @endif
                        @if($sequence['progress']>0 && $sequence['progress']<100)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#F9E538" aria-hidden="true"></i> <label class="">En proceso</label>
                        @endif
                        @if($sequence['progress']==100)
                        <i class="fa fa-circle mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> <label class="">Concluida</label>
                        @endif
                    @else
                        <i class="fa fa-circle mr-2 fs-1" style="color:#706B66" aria-hidden="true"></i><label class="">Sin iniciar</label>
                    @endif  
                    @if($sequence['progress']>0 && $rating_plan_type != 3 ) 
                        <label class="" style="margin-left: -35px;"><strong> Desempeño</strong></label> 
                        @if($sequence['performance'] >= 0)
                            @if($sequence['performance']>=90)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> (S)
                            @endif
                            @if($sequence['performance']>=70 && $sequence['performance']<=89)
                            <i class="fa fa-circle  mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> (A)
                            @endif
                            @if($sequence['performance']>=60 && $sequence['performance']<=69)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#F9E538" aria-hidden="true"></i> (B)
                            @endif
                            @if($sequence['performance']>=40 && $sequence['performance']<=59)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#AC312A" aria-hidden="true"></i> (B)
                            @endif
                            @if($sequence['performance']<40)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#AC312A" aria-hidden="true"></i> (B)
                            @endif 
                            <span class="fs-0">{{$sequence['performance']}} %</span>
                        @else
                            <i class="fa fa-circle mr-2 fs-1" style="color:#706B66" aria-hidden="true"></i><label class="">Sin iniciar</label>
                        @endif
                    @endif
                </div>
                <div class="col-12 col-xl-4 row mt-4 mt-xl-0 text-align " style="min-width: 408px;">
                    <div class="col-4 border-left-mini"> 
                        <div class="mb-2">
                            <a href="{{
                            route('student.achievements.sequence',
                            ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                                'affiliated_account_service_id'=>$affiliated_account_service_id,
                                'sequence_id'=>$sequence['id']
                            ])}}">
                                <img src="{{asset('images/icons/reporteSecuencias.png')}}" class="imagen-reports-type-mini"  width="45px" height= "auto"/>
                            </a>
                        </div>
                        <a href="{{
                        route('student.achievements.sequence',
                        ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                            'affiliated_account_service_id'=>$affiliated_account_service_id,
                            'sequence_id'=>$sequence['id']
                        ])}}">
                            <label class="cursor-pointer font-weight-bold fs--1" style="width: 102px;">Reporte por guía de aprendizaje</label>
                        </a>
                    </div>

                    <div class="col-4 border-left-mini"> 
                        <div class="mb-2">
                            <a href="{{
                            route('student.achievements.moment',
                            ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                                'affiliated_account_service_id'=>$affiliated_account_service_id,
                                'sequence_id'=>$sequence['id']
                            ])}}">
                                <img src="{{asset('images/icons/reporteMomentos.png')}}" class="imagen-reports-type-mini"  width="45px" height= "auto"/>
                            </a>
                        </div>
                        <a href="{{
                        route('student.achievements.moment',
                        ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                            'affiliated_account_service_id'=>$affiliated_account_service_id,
                            'sequence_id'=>$sequence['id']
                        ])}}">
                            <label class="cursor-pointer font-weight-bold fs--1" style="width: 102px;">Reporte por momento</label>
                        </a>
                    </div> 
                    <div class="col-4 border-left-mini"> 
                        <div class="mb-2">
                            <a href="{{
                                route('student.achievements.question',
                                ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                                'affiliated_account_service_id'=>$affiliated_account_service_id,
                                'sequence_id'=>$sequence['id']
                                ])}}"> 
                                <img src="{{asset('images/icons/reportePreguntas.png')}}" class="imagen-reports-type-mini"  width="45px" height= "auto"/>
                            </a>
                        </div>
                        <a href="{{
                            route('student.achievements.question',
                            ['empresa'=>auth('afiliadoempresa')->user()->company_name(),
                            'affiliated_account_service_id'=>$affiliated_account_service_id,
                            'sequence_id'=>$sequence['id']
                            ])}}"> 
                            <label class="cursor-pointer font-weight-bold fs--1" style="width: 102px;">Reporte por preguntas</label>
                        </a>
                    </div> 
                </div> 
            </div> 
            <h5 class="mt-3  mb-3">Reporte por guía de aprendizaje</h5>
            <div>
            @foreach ($moments as $key => $moment)
               <div class="row p-3  rounded @if($key%2==0) bg-soft-dark @else bg-soft-dark-light @endif @if(!$moment['isAvailable']) disabled-moment @endif">
                    <div class="col-8 col-md-6">
                        <span class="fs--1"> Momento {{$moment['order']}}</span>
                        <h5 class="col-6 fs--1"> Momento {{$moment['name']}}</span>
                    </div>

                    <span class="font-weight-normal col-2-5 col-md-3 fs-0">
                    @if($moment['isAvailable'])
                       <label class=""><strong>Progreso</strong></label> 
                        @if($moment['progress']==0)
                        <i class="fa fa-circle mr-2" style="color:#706B66" aria-hidden="true"></i><label class="">Sin iniciar</label>
                        @endif
                        @if($moment['progress']>0 && $moment['progress']<100)
                        <i class="fa fa-circle  mr-2" style="color:#F9E538" aria-hidden="true"></i> <label class="">En proceso</label>
                        @endif
                        @if($moment['progress']==100)
                        <i class="fa fa-circle mr-2" style="color:#6CB249" aria-hidden="true"></i> <label class="">Concluida</label>
                        @endif
                    @else
                        <label class="">No habilitada</label>
                    @endif
                    </span>
                    
                    <span class="font-weight-bold col-3 fs-0">
                    @if($moment['isAvailable'])
                        @if($rating_plan_type != 3)
                            <label class=""><strong>Desempeño</strong></label>
                            @if($moment['performance'] >= 0  )
                                @if($moment['performance']>=90)
                                <i class="fa fa-circle mr-2" style="color:#6CB249" aria-hidden="true"></i> (S) 
                                @endif
                                @if($moment['performance']>=70 && $moment['performance']<=89)
                                <i class="fa fa-circle  mr-2" style="color:#6CB249" aria-hidden="true"></i> (A)
                                @endif
                                @if($moment['performance']>=60 && $moment['performance']<=69)
                                <i class="fa fa-circle mr-2" style="color:#F9E538" aria-hidden="true"></i> (B)
                                @endif
                                @if($moment['performance']>=40 && $moment['performance']<=59)
                                <i class="fa fa-circle mr-2" style="color:#AC312A" aria-hidden="true"></i> (B)
                                @endif
                                @if($moment['performance']<40)
                                <i class="fa fa-circle mr-2" style="color:#AC312A" aria-hidden="true"></i> (B)
                                @endif
                                {{$moment['performance']}} %
                            @else
                                <i class="fa fa-circle mr-2" style="color:#706B66" aria-hidden="true"></i><label class="">Sin iniciar</label>
                            @endif
                        @endif    
                    @endif    
                    </span>

               </div>
            @endforeach
            <div>

            </div>
        </div>
    @else 
        <div class="col-12 sequences-line" ng-show="sequences.length === 0">
            <div class="oval-line mb-4"></div>
            <h6>Aún no cuentas con la guías de aprendizaje seleccionada.</h6>
        </div>
    @endif

</div>
@endsection
@section('js')
    <script src="{{asset('/../angular/controller/achievementsStudentCtrl.js')}}"></script>
@endsection
