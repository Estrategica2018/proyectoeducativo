@extends('roles.tutor.index')

@section('content-tutor-index')
   <div class="list-group" ng-controller="TutorIndexController" ng-init="initInscriptions()" >
        <div class="student-tutor-inscription btn btn-light" ng-repeat="student in students">
          <img class="rounded-circle" ng-src="{{asset('/')}}@{{student.url_image}}" width="100px"/>
          <p>@{{student.name}} @{{student.last_name}}</p>
        </div>
        <div class="fs--1" ng-show="students && students.length === 0">
          <p>Aún no has registrado estudiantes para la realización de las guías de aprendizaje</p>
        </div>
        <div ng-click="registerUserForm()" class="cursor-pointer">
          <i class="fas fa-user-plus"></i> Registrar nuevo estudiante
        </div>
        <div ng-show="newRegisterForm" class="d-none-result d-none  dropdown-menu-card" id="elementkitsModal">
            <div class="modal-backdrop fade show"></div>
            <div class="position-absolute modal-menu card-notification shadow-none card" style="top: 0px;width: 100%;margin-left: -15px;">
                <div ng-click="newRegisterForm=false" class="position_absolute fs-2 cursor-pointer" style="top: 3px;right: 16px;left: 35px;text-align: right;position: absolute;"> <i class="far fa-times-circle"></i> </div>
                <div class="p-lg-6 p-sm-4">
                    @include('roles/tutor/register_student')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('/../angular/controller/TutorIndexController.js')}}"></script>
@endsection