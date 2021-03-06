@extends('layouts.app_side')
@section('content')
<div class="container">
   <div class="content">
      <div class="d-flex">
         @include('roles/admin/sidebar')
         <div class="" style="min-width:700px;" ng-controller="adminIndexCtrl">
            <div class="mb-3 card">
               <div class="card-header">
                  <h5 class="mb-0">Panel Administrador</h5>
               </div>
               <div class="bg-light card-body">
                  <div class="card-deck">
                     <div class="mb-3 overflow-hidden card" style="min-width: 12rem;">
                        <div class="bg-holder bg-card"></div>
                        <div class="position-relative card-body">
                           <h6>Afiliados<span class="badge badge-soft-warning rounded-capsule ml-2">{{$companyAffiliated}} Activos</span></h6>
                           <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning">{{$totalAffiliated}} Total</div>
                           <a class="font-weight-semi-bold fs--1 text-nowrap" href="{{route('admin.all_users')}}">
                           Ver todos <i class="fas fa-angle-right"></i>
                           </a>
                        </div>
                     </div>

                     <div class="mb-3 overflow-hidden card" style="min-width: 12rem;">
                        <div class="bg-holder bg-card"></div>
                        <div class="position-relative card-body">
                           <h6>Recaudo
                           <span class="badge rounded-capsule ml-2" ng-class="{ 'badge-soft-success':{{$progressPrice}}  >= 1, 'badge-soft-warning':{{$progressPrice}}  < 1  }">
                           {{$progressPrice}} % 
                           
                           <i ng-class="{'fa fa-chevron-up': {{$progressPrice}} >= 1, 'fa fa-chevron-down': {{$progressPrice}} < 1 } " aria-hidden="true"></i>
                           </span>
                           <small>respecto al mes pasasdo</small>
                           </h6>
                           <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif"><span>${{ $totalSumPrices }} USD <small class="fs--1">En el mes</small></span></div>
                        </div>
                     </div>
                     <div class="mb-3 overflow-hidden card" style="min-width: 12rem;">
                        <div class="position-relative card-body">
                           <h6>Envíos<span class="badge badge-soft-info rounded-capsule ml-2">0.0%</span></h6>
                           <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info">0</div>
                           <a class="font-weight-semi-bold fs--1 text-nowrap">
                              Todas las Órdenes
                              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" class="svg-inline--fa fa-angle-right fa-w-8 ml-1" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" style="transform-origin: 0.25em 0.59375em;">
                                 <g transform="translate(128 256)">
                                    <g transform="translate(0, 48)  scale(1, 1)  rotate(0 0 0)">
                                       <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path>
                                    </g>
                                 </g>
                              </svg>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="mb-3 card">
                     <div class="card-header">
                        <div class="align-items-center row">
                           <div class="col">
                              <h5 class="mb-0">
                                 Pagos recientes
                              </h5>
                           </div>
                        </div>
                     </div>
                     <div class="p-0 card-body">
                        <div class="table-responsive">
                           <div class="react-bootstrap-table">
                              <table class="table table-dashboard table-sm fs--1 border-bottom border-200 mb-0 table-dashboard-th-nowrap">
                                 <thead>
                                    <tr class="bg-200 text-900 border-y border-200">
                                       <th tabindex="0" class="border-0" style="min-width: 138px;">Fecha</th>
                                       <th tabindex="0" class="border-0" style="min-width: 171px;">Afiliado</th>
                                       <th tabindex="0" class="border-0">Email</th>
                                       <th tabindex="0" class="border-0" style="min-width: 17    0px;">Producto</th>
                                       <th tabindex="0" class="border-0" style="">Estado</th>
                                       <th tabindex="0" class="border-0" style="text-align: right; min-width:80px;">Precio</th>
                                       <th tabindex="0" class="border-0"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 
                                 @foreach($shoppingCarts as $shoppingCart)
                                    @if($shoppingCart['affiliate'])
                                    <tr class="btn-reveal-trigger border-top border-200">
                                       <td class="selection-cell" style="border: 0px; vertical-align: middle;">
                                       {{ $shoppingCart['updated_at'] }}
                                       </td>
                                       <td class="border-0 align-middle">
                                         <a class="font-weight-semi-bold" href="#" ng-click="showDetail('{{$shoppingCart['payment_transaction_id']}}')">
                                            {{$shoppingCart['affiliate']->name}} {{$shoppingCart['affiliate']->last_name}}
                                         </a>
                                       </td>
                                       <td class="border-0 align-middle">{{$shoppingCart['affiliate']->email}}</td>
                                       <td class="border-0 align-middle">{{$shoppingCart['description']}}</td>
                                       <td class="border-0 align-middle fs-0">
                                         @if($shoppingCart['payment_status']->id == 2)
                                          <span class="rounded-capsule badge badge-soft-warning">
                                            {{$shoppingCart['payment_status']->name}}
                                          </span>
                                          @endif
                                          @if($shoppingCart['payment_status']->id == 3)
                                          <span class="rounded-capsule badge badge-soft-success">
                                            {{$shoppingCart['payment_status']->name}}
                                             <i class="fas fa-check"></i>
                                          </span>
                                          @endif
                                          @if($shoppingCart['payment_status']->id == 4 || $shoppingCart['payment_status']->id == 5)
                                          <span class="rounded-capsule badge badge-soft-danger">
                                            {{$shoppingCart['payment_status']->name}}
                                             <i class="fas fa-exclamation-triangle"></i>
                                          </span>
                                          @endif
                                       </td>
                                       <td class="border-0 align-middle" style="text-align: right;">
                                       $  {{$shoppingCart['total_price']}} USD 
                                       </td>
                                       <td class="border-0 align-middle">
                                          <div class="dropdown">
                                             <button type="button" aria-haspopup="true" aria-expanded="false" class="text-600 btn-reveal btn btn-link btn-sm" ng-click="showDetail('{{$shoppingCart['payment_transaction_id']}}')">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" class="svg-inline--fa fa-ellipsis-h fa-w-16 fs--1" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                   <path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path>
                                                </svg>
                                             </button>
                                             
                                          </div>
                                       </td>
                                    </tr>
                                    @endif
                                 @endforeach
                                 <conx-shoppingcart-detail id="idShoppingCart"> </conx-shoppingcart-detail>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="px-1 py-3 no-gutters row">
                           <div class="pl-3 fs--1 col">
                              <span>{{$countShoppingCarts}} de {{$totalShoppingCarts}} </span>
                              <a class="px-0 font-weight-semi-bold btn btn-link btn-sm fs--1 ml-2"
                                href="{{route('admin.show_all_transaction')}}">
                                    Ver todos <i class="fas fa-angle-right"></i>
                              </a>
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
@endsection
@section('js')
<script src="{{asset('/../angular/controller/adminIndexCtrl.js')}}"></script>
@endsection