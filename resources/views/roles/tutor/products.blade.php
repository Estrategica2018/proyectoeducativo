@extends('roles.tutor.index')

@section('content-tutor-index')
   <div class="d-none-result d-none" ng-controller="tutorProductsCtrl" ng-init="init()" >
        <div class="row no-gutters" ng-show="products && products.length > 0">
          <h6 class="mb-5">Actualmente cuentas con diferentes productos con nosotros</h6>
          <div ng-repeat="product in products" class="col-lg-6 col-12 mb-3">
            <div ng-show="product.type_product_id === 0" class="d-flex">
                <img width="auto" height="100px" src="{{asset('/')}}@{{product.sequence.url_image}}" />
                <div class="row">
                   <h6 class="col-12 ml-3">Secuencia @{{product.sequence.name}}</h6>
                   <p class="fs--3 ml-3 col-12  pr-5">Esta guía de aprendizaje consta de : Situación generadora, guía de saberes, ruta de viaje y los 8 momentos que contienen : Pregunta central, ciencia en contexto, experiencia cientíﬁcas y + conexiones</p>
                </div>
            </div>
            
            <div ng-show="product.type_product_id === 1" class="d-flex">
                <img width="auto" height="100px" src="{{asset('/')}}@{{product.sequence.url_image}}" />
                <div class="row">
                   <h6 class="col-12 ml-3">Experiencia @{{product.sequence.name}}</h6>
                   <p class="fs--3 ml-3 col-12  pr-5">Consta de diversas experiencias científicas</p>
                </div>
            </div>
            
            <div ng-show="product.type_product_id === 2" class="d-flex">
                <img width="auto" height="100px" src="{{asset('/')}}@{{product.sequence.url_image}}" />
                <div class="row">
                   <h6 class="col-12 ml-3">Momentos de @{{product.sequence.name}}</h6>
                   <p class="fs--3 ml-3 col-12 pr-5">Consta de diveros momentos</p>
                </div>
            </div>
          </div>
        </div>
        <div class="fs--1" ng-show="products && products.length === 0">
          <p>Aún no cuentas con productos con nosotros</p>
        </div>
        <div class="p-3 border-lg-y col-lg-2 w-100"
               style="min-height: 23vw; border: 0.4px solid grey; min-width: 100%" ng-hide="products">
               cargando...
        </div>
        <div class="p-3 border-lg-y col-lg-2 w-100"
               style="min-height: 23vw; border: 0.4px solid grey; min-width: 100%" ng-hide="ratingPlans">
               cargando...
        </div>
		
        <div class="no-gutters" ng-show="ratingPlans && ratingPlans.length > 0">
		  <h6 class="mt-3 mb-4"> No olvides nuestros planes y beneﬁcios para ampliar las posibilidades de aprendizaje.</h6>
		  <div class="row">
			  <div ng-hide="ratingPlan.is_free"class="mb-6 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-6" 
				  ng-repeat="ratingPlan in ratingPlans">
				  <div class="card card-body pr-2 pl-2 pb-0 h-100">
					 <div class=" ml-2 fs--3 flex-100">
						<h6 class="text-center fs--3"> <span class="ml-2">@{{ratingPlan.name}} </span></h6>  
						<ul class="p-0 fs--3" ng-repeat="item in ratingPlan.description_items">
							<li class="fs--3 small pr-3 mt-4 ml-2"> @{{item}}</li>
						</ul>
					 </div>
				  </div>
				  <div class="trapecio-top position-absolute ml-4" style="bottom: -25px;">
					<a class=""
						ng-href="{{route('/')}}/plan_de_acceso/@{{ratingPlan.id}}/@{{ratingPlan.name_url_value}}" class="col-auto">
						<span class="fs--3 ml-1 mt-2" style="position: absolute;top: -31px;color: white;">Adquirir</span>
					</a>
				</div>
			   </div>
		   </div>
        </div>
   </div>
@endsection
@section('js')
    <script src="{{asset('/../angular/controller/tutorProductsCtrl.js')}}"></script>
@endsection