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
                Usuarios
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th><a href="{{route("users.create")}}" class="btn btn-primary">Nuevo</a></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->password}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route("users.roles.edit", [$user])}}" class="btn btn-info">Roles</a>
                                        <a href="{{route("users.edit", [$user])}}" class="btn btn-primary">Editar</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$user->id}}">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea borrar al usuario {{$user->name}}?.
                                            Esta acción no puede deshacerse
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route("users.destroy", [$user])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
