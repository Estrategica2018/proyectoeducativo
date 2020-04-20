
   <div class="">
      <div class="row">
         <h6><i class="fa fas fa-arrow-right arrow-icon"></i>Registra los datos del estudiante</h6>
           <div class="col-12 d-flex mt-3">
              <div class="register-avatar-kid" ng-click="kidSelected=1" ng-class="{'selected':kidSelected===1}">
                <img src="{{asset('images/icons/kid2.png')}}" width="103px;"/>
                <span>Niño</span>
              </div>
              <div class="register-avatar-kid" ng-click="kidSelected=2" ng-class="{'selected':kidSelected===2}">
                <img src="{{asset('images/icons/kid1.png')}}" width="103px;"/>
                <span>Niña</span>
              </div>
              <div class="register-avatar-kid" ng-click="kidSelected=3" ng-class="{'selected':kidSelected===3}">
                 <img src="{{asset('images/icons/kid3.png')}}" width="103px;"/>
                 <span>Joven</span>
              </div>
           </div>
           
           <div class="form-group col-lg-4">
              <label class=""><i class="fa fas fa-arrow-right arrow-icon"></i>{{ __('Nombre') }}</label>
              <input placeholder="" type="text" name="name" ng-model="newStudent.name"
                    class="form-control @error('name') is-invalid @enderror" value="">
              @error('name')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
              @enderror
           </div>
           <div class="form-group col-lg-4">
              <label class="">{{ __('Apellido') }}</label>
              <input placeholder="" type="text" name="last_name"  ng-model="newStudent.last_name"
                    class="form-control @error('last_name') is-invalid @enderror" value="">
              @error('last_name')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
              @enderror
           </div>
           <div class="form-group col-lg-4">
              <label class="">{{ __('Fecha de nacimiento') }}</label>
              <input placeholder="día/mes/año" type="text" name="birthday"  ng-model="newStudent.birthday"
                    class="form-control @error('birthday') is-invalid @enderror" value="">
              @error('birthday')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
              @enderror
           </div>
		   <span class="fs--1 pl-3">La plataforma asignará un usuario y contraseña que será enviada al correo electrónico la cual podrá ser cambiada luego</span>
           <div class="form-row mt-3 pl-3">
		      <button type="submit" class="btn btn-small btn-primary d-flex" ng-click="onRegistry()">
                 <div ng-show="loagingRegistry"><i class="fa fa-spinner fa-spin mr-2"></i></div>
				 {{ __('Finalizar registro') }}
              </button>
              <span ng-show="errorMessageRegister" class="invalid-feedback" role="alert">
                 <strong>@{{errorMessageRegister}}</strong>
              </span>
           </div>
      </div>
   </div>