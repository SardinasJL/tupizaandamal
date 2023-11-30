@extends("layouts.app")

@section("content")
    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Permisos
            </div>
            <div class="card-body">
                <form action="{{route("roles.permissions.update", [$role])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="mb-3 col-3">
                                <label for="{{$permission->name}}">{{$permission->name}}</label>
                                <input type="checkbox" name="permissions[]" id="{{$permission->name}}"
                                       value="{{$permission->name}}"
                                @foreach($role->getPermissionNames() as $rolePermission)
                                    {{$permission->name == $rolePermission?"checked":""}}
                                    @endforeach
                                >
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("roles.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
