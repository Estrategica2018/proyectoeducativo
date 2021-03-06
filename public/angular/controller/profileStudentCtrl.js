MyApp.controller("profileStudentCtrl", function ($scope, $http, $timeout) {
    $scope.customImage = null;
    $scope.urlImage = null;
    $scope.validateUserName = true;
   
    $scope.initProfile = function(kidSelected, userNameInit,urlImage) {
        $('.d-none-result').removeClass('d-none');
        $scope.kidSelected = kidSelected;
        $scope.userNameInit = userNameInit;
        $scope.urlImage = urlImage;
    }
    
    $scope.avatars = [
        {"urlImage":"/images/avatars/avatar-default/avatar1.png","name":"Leonardo da Vinci","job":"Polímata"},
        {"urlImage":"/images/avatars/avatar-default/avatar2.png","name":"Marie Curie","job":"Química"},
        {"urlImage":"/images/avatars/avatar-default/avatar3.png","name":"Albert Einstein","job":"Físico"},
        {"urlImage":"/images/avatars/avatar-default/avatar4.png","name":"Samantha Cristoforetti","job":"Astronauta"},
        {"urlImage":"/images/avatars/avatar-default/avatar5.png","name":"Katia Krafft","job":"Vulcanólaga"},
        {"urlImage":"/images/avatars/avatar-default/avatar10.png","name":"Valerie Thomas","job":"Astrofísica"},
        {"urlImage":"/images/avatars/avatar-default/avatar9.png","name":"Stephen Hawking","job":"Astrofísico"},
        {"urlImage":"/images/avatars/avatar-default/avatar6.png","name":"Isaac Newton","job":"Físico"},
        {"urlImage":"/images/avatars/avatar-default/avatar7.png","name":"Galileo Galilei","job":"Físico"},
        {"urlImage":"/images/avatars/avatar-default/avatar8.png","name":"Rosalind Franklin","job":"Química"}
    ];

    $scope.onEditStudent = function() {
       
      $scope.errorName = null;
      $scope.errorLastName = null;
      $scope.errorBirthday = null;
      $scope.errorPassword = null;
      $scope.mbInvalidate = null;
      $scope.errorMessageRegister = null;
      
      var name  = $('input[name=name]').val(); if(name.length === 0 ) { $scope.errorName = 'Este campo debe ser poblado'; return;}
      var last_name = $('input[name=last_name]').val(); if(last_name.length === 0 ) { $scope.errorLastName = 'Este campo debe ser poblado'; return;}
      var birthday = $('input[name=birthday]').val(); //if(birthday.length === 0 ) { $scope.errorBirthday = 'Este campo debe ser poblado'; return;}
      var user_name = $('input[name=user_name]').val(); if(user_name.length === 0 ) { $scope.mbInvalidate = 'Este campo debe ser poblado'; return;}
      var password = $('input[name=password]').val(); //if(password.length === 0 ) { $scope.mbInvalidate = 'Este campo debe ser poblado'; return;}
      if(password.length>0 && password.length<8)  { $scope.errorPassword = 'La contraseña debe tener mínimo 8 caracteres'; return;}
      
      
      $scope.loadingRegistry = true;
      var data = {
          "name": name,
          "last_name": last_name,
          "birthday": birthday,
          "password": password,
          "kidSelected": $scope.kidSelected
      }

      if($scope.userNameInit != user_name ) {
          data.user_name = user_name;
      }
      
      $http({
         url:"/edit_user_student/",
         method: "POST",
         data: data
      }).
      then(function (response) {
          console.log(response);
         $scope.loadingRegistry = false;
         if(response.status === 200) {
            swal({
               text: "Estudiante editado exitosamente",
               type: "success",
               showCancelButton: false,
               showConfirmButton: false
            }).catch(swal.noop);
            

            $timeout(function() {
               location="";
            },1000);

         }
      }).catch(function (e) {
         $scope.errorMessageRegister = 'Error editando el estudiante';
         $scope.loadingRegistry = false;
      });
    }

    $scope.viewPassword = (idInput) => {
        var cambio = document.getElementById(idInput)
        if(cambio.type == "password"){
            cambio.type = "text";
            $(`.${idInput}`).removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $(`.${idInput}`).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
    $scope.onKidSelected = (type)=>{
        $scope.kidSelected = type

    }
});
