@extends("layouts.app")

@section("content")

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Editar usuario
            </div>
            <div class="card-body">
                <form action="{{route("users.update", [$user])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{old("name", $user->name)}}">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="{{old("email", $user->email)}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control"
                               value="{{old("password", $user->password)}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Editar</button>
                        <a href="{{route("users.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
