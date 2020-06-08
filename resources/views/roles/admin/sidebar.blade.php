<div class="col-md-4">
    <div class="mb-3 card">
        <div class="card-header"><h5 class="mb-0">Administrador: {{auth('afiliadoempresa')->user()->name . ' ' . auth('afiliadoempresa')->user()->last_name}}</h5></div>
        <div class="bg-light card-body">
            
            <div class="mb-3">
                <ul class="list-group">
                    <li class="list-group-item btn"><a href="{{route('fileupload')}}">Carga masiva</a></li>
                    <li class="list-group-item btn"><a href="{{route('fileuploadlogs')}}">Lista carga masiva</a></li>
                    <li class="list-group-item btn"><a href="{{route('admin.get_sequences_list')}}">Diseño de Guías de aprendizaje</a></li>
                    <li class="list-group-item btn"><a href="{{route('get_users_contracted_products_view')}}">Usuarios con contenidos vigentes</a></li>
                    <li class="list-group-item btn"><a href="{{route('plans_view')}}">Planes de acceso</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
