<div class="card col-12  min-content-height" ng-controller="shoppingCartController" ng-init="init();">

   <div class="p-5" ng-hide="shopping_carts">
   <div class="mt-3 p-3 border-lg-y col-lg-2 w-100"
      style="min-height: 23vw; border: 0.4px solid grey; min-width: 100%">
      cargando...
   </div>
   </div>
   <div class="card-header d-none-result d-none">
     <div class="text-right">
       @guest('afiliadoempresa')
       <div ng-show="shopping_carts.length>0" class="mt-1 mb-2 justify-content-end col-12 font-weight-bold">
         <span class="fs--1 mt-2 col-10 text-right">Para continuar con la compra, primero debes registrarte</span>
         <button class="btn btn-sm btn-outline-primary" ng-click="onRegistryWithPendingShoppingCart()">
         <span class="fs-lg-0 fs-md-0 fs-sm--1">Registro</span></button>
       </div>
       @endguest
       @auth('afiliadoempresa')
       @if(isset($preference))
       <h5 ng-show="shopping_carts.length>0" class="mb-2 justify-content-end col-12">
         <a class="btn btn-outline-primary" ng-href="{{$preference->init_point}}">
            <span class="fs-lg-0 fs-md-0 fs-sm--1">Continuar Compra</span>
         </a>
       </h5>
       @endif
       @endauth
     </div>
   </div>
   <div class="bg-200 d-none-result d-none text-900 px-1 fs--1 font-weight-semi-bold no-gutters row">
     <div class="p-2 px-md-3 col-8">Nombre</div>
     <div class="px-3 col-4">
       <div class="row">
         <div class="py-2 d-none d-md-block text-center col-md-8"></div>
         <div class="ml-auto p-2 px-md-3 col-md-4">Precio</div>
       </div>
     </div>
   </div>
   <div class="p-0 card-body d-none-result d-none">
     <div class="align-items-center px-1 border-bottom border-200 no-gutters" ng-repeat="shopping_cart in shopping_carts">
       <div ng-show="shopping_cart.rating_plan_id" class="row p-3 ">
         <div class="col-12 row">
            <div class="align-items-center media col-8">
              <div class="media-body">
                <h5 class="fs-0"><a class="text-900">@{{shopping_cart.rating_plan.name}}</a></h5>
                <h4 class="fs-0"><a class="text-600">@{{shopping_cart.rating_plan.description}}</a></h4>
                <div class="fs--2 fs-md--1 text-danger cursor-pointer">Remover</div>
              </div>
            </div>
            <div class="p-3 col-4 text-align-right">
               $@{{shopping_cart.rating_plan.price}}
            </div>
         </div>
         <div class="col-12 row">
            <div ng-show="shopping_cart.type_product_id === 1 || shopping_cart.type_product_id === 2" 
                ng-repeat="shopping_cart_product in shopping_cart.shopping_cart_product" 
               class="col-6 d-flex pl-0">
               <div class="p-3" ng-show="shopping_cart_product.sequence">
                 <img class="col-rounded" src="{{asset('/')}}@{{shopping_cart_product.sequence.url_image}}" width="80px"/>
               </div>
               <div class="pr-3 pb-0 col-lg-6 col-md-9 pl-0" ng-show="shopping_cart_product.sequence">
                 <h6 class="text-900">@{{shopping_cart_product.sequence.name}}</h6>
                 <p class="col-12 fs-0 text-900 pl-0">
                   <small>@{{shopping_cart_product.sequence.description}}</small>
                 </p>
               </div>
            </div>
         </div>
         <div class="col-12 row">
         <div ng-show="shopping_cart.type_product_id === 2" ng-repeat="shopping_cart_product in shopping_cart.shopping_cart_product" class="col-12">
            <div class="p-3 " ng-show="shopping_cart_product.sequence">
              <img class="rounded mr-3" src="@{{shopping_cart_product.sequence.url_image}}" width="80px"/>
              <h6 class="text-900">@{{shopping_cart_product.sequence.name}}</h6>
              <p class="col-12 fs-0 text-900 ">
                <small>@{{shopping_cart_product.sequence.description}}</small>
              </p>
            </div>
            <div class="p-3 " ng-show="shopping_cart_product.sequenceStruct_moment">
              <img class="rounded mr-3" src="@{{shopping_cart_product.sequenceStruct_moment.url_image}}" width="80px"/>
              <h6 class="text-900">@{{shopping_cart_product.sequenceStruct_moment.name}}</h6>
              <p class="col-12 fs-0 text-900 " style="top: 40px; left: 113px; width: 70%;"><small>@{{shopping_cart_product.sequenceStruct_moment.description}}</small></p>
            </div>
         </div>
         </div>
         <div ng-show="shopping_cart.type_product_id === 3" class="col-lg-5 col-md-6 col-12">
           <div ng-repeat="seq in shopping_cart.sequences" class="p-3 row"> 
             <img class="rounded mr-3" src="@{{seq.url_image}}" width="80px"/>
             <h6 class="text-900">@{{seq.name}}</h6>
             <p class="col-12 fs-0 text-900 " style="top: 40px; left: 113px; width: 70%;">
               <small>@{{seq.description}}</small>
             </p>
           </div>
         </div>
       </div>
       <div ng-show="shopping_cart.type_product_id === 4" class="row p-3" ng-repeat="shopping_cart_product in shopping_cart.shopping_cart_product">
            <div class="col-8">
            <div class="align-items-center media" class="col-3 ml-4">
              <img class="rounded mr-3" src="@{{shopping_cart_product.kiStruct.url_image}}" width="80px"/>
              <div class="media-body">
                <h5 class="fs-0"><a class="text-900">@{{shopping_cart_product.kiStruct.name}}</a></h5>
                <h4 class="fs-0"><a class="text-600">@{{shopping_cart_product.kiStruct.description}}</a></h4>
                <div class="fs--2 fs-md--1 text-danger cursor-pointer">Remover</div>
              </div>
            </div>
            </div>
            <div class="col-4">
               <div class="ml-auto pl-0 pr-2 pr-md-3 order-0 order-md-1 mb-2 mb-md-0 text-600 col-md-4">$@{{shopping_cart_product.kiStruct.price}}</div>
              </div>
       </div>
       <div ng-show="shopping_cart.type_product_id === 5" class="row p-3" 
            ng-repeat="shopping_cart_product in shopping_cart.shopping_cart_product">
            <div class="col-8">
            <div class="align-items-center media" class="col-3 ml-4">
              <img class="rounded mr-3" src="@{{shopping_cart_product.elementStruct[0].url_image}}" width="80px"/>
              <div class="media-body">
                <h5 class="fs-0"><a class="text-900">@{{shopping_cart_product.elementStruct[0].name}}</a></h5>
                <h4 class="fs-0"><a class="text-600">@{{shopping_cart_product.elementStruct[0].description}}</a></h4>
                <div class="fs--2 fs-md--1 text-danger cursor-pointer">Remover</div>
              </div>
            </div>
            </div>
            <div class="col-4">
               <div class="ml-auto pl-0 pr-2 pr-md-3 order-0 order-md-1 mb-2 mb-md-0 text-600 col-md-4">$@{{shopping_cart_product.elementStruct[0].price}}</div>
              </div>
       </div>
     </div>
     <div ng-show="shopping_carts.length === 0" class="m-4 align-items-center px-1 border-bottom border-200 no-gutters row fs-0">
      No hay elementos en el carrito de compras
     </div>
     <div ng-show="shopping_carts.length > 0" class="font-weight-bold px-1 no-gutters row">
      <div class="py-2 px-md-3 ml-auto text-900 col-9 col-md-8">Total</div>
      <div class="px-3 col">
         <div class="row">
            <div class="py-2 d-none d-md-block text-center col-md-8">1 (elementos)</div>
            <div class="col-12 col-md-4 ml-auto py-2 pr-md-3 pl-0 col">$14398.00</div>
         </div>
      </div>
     </div>
     
     <div class="font-weight-bold px-1 no-gutters row text-right">
       @guest('afiliadoempresa')
       <div ng-show="shopping_carts.length>0" class="mt-1 mb-2 justify-content-end col-12">
         <span class="fs--1 mt-2 col-10 text-right">Para continuar con la compra, primero debes registrarte</span>
         <button class="btn btn-sm btn-outline-primary" ng-click="onRegistryWithPendingShoppingCart()">
         <span class="fs-lg-0 fs-md-0 fs-sm--1">Registro</span></button>
       </div>
       @endguest

       @auth('afiliadoempresa')
       @if(isset($preference))
       <h5 ng-show="shopping_carts.length>0" class="mt-1 mb-2 justify-content-end col-12">
         <button class="btn btn-outline-primary" onclick="event.preventDefault(); document.getElementById('simulate-form').submit();">
         <span class="fs-lg-0 fs-md-0 fs-sm--1">Simular Pago</span></button>
         <form id="simulate-form" action="{{ route('notification_gwpayment_callback') }}" method="GET" style="display: none;">
            @csrf
            <input type="text" name="collection_status" value="approved"/>
            <input type="text" name="preference_id" value="{{$preference->id}}"/>
         </form>
       </h5>
       <h5  ng-show="shopping_carts.length>0" class="mt-1 mb-2 justify-content-end col-12">
         <button class="btn btn-outline-primary">
            <a class="fs-lg-0 fs-md-0 fs-sm--1" ng-href="{{$preference->init_point}}">
              Continuar Compra
            </a>
         </button>
       </h5>
       @endif
       @endauth
     </div>
   </div>
</div>
<script src="{{ asset('/../angular/controller/ShoppingCartController.js') }}" defer></script>