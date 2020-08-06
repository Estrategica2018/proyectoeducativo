MyApp.controller("kitsElementsCtrl", function ($scope, $http, $timeout) {
    $scope.kits = [];
    $scope.errorMessageFilter = '';
    $scope.searchText = '';

    $scope.ratingPlans = [];

    //retrive plan
    $http({
        url: '/get_rating_plans/',
        method: "GET",
    }).
    then(function (response) {
        var data = response.data.data || response.data;
        // $scope.ratingPlans = data.filter(function(value){
        //         return !value.is_free && ( (value.type_plan.id === 1 && value.count === 1) || value.type_plan.id === 2 || value.type_plan.id === 3    );
        // })
        $scope.ratingPlans = data;

    }).catch(function (e) {
        $('.d-none-result').removeClass('d-none');
        $('#loading').removeClass('show');
        $scope.errorMessageFilter = 'Error consultando las secuencias, compruebe su conexión a internet';
    });  
    
    $scope.allKits = function() {
        $('.d-none-result').removeClass('d-none');
        $http({
            url:"/get_kit_elements",
            method: "GET",
        }).
        then(function (response) {
            $scope.kit_elements = [];
            var kits = response.data;
            for(var i=0; i<kits.length; i++){
                var kit = kits[i];
                kit.type="kit";
                kit.name_url_value = kit.name.replace(/\s/g,'_').toLowerCase();
                $scope.kit_elements.push(kit);
                if(kit.kit_elements && kit.kit_elements[0] ) {
                    var element = kit.kit_elements[0].element;
                    element.type="element";
                    element.name_url_value = element.name.replace(/\s/g,'_').toLowerCase();
                    $scope.kit_elements.push(element);    
                }
            }
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        }).catch(function (e) {
            $scope.errorMessageFilter = 'Error consultando las secuencias';
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        });
    };
    
    $scope.getKits = function() { 

        var params = window.location.href.split('/');
        var kidName = window.location.href.split('/')[params.length - 1];
        var kidId = window.location.href.split('/')[params.length - 2];

        $('.d-none-result').removeClass('d-none');
            $http({
            url:"/get_kit_element/kit/" + kidId,
            method: "GET",
        }).
        then(function (response) {
            $scope.kit = response.data;
            var moment = null;
            var mbSeq = null;
            $scope.listSequence = [];
            if($scope.kit.moment_kits)
            for(var i=0;i<$scope.kit.moment_kits.length;i++) {
                moment = $scope.kit.moment_kits[i].moment;
                mbSeq = false; 
                for(var j=0;j<$scope.listSequence.length;j++) {
                    if($scope.listSequence[j].id === moment.sequence.id) {
                        mbSeq = true;
                        break;
                    }
                }
                if(!mbSeq) {
                    moment.sequence.name_url_value = moment.sequence.name.replace(/\s/g,'_').toLowerCase();
                    $scope.listSequence.push(moment.sequence);
                }
            }
            
            
            // if($scope.kit.url_slider_images) {
            //     $http.post('/conexiones/admin/get_folder_image', { 'dir': $scope.kit.url_slider_images }).then(function (response) {
            //         $scope.kit.images = [];
            //         var slideImages = '';
            //         for(var dir in response.data.scanned_directory) {
            //             if(response.data.scanned_directory[dir]!=='..') {
            //                 var src = '/' + response.data.directory + '/' + response.data.scanned_directory[dir];
            //                 if(src.indexOf('.png')>0 || src.indexOf('.jpge')>0 || src.indexOf('.jpg')>0) {
            //                     slideImages += '<div class="swiper-slide" style="background-image:url('+src+');"></div>'; 
            //                 } 
            //             }
            //         }
            //        // $('.swiper-wrapper').html(slideImages);  
            //     },function(e){
            //         var message = 'Error consultando el directorio';
            //         if(e.message) {
            //             message += e.message;
            //         }
            //         $scope.errorMessage = angular.toJson(message);
            //         $scope.directoryPath = null;
            //     });
            // }
            
            $scope.kit.type = 'kit';
            
            $timeout(function() {
                $('#loading').removeClass('show');
                $('.d-none-result').removeClass('d-none');
              },1000);
            
        }).catch(function (e) {
            $scope.errorMessageFilter = 'Error consultando los kits de laboratorio. ['+e+']';
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        });
    };
    
    $scope.getElement = function() {
        var params = window.location.href.split('/');
        var elementName = window.location.href.split('/')[params.length - 1];
        var elementId = window.location.href.split('/')[params.length - 2];

        $('.d-none-result').removeClass('d-none');
            $http({
            url:"/get_kit_element/element/" + elementId,
            method: "GET",
        }).
        then(function (response) {
            $scope.element = response.data;
            $scope.element.type = 'element';
            var moment = null;
            var mbSeq = null;
            $scope.listSequence = []; 
            if($scope.element.element_in_moment)
            for(var i=0;i<$scope.element.element_in_moment.length;i++) {
                moment = $scope.element.element_in_moment[i].moment;
                mbSeq = false; 
                for(var j=0;j<$scope.listSequence.length;j++) {
                    if($scope.listSequence[j].id === moment.sequence.id) {
                        mbSeq = true;
                        break;
                    }
                }
                if(!mbSeq) {
                    moment.sequence.name_url_value = moment.sequence.name.replace(/\s/g,'_').toLowerCase();
                    $scope.listSequence.push(moment.sequence);
                }
            }

            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        }).catch(function (e) {
            $scope.errorMessageFilter = 'Error consultando el elemento de laboratorio';
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        });
    };    
    
    $scope.onAddShoppingCart = function (kitElement) {
        swal({
          title: "Añadir elemento al carrito?",
          text: "Confirmas que deseas adicionar este kit de laboratorio al carrito",
          type: "warning",
          cancelButtonText: 'Cancelar',
          showCancelButton: true,
          showConfirmButton: true,
          dangerMode: false,
        })
        .then((willConfirm) => {
          if (willConfirm) {
            var data = {};
            data.type_product_id = kitElement.type === 'kit' ?  4 : kitElement.type === 'element' ?  5 : 0;
            data.products = [kitElement];
            addShoppingCart([data]);
          }
        }).catch(swal.noop);
    }
    
    function addShoppingCart(data) {
        $http({
            url:"/create_shopping_cart",
            method: "POST",
            data: data
        }).
        then(function (response) {
            var message = response.data.message || 'Se ha registrado el producto correctamente';
            swal({
              title: message,
              type: 'success',
              buttons: ['Continuar comprando', 'Ir al carrito'],
              dangerMode: false,
            })
            .then((willGo) => {
              if (willGo) {
                window.location='/carrito_de_compras/';
              }
            });
        }).catch(function (e) {
            if(e.status === 404)
                $scope.errorMessageFilter = 'Error agregando el pedido al carrito de compras, comprueba la conexión a internet';
            else $scope.errorMessageFilter = 'Error agregando el pedido al carrito de compras';
            swal('Conexiones',$scope.errorMessageFilter,'error');
            $('#move').next().removeClass('d-none');
        });
    }

    $scope.onSequenceBuy = function (sequence) {
        var ratingPlans = '';
        for(var i = 0; i < $scope.ratingPlans.length; i++) {
            var rt = $scope.ratingPlans[i];
            if(!rt.is_free) {
                var listItem = rt.description_items.split('|');
                var items = '';
                for(var j=0;j<listItem.length;j++) {
                    items += '<li style="line-height: 17px;" class="card-rating-plan-id-'+ i +' fs-2 small pr-0 mt-4 ml-3"><span class="color-gray-dark font-14px font-family ">' + listItem[j] + '</span></li>';
                }
               var name = rt.name ? rt.name.replace(/\s/g,'_').toLowerCase() : '';
               var href = '/plan_de_acceso/' + rt.id + '/' + name + '/' + sequence.id;
               var button =   '<div onclick="location=\''+href+'\'" class="cursor-pointer w-75 trapecio-top position-absolute card-rating-button-id-'+ i  +'" style= "right: 12%;box-shadow: 0px 0px 0px 0px rgb(255 255 255), 0px -2px 0px rgba(255, 255, 255, 0.3);">'+
               '<a href="'+href+'" style="margin-left: -14px;"> <span class="fs-0 mt-2" style="position: absolute;top: -30px;color: white; ">Adquirir</span> </a> </div> ';

               ratingPlans += '<div class="mt-3 col-12 col-md-4 "><div class="card-header card-rating-background-id-' + i + ' mt-3 fs--3 flex-100 box-shadow ">'+
                '<h5 class="font-weight-bold card-rating-plan-id-'+ i +'" style="color: white;">'+rt.name+'</h5></div>'+
                '<div class="card-body bg-light pr-2 pl-2 pb-0 w-100 box-shadow " style="min-height: 220px  ;"><ul class=" p-0 ml-2 text-left fs-2 mb-auto">' + items + '</ul>'+  button+'</div>'+
                '   <div class="card-footer card-rating-background-id-' + i + ' font-weight-bold text-align box-shadow " style="color: white;">'+
                '  $'+rt.price+'USD  </div></div>';
            }
        }
        var html = '<div class="row justify-content-center">' + ratingPlans + '</div>';
        swal({
            html: html,
            width: '75%',
            showConfirmButton: false, showCancelButton: false
        }).catch(swal.noop);
        $('.swal2-show').css('background-color','transparent');


        setTimeout(function () {
            marginLeftText();
         }, 300);
  
         function marginLeftText() {
            $('.trapecio-top').each(function(){ 
                var width  = $(this).width(); 
                $(this).find('a span').each(function(){ 
                    var delta =  (width) - $(this).width();
                    $(this).css('margin-left',(delta/2)+'px');  
                });
            }); 
         }
  
         $( window ).resize(function() {
          marginLeftText();
        });

    }
});
 