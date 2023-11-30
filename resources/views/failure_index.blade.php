@extends("layouts.app")

@section("content")

    @if(session("message"))
        <div class="alert alert-{{session("danger")?"danger":"success"}}">
            {{session("message")}}
        </div>
    @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Peligros en la ciudad de Tupiza
            </div>
            <div class="card-body">
                <div class="container text-end mb-3">
                    <a href="{{route("failures.create")}}" class="btn btn-primary">Nuevo</a>
                </div>
                <div class="row g-3">
                    @foreach($failures as $failure)

                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <img src="{{url("images/failures/$failure->picture")}}" class="card-img-top"
                                     alt="{{$failure->description}}">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="container col-4">
                                            ID: {{$failure->id}}
                                        </div>
                                        <div class="container col-8 text-end">
                                            Fecha: {{$failure->date}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Dirección: {{$failure->location}}
                                    </p>
                                    <p class="card-text">
                                        Descripción: {{$failure->description}}
                                    </p>
                                    <div class="alert text-center"
                                         style="background-color: {{$failure->relStates->color}}">
                                        {{$failure->relStates->name}}
                                    </div>
                                    <div class="text-center">
                                        <div class="btn-group">
                                            <a href="https://www.openstreetmap.org/export/embed.html?bbox={{$failure->longitude-0.0034}}%2C{{$failure->latitude-0.0016}}%2C{{$failure->longitude+0.0034}}%2C{{$failure->latitude+0.0016}}&layer=mapnik&marker={{$failure->latitude}}%2C{{$failure->longitude}}"
                                               class="btn btn-success">
                                                Geolocalización
                                            </a>
                                            @auth()
                                                <a href="{{route("failures.edit", [$failure])}}"
                                                   class="btn btn-primary">
                                                    Editar</a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{$failure->id}}">
                                                    Eliminar
                                                </button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{$failure->id}}" tabindex="-1"
                             aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar falla</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Desea eliminar la falla seleccionada? Esta acción no puede deshacerse.
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route("failures.destroy", [$failure])}}" method="POST">
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
                </div>
                {{$failures->links("pagination::bootstrap-5")}}
            </div>
        </div>
    </div>

@endsection
