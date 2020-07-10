@extends('layouts.app_side')

@section('content')

<div class="w-100" ng-controller="ratingPlanDetailCtrl" ng-init="init(1,'{{$rating_plan_id}}','{{$sequence_id}}')">
    <div ng-show="errorMessageFilter" id="errorMessageFilter"
      class="fade-message d-none-result d-none alert alert-danger p-1 pl-2 row">
      <span class="col">@{{ errorMessageFilter }}</span>
      <span class="col-auto"><a ng-click="errorMessageFilter = null"><i class="far fa-times-circle"></i></a></span>
    </div>
    <div class="mb-3 card col-12" ng-show="ratingPlan">
      <div class="card-body w-100">
        <div class="row d-none-result d-none">
             <div class="mb-3">
                <h4 class=" boder-header p-1 pl-3">
                   @{{ratingPlan.name}}
                </h4>
             </div>
                          
             <ul class="text-justify pr-4 pl-3 mb-0">
                <p>@{{ratingPlan.description}}</p>
                <p>A continuación, te mostramos las <strong>guías de aprendizaje</strong> disponibles. Para conocer de qué se tratan y cuáles son sus contenidos pueden hacer clic en <strong>ver detalle</strong>, allí encontrarán un video introductorio y una <strong>malla curricular</strong> en la que se describen los <strong>propósitos de cada momento</strong>, la <strong>pregunta central</strong>, el eje temático de la <strong>explicación de ciencia en contexto</strong>, las <strong>experiencias científicas</strong> propuestas y los <strong>materiales</strong> que se requieren para esta.</p>
                <p>Si tienes alguna pregunta puedes escribirnos a través del formulario de contacto. </p>
             </ul>
             
             <div class="col-12 text-right r-0 w-md-50" id="div-continue" style="background-color: white; z-index: 10; ">
                <span class="mt-1">@{{messageToast}}</span>
                <button ng-click="onContinueElements()" ng-disabled="!selectComplete" class="d-none-result d-none ml-3 mt-3 btn btn-outline-primary fs-0 confirm_rating" href="#" class="col-6">
                   <i class="fas fa-arrow-right"></i> Continuar compra
                </button>
             </div>
             
             <div class="col-12 ml-2 mt-1 row p-0 ml-0 mr-0" ng-show="sequences">
                <!-- Toast -->
                <div class="z-index-10 bg-success position-absolute color-white p-3" id="toast-name-1">
                  @{{messageToast}}
                 </div>
              
               <div class="p-0 col-md-6 col-sm-12" ng-show="sequenceForAdd" style="border: 10px solid white;">
              <div class="d-none-result d-none row w-100">
                  <div class="ml-2 pr-2 border-white-extent card card-body bg-dark row d-flex" >
                    <div class="view" id="sequence-description-@{{sequenceForAdd.id}}">
                      <div class="media">
                         <div class="row col-5">
                          <div class="col-12">
                              <img ng-src="{{asset('/')}}@{{sequenceForAdd.url_image}}" width="142px" height="auto" style="width:142px"/>
                          </div>
                         </div>
                        <div class="position-absolute" style="top:10px; transform : scale(2);">
                          <input type="checkbox" class="sequence_ForAdd" ng-model="sequenceForAdd.isSelected" name="check_sequence_ForAdd_"@{{sequenceForAdd.id}} ng-change="onCheckChange(sequenceForAdd,null,sequenceForAdd)"/>
                         </div>
                        <div class="media-body pl-2 pr-3">
                           <h5 class="pl-2 fs-0 boder-header text-align-left">@{{sequenceForAdd.name}}</h5>
                           <div class="mt-3 pr-2 pl-2 fs--1" style="min-height: 110px;">@{{sequenceForAdd.description}}</div>
                           <div class="col-12">
                            <a ng-click="showMash(sequenceForAdd)" class="ml-3 mt-3 btn btn-outline-primary fs--2" href="#" class="col-6">
                                 <i class="fas fa-search"></i> Ver contenido
                             </a>
                             <a ng-click="showVideo(sequenceForAdd)" class="ml-3 mt-3 btn btn-outline-primary fs--2" href="#" class="col-6">
                                 <i class="fas fa-search"></i> Ver video
                             </a>
                             
                            <div class="fade bg-light mt-2 row p-3" ng-show="sequenceForAdd.isSelected" id="moment_div_responsive_ForAdd" style="margin-left: -216px;"> 
                                 <div class="text-left" ng-repeat="moment in sequenceForAdd.moments" ng-show="ratingPlan.type_rating_plan_id === 2">
                                     <input class="transform-scale-2 ml-3 mt-1 mr-2" type="checkbox" ng-model="moment.isSelected" name="check_moment_ForAdd@{{moment.id}}" ng-change="onCheckChange(sequenceForAdd,moment,sequenceForAdd)"/>
                                     <span class="fs--1">@{{moment.name}}</span>
                                 </div>
                                 <div class="text-left" ng-repeat="moment in sequenceForAdd.moments"  ng-show="ratingPlan.type_rating_plan_id === 3">
                                     <input class="transform-scale-2 ml-3 mt-1 mr-2" type="checkbox" ng-model="moment.isSelected" name="check_experience_ForAdd@{{moment.id}}" ng-change="onCheckChange(sequenceForAdd,moment,sequenceForAdd)"/>
                                     <span class="fs--1">@{{moment.name}}</span>
                                 </div>
                             </div>
                     
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
               </div>
               </div>
               <div class="p-0 col-md-6 col-sm-12" style="border: 10px solid white;"
                    ng-repeat="sequence in sequences">
              <div class="row w-100 p-0">
                  <div class="ml-2 pr-2 border-white-extent card card-body bg-dark row d-flex" >
                    <div class="view" id="sequence-description-@{{sequence.id}}">
                      <div class="media">
                        <div class="row col-5">
                          <div class="col-12">
                              <img ng-src="{{asset('/')}}@{{sequence.url_image}}" width="142px" height="auto" style="width:142px"/>
                          </div>
                         </div>
                         <div class="position-absolute" style="top:10px; transform : scale(2);">
                           <input type="checkbox" ng-model="sequence.isSelected" name="check_sequence_"@{{sequences.id}} ng-change="onCheckChange(sequence)"/>
                          </div>

                             <div class="media-body pl-2 pr-3">
                             <h5 class="pl-2 fs-0 boder-header text-align-left">@{{sequence.name}} @{{sequence.isSelected}}</h5>
                             <div class="mt-3 pr-2 pl-2 fs--1" style="min-height: 110px;">@{{sequence.description}}</div>
                             <div class="col-12">
                                 <a ng-click="showMash(sequence)" class="ml-3 mt-3 btn btn-outline-primary fs--2" href="#" class="col-6">
                                     <i class="fas fa-search"></i> Ver contenido
                                 </a>
                                 <a ng-click="showVideo(sequence)" class="ml-3 mt-3 btn btn-outline-primary fs--2" href="#" class="col-6">
                                     <i class="fas fa-search"></i> Ver video
                                 </a>
                                 
                                <div class="fade bg-light mt-2 row p-3" ng-show="sequence.isSelected" id="moment_div_responsive_@{{sequence.id}}" style="margin-left: -216px;"> 
                                     <div class="text-left" ng-repeat="moment in sequence.moments" ng-show="ratingPlan.type_rating_plan_id === 2">
                                         <input class="transform-scale-2 ml-3 mt-1 mr-2" type="checkbox" ng-model="moment.isSelected" name="check_moment_ForAdd@{{moment.id}}" ng-change="onCheckChange(sequence,moment,sequence)"/>
                                         <span class="fs--1">@{{moment.name}}</span>
                                     </div>
                                     <div class="text-left" ng-repeat="moment in sequence.moments"  ng-show="ratingPlan.type_rating_plan_id === 3">
                                         <input class="transform-scale-2 ml-3 mt-1 mr-2" type="checkbox" ng-model="moment.isSelected" name="check_experience_ForAdd@{{moment.id}}" ng-change="onCheckChange(sequence,moment,sequence)"/>
                                         <span class="fs--1">@{{moment.name}}</span>
                                     </div>
                                 </div>
                                 
                             </div>
                          </div>
                      </div>
                    </div>
                  </div>
               </div>
               </div>
             </div>
             
             <div class="col-12 text-right">
                <button ng-click="onContinueElements()" ng-disabled="!selectComplete" class="d-none-result d-none ml-3 mt-3 btn btn-outline-primary fs-0 confirm_rating" href="#" class="col-6"><i class="fas fa-arrow-right"></i> Continuar compra</button>
             </div>
        </div>

        <div id="loading" class="fade show p-3 border-lg-y col-lg-2 w-100" ng-hide="ratingPlan"
           style="min-height: 43vw; border: 0.4px solid grey; min-width: 100%">
           cargando...
        </div>
      </div>
      @include('ratingPlan/elements_kits')
   </div>
   
</div>

<script src="{{ asset('/../angular/controller/ratingPlanDetailCtrl.js') }}" defer></script>

@endsection