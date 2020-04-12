MyApp.controller("kitsElementsCtrl", function ($scope, $http, $timeout) {
    $scope.kits = [];
    $scope.errorMessageFilter = '';
    $scope.searchText = '';
    
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
                $scope.kit_elements.push(kit);
                if(kit.kit_elements && kit.kit_elements[0] ) {
                    var element = kit.kit_elements[0].element;
                    element.type="element";
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
        var kidName = window.location.href.split('/')[params.length - 1].replace('%20','');
        var kidId = window.location.href.split('/')[params.length - 2];

        $('.d-none-result').removeClass('d-none');
            $http({
            url:"/get_kit_element/kit/" + kidId,
            method: "GET",
        }).
        then(function (response) {
            $scope.kit = response.data[0];
            
            $scope.kit.images = [];
            if($scope.kit.url_slider_images) {
                $scope.kit.images = $scope.kit.url_slider_images.split('|');
            }
            
            $scope.kit.type = 'kit';
            
            $timeout(function() {
                
                $('#loading').removeClass('show');
                $('.d-none-result').removeClass('d-none');
                new Swiper('.swiper-container', {
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
              },1000);
            
        }).catch(function (e) {
            $scope.errorMessageFilter = 'Error consultando los kits de laboratorio';
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        });
    };
    
    $scope.getElement = function() {
        var params = window.location.href.split('/');
        var elementName = window.location.href.split('/')[params.length - 1].replace('%20','');
        var elementId = window.location.href.split('/')[params.length - 2];

        $('.d-none-result').removeClass('d-none');
            $http({
            url:"/get_kit_element/element/" + elementId,
            method: "GET",
        }).
        then(function (response) {
            $scope.element = response.data[0];
            $scope.element.type = 'kit'
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        }).catch(function (e) {
            $scope.errorMessageFilter = 'Error consultando las secuencias';
            $('#loading').removeClass('show');
            $('.d-none-result').removeClass('d-none');
        });
    };    
    
    $scope.onAddShoppingCart = function (kitElement) {
        swal({
          title: "Añadir elemento al carrito?",
          text: "Confirmas que deseas adicionar este kit de laboratorio al carrito",
          type: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((willConfirm) => {
          if (willConfirm) {
            var data = {};
            data.type_product_id = kitElement.type === 'kit' ?  4 : kitElement.type === 'element' ?  5 : 0;
            data.products = [kitElement];
            addShoppingCart([data]);
          }
        });
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
});
