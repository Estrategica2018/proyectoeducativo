@extends('layouts.app_side')

@section('content')

@include('layouts/float_buttons')

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="{{ asset('falcon/css/swiper.min.css') }}">

<!-- Demo styles -->
<style type="text/css">
   .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
   }
   
</style>
<!-- Swiper -->
	<div class="swiper-container mt-lg--2">
	   <div class="swiper-wrapper">
		  <div class="swiper-slide"
			 style="background-image:url(/images/sliderCarrucelHome/slide1.jpg);">
		  </div>
		  <div class="swiper-slide"
			 style="background-image:url(/images/sliderCarrucelHome/slide2.jpg);">
		  </div>
		  <div class="swiper-slide"
			 style="background-image:url(/images/sliderCarrucelHome/slide3.jpg);">
		  </div>
		  <div class="swiper-slide"
			 style="background-image:url(/images/sliderCarrucelHome/slide4.jpg);">
		  </div>
	   </div>
	   <!-- Add Arrows -->
	   <div class="swiper-button-next" style="color: white;"></div>
	   <div class="swiper-button-prev" style="color: white;"></div>
	</div>

<div ng-controller="kitsElementsCtrl" ng-init="getKits()">
   <div ng-show="errorMessageFilter" id="errorMessageFilter"
      class="fade-message d-none-result d-none alert alert-danger p-1 pl-2 row">
      <span class="col">@{{ errorMessageFilter }}</span>
      <span class="col-auto"><a ng-click="errorMessageFilter = null"><i class="far fa-times-circle"></a></i></span>
   </div>
   <div class="mb-3 card">
      <div class="card-body">
         <div class="no-gutters row">
            <div class="d-none-result d-none row w-100">
                 <div class="pr-0 col-12 ml-2">
				    <h5 class="boder-header p-1 mt-4 mb-3">
                       @{{kit.name}}
                    </h5>
                    @{{kit.description}}
 				   <div class="product-label-sold-out" ng-show="kit.status=='sold-out'" style="top:0px">
						 Producto agotado
				    </div>
				    <div class="product-label-no-available" ng-show="kit.status==='no-available'">
						 Producto no disponible
				    </div>
                 </div>
                 <div class="col-12">
                    <a ng-hide="kit.status === 'sold-out' || kit.status === 'no-available'"
					class="ml-3 mt-3 btn btn-sm btn-outline-primary fs-0" href="#" class="col-6"><i class="fas fa-shopping-cart"></i> Comprar</a>
                 </div>
                 
                 <div class="col-12 ml-2 mt-5" ng-show="listSequence.length > 0">
                   <h5 class="p-1 boder-header">Guías de aprendizaje que te pueden interesar</h5>
                   <div class="row">
                       <div class="col-lg-4 col-md-6" ng-repeat="sequence in listSequence" style="border: 6px solid white;">
                          <div class="card-body bg-light p-1 row">
                             <div class="col-auto">
                                <img class="col-12 mt-3 p-0" ng-src="{{asset('/')}}@{{sequence.url_image}}" style="width:92px;height:auto;">
                            </div>
                             <div class="col-8">
                                 <div class="col-12 mt-3 kit-description">
                                    <h6 class="boder-header p-1  fs-1 text-left ">
                                       @{{sequence.name}}
                                    </h6>
                                    @{{sequence.description}}
                                 </div>
								 <div class="col-12 p-0 mt-3 text-aling-left">
                                    <a class="ml-auto mr-auto mt-1 btn btn-outline-primary fs--2" ng-href="../../kit_de_laboratorio/@{{kit_element.id}}/@{{kit_element.name_url_value}}">Detalle</a>
                                    <a class="pl-3 mt-1 btn btn-outline-primary fs--2" href="#" class="col-6">Agregar</a>
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
</div>

<script src="{{ asset('/falcon/js/swiper.min.js') }}" defer></script>
<script src="{{ asset('/../angular/controller/kitsElementsCtrl.js') }}" defer></script>

@endsection