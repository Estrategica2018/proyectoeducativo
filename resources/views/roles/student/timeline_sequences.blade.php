<div ng-controller="timelineSequencesStudentCtrl" ng-init=init(1,"{{$account_service_id}}","{{$sequence_id}}") class="row">
    <div ng-controller="navbarController" class="col-5 pr-0" style="height: 106px;">
        <a href="{{asset('/')}}"><img href="" class="mr-2 avatar-logo" src="{{ asset('images/icons/iconosoloConexiones-01.png') }}" alt="Logo" width="40"></a>
        
        @if(isset(auth('afiliadoempresa')->user()->url_image)) 
            <img class="avatar-student-timeline avatar-default rounded-circle" src="{{ asset(auth('afiliadoempresa')->user()->url_image) }}" width="70px" height="auto">
        @else 
            <img class="avatar-student-timeline" src="{{asset('images/icons/default-avatar.png')}}" width="70px" height="auto"/>
        @endif
        
        
        <span class="nameTimeLine fs--1">{{auth('afiliadoempresa')->user()->name}}</span>
        <div class="position-absolute d-flex" style="top: 12px;left: 220px;">

            <a class="ml-8 cursor-pointer image-tooltip" href="{{route('student','conexiones')}}">
                <img src="{{asset('images/icons/portal-estudiante/home_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">inicio</span>
            </a>
            @if(isset($buttonBack) && $buttonBack != 'none')
            <a class="ml-1 cursor-pointer image-tooltip" href="{{$buttonBack}}">
                <img src="{{asset('images/icons/portal-estudiante/atras_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">atr&aacute;s</span>
            </a>
            @else
            <a class="ml-1 cursor-not-allowed image-tooltip" disabled style="opacity: .5;">
                <img src="{{asset('images/icons/portal-estudiante/atras_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">atr&aacute;s</span>
            </a>
            @endif
            @if($buttonNext != 'none')
            <a class="ml-1 cursor-pointer image-tooltip" href="@if(isset($buttonNext)) {{$buttonNext }} @endif">
                <img src="{{asset('images/icons/portal-estudiante/adelante_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">adelante</span>
            </a>
            @else
                <a class="ml-1 cursor-not-allowed image-tooltip" disabled style="opacity: .5;">
                    <img src="{{asset('images/icons/portal-estudiante/adelante_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                    <span class="tooltiptext">adelante</span>
                </a>
            @endif
            <a class="ml-1 cursor-pointer image-tooltip" href="{{ route('student.available_sequences',auth('afiliadoempresa')->user()->company_name()) }}">
                <img src="{{asset('images/icons/portal-estudiante/guias_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">gu&iacute;as de aprendizaje</span>
            </a>
            <a class="ml-1 cursor-pointer image-tooltip" href="{{ route('student.achievements',auth('afiliadoempresa')->user()->company_name()) }}">
                <img src="{{asset('images/icons/portal-estudiante/logros_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">logros</span>
            </a>
            <a class="ml-1 cursor-pointer image-tooltip" href="{{route('student','conexiones')}}">
                <img src="{{asset('images/icons/portal-estudiante/perfil_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">perf&iacute;l</span>
            </a>
            <a class="ml-1 cursor-pointer image-tooltip" href="#" ng-click="closeSession('{{ route('user.logout') }}')">
                <img src="{{asset('images/icons/portal-estudiante/salir_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">salir</span>
            </a>

            <a class="ml-11 -align-right cursor-pointer image-tooltip" href="{{route('student','conexiones')}}">
                <img src="{{asset('images/icons/portal-estudiante/perfil_Mesa de trabajo 1.png')}}" width="32" height="auto"/>
                <span class="tooltiptext">perf&iacute;l</span>
            </a>
            <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
                <li class="nav-item dropdown dropdown-on-hover">
                    <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator show" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><svg class="svg-inline--fa fa-bell fa-w-14 fs-4" data-fa-transform="shrink-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.5em;"><g transform="translate(224 256)"><g transform="translate(0, 0)  scale(0.625, 0.625)  rotate(0 0 0)"><path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z" transform="translate(-224 -256)"></path></g></g></svg><!-- <span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span> --></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-card show" aria-labelledby="navbarDropdownNotification">
                        <div class="card card-notification shadow-none" style="z-index: 2;border: 1px solid">
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h6 class="card-header-title mb-0">Secciones incompletas</h6>
                                    </div>
                                    <div class="col-auto"><a class="card-link font-weight-normal" href="#"></a></div>
                                </div>
                            </div>
                            <div class="list-group list-group-flush font-weight-normal fs--1">
                                <div class="list-group-title border-bottom">Lista</div>
                                <div class="list-group-item" ng-repeat="alert in alertProgress" >
                                    <a class="notification notification-flush notification-unread" href="#!">
                                        <div class="notification-avatar">
                                            <div class="avatar avatar-2xl mr-3">
                                                <img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="">
                                            </div>
                                        </div>
                                        <div class="notification-body">
                                            <p class="mb-1">Esta incompleta la sección <strong>@{{alert.name}} </strong>punto número <strong> @{{alert.section}} </strong> del momento número <strong> @{{alert.moment}} </strong> 😍</p>
                                            <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">💬</span>Verificalo y completalo</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer text-center border-top"><a class="card-link d-block" href="pages/notifications.html"></a></div>
                        </div>
                    </div>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
           @csrf
        </form>
        </div>
    </div>
    <div class="col-auto d-none d-lg-block lineTimeLine">
        @if($rating_plan_type != 3)
        <div>
            @for($j = 1; $j < 9 ; $j++)
                @for($i = 1; $i < 5 ; $i++)
                    @if($i ===1)
                        <svg class="svgelem2" width="10px" height="20px" style="margin-right: -6px; margin-left: -12px;">
                            <rect width="35" fill="#494b9a" stroke="#494b9a" height="1" style="stroke-width:0.5;" />
                        </svg>
                    @else
                        <svg class="svgelem2" width="10px" height="20px" style="margin-right: -7px;padding-left: 0.3px;">
                            <rect width="12" fill="#494b9a" stroke="#494b9a" height="1" style="stroke-width:0.5;" />
                        </svg>
                    @endif
                    
                        <svg class="svgelem"  width="17px" height="13px" style="margin-right:-10px" xmlns="http://www.w3.org/2000/svg">
                            <g> 
                              <circle class="circle{{$j}}{{$i}}" cx="7" cy="7" r="5" fill="#FFFFFF" stroke="#494b9a" stroke-width="2%"/>

                              <a xlink:href="{{route('student.show_moment_section',[
                                'empresa' => $empresa,
                                'account_service_id'=>$account_service_id,
                                'sequence_id'=>$sequence_id,
                                'moment_id'=> App\Http\Controllers\MomentController::retriveMoment($sequence->moments,$j),
                                'order_moment_id'=>$j,
                                'section_id'=>$i
                            ])}}" target="_top">
                                <text x="40%" y="83%" style="text-anchor: middle; opacity: 0;">.</text>
                              </a>
                              
                            </g>
                        </svg>
                    
                @endfor
                <svg class="svgelem2" width="14px" height="20px" style="margin-right: -21px; padding-left: 0.4px;">
                    <rect width="35" height="1" fill="#494b9a" stroke="#494b9a" style="stroke-width:0.5;" />
                </svg>
                <svg width="44px" height="80px" xmlns="http://www.w3.org/2000/svg" style="margin-left: -2px;">
                        <path  class="star{{$j}}" fill="#FFFFFF"  style="transform:translate(12px, 22px) scale(.22,.22) rotate(-1deg);" stroke="#494b9a" stroke-width="6"
                              d="m135.78 50.46c0-2.01-1.52-3.259-4.564-3.748l-40.897-5.947-18.331-37.07c-1.031-2.227-2.363-3.34-3.992-3.34-1.629
                              0-2.96 1.113-3.992 3.34l-18.332 37.07-40.899 5.947c-3.041.489-4.562 1.738-4.562 3.748 0 1.141.679 2.445 2.037
                              3.911l29.656 28.841-7.01 40.736c-.109.761-.163 1.305-.163 1.63 0 1.141.285 2.104.855 2.893.57.788 1.425 1.181
                              2.566 1.181.978 0 2.064-.324 3.259-.977l36.58-19.229 36.583 19.229c1.142.652 2.228.977 3.258.977 1.089 0
                              1.916-.392 2.486-1.181.569-.788.854-1.752.854-2.893 0-.706-.027-1.249-.082-1.63l-7.01-40.736 29.574-28.841c1.414-1.412
                              2.119-2.716 2.119-3.911"/>
                        <text class="number{{$j}}" x="56%" y="50%" text-anchor="middle" stroke="#494b9a" stroke-width="1.5px" dy=".18em" dx=".15em" style="text-anchor: middle;">{{$j}}</text>
                </svg>
            @endfor
        </div>
        @endif
    </div>
    <div class="col-auto d-md-block d-lg-none lineTimeLine small">
        <div>
            @for($j = 1; $j < 9 ; $j++)
                @for($i = 1; $i < 5 ; $i++)
                    @if($i ===1)
                        <svg class="svgelem2" width="10px" height="20px" style="margin-right: -21px; margin-left: -18px;">
                            <rect width="25" height="1"  fill="#494b9a" stroke="#494b9a" style="stroke-width:0.5;" />
                        </svg>
                    @else
                        <svg class="svgelem2" width="10px" height="20px" style="margin-right: -24px;">
                            <rect width="10" height="1" fill="#494b9a" stroke="#494b9a" style="stroke-width:0.5;" />
                        </svg>
                    @endif
                    <svg class="svgelem"  width="33px" height="40px" style="margin-right:-12px" xmlns="http://www.w3.org/2000/svg">
                        <circle class="circle{{$j}}{{$i}}" cx="21" cy="25" r="4" fill="#FFFFFF" stroke="#494b9a"
                                stroke-width="2%"/>
                    </svg>
                @endfor
                <svg class="svgelem2" width="10px" height="20px" style="margin-right: -10px">
                    <rect width="16" height="1" fill="#494b9a" stroke="#494b9a" style="stroke-width:0.5;" />
                </svg>
                <svg width="50" height="80" xmlns="http://www.w3.org/2000/svg"  style="margin-left: -9px;">
                    <path  class="star{{$j}}" fill="#FFFFFF"  style="transform:translate(12px, 22px) scale(.22,.22) rotate(-1deg);" stroke="#494b9a" stroke-width="6"
                           d="m135.78 50.46c0-2.01-1.52-3.259-4.564-3.748l-40.897-5.947-18.331-37.07c-1.031-2.227-2.363-3.34-3.992-3.34-1.629
                              0-2.96 1.113-3.992 3.34l-18.332 37.07-40.899 5.947c-3.041.489-4.562 1.738-4.562 3.748 0 1.141.679 2.445 2.037
                              3.911l29.656 28.841-7.01 40.736c-.109.761-.163 1.305-.163 1.63 0 1.141.285 2.104.855 2.893.57.788 1.425 1.181
                              2.566 1.181.978 0 2.064-.324 3.259-.977l36.58-19.229 36.583 19.229c1.142.652 2.228.977 3.258.977 1.089 0
                              1.916-.392 2.486-1.181.569-.788.854-1.752.854-2.893 0-.706-.027-1.249-.082-1.63l-7.01-40.736 29.574-28.841c1.414-1.412
                              2.119-2.716 2.119-3.911"/>
                    <text class="number{{$j}}" x="50%" y="53%" text-anchor="middle" stroke="#494b9a" stroke-width="1px" dy=".08em" dx=".05em" style="text-anchor: middle;">{{$j}}</text>
                </svg>
            @endfor
        </div>
    </div>

</div>
@section('js')
    <script src="{{ asset('angular/controller/timelineSequencesStudentCtrl.js') }}" defer></script>
@endsection