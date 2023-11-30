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
                Nuevo peligro
            </div>
            <div class="card-body">
                <form action="{{route("failures.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="map" style="height: 400px"></div>
                    <div class="mb-3">
                        <label for="picture">Fotografía/imagen</label>
                        <input type="file" name="picture" id="picture" value="{{old("picture")}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="location">Dirección</label>
                        <input type="text" name="location" id="location" value="{{old("location")}}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description">Descripción</label>
                        <input type="text" name="description" id="description" value="{{old("description")}}"
                               class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="latitute">Latitud</label>
                            <input type="number" name="latitude" id="latitude" step="any" value="{{old("latitude")}}"
                                   class="form-control" readonly>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="longitude">Longitud</label>
                            <input type="number" name="longitude" id="longitude" step="any" value="{{old("longitude")}}"
                                   class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" value="{{old("date")}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="states_id">Estado</label>
                        <select name="states_id" id="states_id" class="form-select">
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{old("states_id")==$state->id?"selected":""}}>
                                    {{$state->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="container text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{route("failures.index")}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-21.444171267761174, -65.72070837020874], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        var marker = L.marker([-21.444171267761174, -65.72070837020874]).addTo(map);
        map.on('move', function () {
            var center = map.getCenter(); // Obtiene el centro del mapa
            marker.setLatLng(center); // Establece la posición del marcador en el centro
            let markerCoordinate = marker._latlng;
            document.getElementById("latitude").value = markerCoordinate.lat;
            document.getElementById("longitude").value = markerCoordinate.lng;
        });
        map.fire('move');
    </script>
@endsection
