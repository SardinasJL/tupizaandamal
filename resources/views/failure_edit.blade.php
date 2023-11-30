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
                Editar peligro
            </div>
            <div class="card-body">
                <form action="{{route("failures.update", $failure)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="map" style="height: 400px"></div>
                    <div class="mb-3">
                        <label for="picture">Fotografía/imagen</label>
                        <input type="file" name="picture" id="picture" class="form-control">
                        <input type="hidden" name="picture" id="picture" value="{{$failure->picture}}">
                    </div>
                    <div class="mb-3">
                        <label for="location">Dirección</label>
                        <input type="text" name="location" id="location" value="{{old("location", $failure->location)}}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description">Descripción</label>
                        <input type="text" name="description" id="description"
                               value="{{old("description", $failure->description)}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="latitute">Latitud</label>
                        <input type="number" name="latitude" id="latitude" step="any"
                               value="{{old("latitude", $failure->latitude)}}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="longitude">Longitud</label>
                        <input type="number" name="longitude" id="longitude" step="any"
                               value="{{old("longitude", $failure->longitude)}}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" value="{{old("date", $failure->date)}}"
                               class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="states_id">Estado</label>
                        <select name="states_id" id="states_id" class="form-select">
                            @foreach($states as $state)
                                <option value="{{$state->id}}"
                                    {{old("states_id", $failure->states_id)==$state->id?"selected":""}}>
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
        var map = L.map('map').setView([{{$failure->latitude}}, {{$failure->longitude}}], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        var marker = L.marker([{{$failure->latitude}}, {{$failure->longitude}}]).addTo(map);
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
