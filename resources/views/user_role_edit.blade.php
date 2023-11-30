@extends("layouts.app")

@section("content")
    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                Editar roles
            </div>
            <div class="card-body">
                <form action="{{route("users.roles.update", [$user])}}" method="post">
                    @csrf
                    @method("PUT")
                    @foreach($roles as $role)
                        <div class="mb-3">
                            <label for="{{$role->name}}">{{$role->name}}</label>
                            <input type="checkbox" name="roles[]" id="{{$role->name}}" value="{{$role->name}}"
                            @foreach($user->getRoleNames() as $userRoles)
                                {{$role->name==$userRoles?"checked":""}}
                                @endforeach
                            >
                        </div>
                    @endforeach
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("users.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
