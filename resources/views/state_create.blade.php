@extends("layouts.app")

@section("content")

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Crear estado
            </div>
            <div class="card-body">
                <form action="{{route("states.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" value="{{old("name")}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="color">Color</label>
                        <input type="color" name="color" id="color" value="{{old("color")}}" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("states.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
