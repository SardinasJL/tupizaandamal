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
                Nuevo usuario
            </div>
            <div class="card-body">
                <form action="{{route("users.store")}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old("name")}}">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{old("email")}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control"
                               value="{{old("password")}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("users.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
