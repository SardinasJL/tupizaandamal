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
                Estados
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>
                                <a href="{{route("states.create")}}" class="btn btn-primary">Nuevo</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($states as $state)
                            <tr>
                                <td class="text-end col-2">{{$state->id}}</td>
                                <td class="text-center col-6">{{$state->name}}</td>
                                <td style="background-color: {{$state->color}}"></td>
                                <td class="text-center col-6">
                                    <div class="btn-group">
                                        <a href="{{route("states.edit", [$state])}}"
                                           class="btn btn-secondary">Editar</a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{$state->id}}">
                                            Eliminar
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$state->id}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Eliminar state
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea eliminar el estado con id = {{$state->id}}?
                                                    Esta acción no puede deshacerse.
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route("states.destroy",[$state])}}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
