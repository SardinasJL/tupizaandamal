@extends("layouts.app")

@section("content")

    @if(session("message"))
        <div class="alert alert-{{session("danger")?"danger":"success"}}">
            {{session("message")}}
        </div>
    @endif

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Roles
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th><a href="{{route("roles.create")}}" class="btn btn-primary">Nuevo</a></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route("roles.permissions.edit", [$role])}}" class="btn btn-info">Permisos</a>
                                        <a href="{{route("roles.edit", [$role])}}" class="btn btn-primary">Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$role->id}}">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{$role->id}}" tabindex="-1"
                                 aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar rol</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea eliminar el rol {{$role->name}}?<br>
                                            Esta acción no puede deshacerse.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route("roles.destroy", [$role])}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
