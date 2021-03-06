@extends('roles.student.achievements.layout')

@section('achievements_layout')
<div class="row p-2 pl-md-4 pr-md-3" ng-controller="achievementsStudentCtrl" ng-init="initSequences(1)" >
    @if(isset($sequence))
        <div class="col-12 mt-sm-2 pr-sm-0 " >
            <div class="oval-line"></div>
            <button class="btn btn-sm fs-1">
                <a href="{{route('student.achievements',auth('afiliadoempresa')->user()->company_name())}}"><i class="fas fa-arrow-left"></i>
                </a>
            </button>
            <div class="row">
                <div class="col-auto">
                    <img class="imagen-sequence" src="{{asset($sequence['url_image'])}}" width="80px" height= "100px"/>
                </div>
                <div class="col-5 col-xl-3 mr-2 ml-2 fs--1">
                    <p class="font-weight-bold mb-1">Guía de aprendizaje</p>
                    <p class="fs-0" >{{$sequence['name']}}</p>
                </div>
                <div class="col-1 mt-3 mt-md-0 ml-5 ml-md-0" style="min-width: 207px;">
                     <label class="mt-md-fix" style="margin-left: -21px;"><strong> Progreso</strong></label> 
                    @if(isset($sequence['progress']))
                        @if($sequence['progress']==0)   
                            <i class="fa fa-circle mr-2 fs-1" style="color:#808080" aria-hidden="true"></i><label class="font-weight-bold ">Sin iniciar</label>
                        @endif
                        @if($sequence['progress']>0 && $sequence['progress']<100)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#F9E538" aria-hidden="true"></i> <label class="font-weight-bold ">En proceso</label>
                        @endif
                        @if($sequence['progress']==100)
                        <i class="fa fa-circle mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> <label class="font-weight-bold ">Concluida</label>
                        @endif
                    @else
                        <i class="fa fa-circle mr-2 fs-1" style="color:#808080" aria-hidden="true"></i><label class="font-weight-bold ">Sin iniciar</label>
                    @endif  
                    
                    @if(isset($sequence['performance'])) 
                        <label class="" style="margin-left: -41px;"><strong> Desempeño</strong></label> 
                        @if($sequence['performance'] >= 0 )
                            @if($sequence['performance']>=90)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> <label class="font-weight-bold ">Superior > 90% </label>
                            @endif
                            @if($sequence['performance']>=70 && $sequence['performance']<=89)
                            <i class="fa fa-circle  mr-2 fs-1" style="color:#6CB249" aria-hidden="true"></i> <label class="font-weight-bold ">Alto 70% - 89% </label>
                            @endif
                            @if($sequence['performance']>=60 && $sequence['performance']<=69)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#F9E538" aria-hidden="true"></i><label class="font-weight-bold ">Básico 60% - 69% </label>
                            @endif
                            @if($sequence['performance']>=40 && $sequence['performance']<=59)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#AC312A" aria-hidden="true"></i> <label class="font-weight-bold ">Bajo 60% - 69% </label>
                            @endif
                            @if($sequence['performance']>=0  && $sequence['performance']<40)
                            <i class="fa fa-circle mr-2 fs-1" style="color:#AC312A" aria-hidden="true"></i> <label class="font-weight-bold ">Bajo < 40% </label>
                            @endif
                        @else  
                            <i class="fa fa-circle mr-2 fs-1" style="color:#808080" aria-hidden="true"></i>
                            <label class="font-weight-bold ">Sin iniciar</label>
                        @endif
                    @endif
                </div>
                <div class="col-12 col-xl-4 row mt-4 mt-xl-0 ml-auto text-align " style="min-width: 408px;">
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
            <h5 class="mt-3  mb-3">Reporte por momentos</h5>
        
            @foreach ($moments as $key => $moment)
               <div class="row p-3 rounded @if($key%2==0) bg-soft-dark @else bg-soft-dark-light @endif @if(!$moment['isAvailable']) disabled-moment @endif">

                    <div class="col-12 d-flex fs-0">
                        <div class="col-8 col-md-5">
                            <label class="fs--1"> Momento {{$moment['order']}}</label>
                            <label class="font-weight-bold fs--1"> Momento {{$moment['name']}}</label>
                        </div>    
                    
                        <div class="ml-4 col-1" style="min-width: 168px;">
                        @if($moment['isAvailable'])
                            @if($moment['progress']==0)
                            <i class="fa fa-circle mr-2 fs-2" style="color:#808080" aria-hidden="true"></i><label class="font-weight-bold ">Sin iniciar</label>
                            @endif
                            @if($moment['progress']>0 && $moment['progress']<100)
                            <i class="fa fa-circle  mr-2 fs-2" style="color:#F9E538" aria-hidden="true"></i><label class="font-weight-bold ">En proceso</label> 
                            @endif 
                            @if($moment['progress']==100)
                            <i class="fa fa-circle mr-2 fs-2" style="color:#6CB249" aria-hidden="true"></i> <label class="font-weight-bold ">Concluida</label>
                            @endif
                        @else
                            <label class="font-weight-bold ">No habilitada</label>
                        @endif    
                        </div>
                        <div class="ml-auto col-4">
                        @if($moment['isAvailable'])
                            <span class="font-weight-bold fs-0" style="font-size: 14px;">
                                Última conexión:
                                @if($moment['lastAccessInMoment'] != null)
                                     {{$moment['lastAccessInMoment']}}
                                @else
                                    Sin iniciar
                                @endif
                            </span>
                        @endif    
                        </div>
                    </div>
                    
                    @if($moment['isAvailable'])
                    <div class="row mt-3 ml-auto mr-auto w-md-90 ml-auto mr-auto">
                        @foreach ($moment['sections'] as $section)
                        @if($section['isAvailable'] && $section['isShow'])
                        <div class="col-12 row border-1000 border-bottom p-0">
                            <div class="col-6 p-0 fs-0">
                                <span class="fs--1"><strong>{{$section['name']}} : </strong> {{$section['title']}}</span>
                            </div>
                            <div class="col-3 p-0 fs-0"> 
                                <label class=""><strong>Progreso</strong></label> 
                                @if($section['progress'] > 0 )
                                    @if($section['progress']==100)
                                    <i class="fa fa-circle mr-2" style="color:#6CB249" aria-hidden="true"></i><label class="font-weight-bold ">Concluida</label>
                                    @else
                                    <i class="fa fa-circle  mr-2" style="color:#F9E538" aria-hidden="true"></i><label class="font-weight-bold ">En proceso</label>
                                    @endif
                                @else
                                    <i class="fa fa-circle mr-2" style="color:#808080" aria-hidden="true"></i><label class="font-weight-bold ">Sin iniciar</label>
                                @endif
                            </div> 
                            <div class="col-3 p-0 fs-0">  
                                @if(isset($section['performance']))
                                    <label class=""><strong>Desempeño</strong></label>
                                    @if($section['performance'] >= 0 )                                                                 
                                        @if($section['performance']>=90)
                                        <i class="fa fa-circle mr-2" style="color:#6CB249" aria-hidden="true"></i><label class=""><strong>Superior > 90%</strong></label>
                                        @endif
                                        @if($section['performance']>=70 && $section['performance']<=89)
                                        <i class="fa fa-circle  mr-2" style="color:#6CB249" aria-hidden="true"></i><label class=""><strong>Alto 70% - 89% </strong></label>
                                        @endif
                                        @if($section['performance']>=60 && $section['performance']<=69)
                                        <i class="fa fa-circle mr-2" style="color:#F9E538" aria-hidden="true"></i><label class=""><strong>Bajo 60% - 69% </strong></label>
                                        @endif
                                        @if($section['performance']>=40 && $section['performance']<=59)
                                        <i class="fa fa-circle mr-2" style="color:#AC312A" aria-hidden="true"></i><label class=""><strong>Bajo 40% - 59% </strong></label>
                                        @endif
                                        @if($section['performance']<40)
                                        <i class="fa fa-circle mr-2" style="color:#AC312A" aria-hidden="true"></i> <label class=""><strong>Bajo < 40%</strong></label>
                                        @endif
                                    @else 
                                        <i class="fa fa-circle mr-2" style="color:#808080" aria-hidden="true"></i><label class="">Sin iniciar</label>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif    
               </div>
            @endforeach
    
        
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




 