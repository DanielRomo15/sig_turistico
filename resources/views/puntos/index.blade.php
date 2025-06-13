@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Puntos Turísticos Registrados</h2>

    <a href="{{ route('puntos.create') }}" class="btn btn-primary">
      ➕ Agregar nuevo punto
    </a>
  </div>

  <!-- Formulario de búsqueda -->
  <form method="GET" action="{{ route('puntos.index') }}" class="row g-3 mb-4">
    <div class="col-md-5">
      <input type="text" name="nombre" value="{{ request('nombre') }}" class="form-control" placeholder="Buscar por nombre">
    </div>
    <div class="col-md-4">
      <select name="categoria" class="form-select">
        <option value="">Todas las categorías</option>
        <option value="natural" {{ request('categoria') == 'natural' ? 'selected' : '' }}>Natural</option>
        <option value="cultural" {{ request('categoria') == 'cultural' ? 'selected' : '' }}>Cultural</option>
        <option value="histórico" {{ request('categoria') == 'histórico' ? 'selected' : '' }}>Histórico</option>
      </select>
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-outline-primary w-100">🔍 Buscar</button>
    </div>
  </form>

  <!-- Mapa -->
  <div id="map" style="height: 500px; width: 100%;" class="mb-4 border"></div>

  <!-- Tabla -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Latitud</th>
          <th>Longitud</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($puntos as $p)
        <tr>
          <td>{{ $p->nombre }}</td>
          <td>{{ $p->categoria }}</td>
          <td>{{ $p->latitud }}</td>
          <td>{{ $p->longitud }}</td>
          <td class="d-flex gap-1">
            <a href="{{ route('puntos.edit', $p->id) }}"
               class="btn btn-sm btn-warning"
               onclick="return confirm('¿Estás seguro de editar este punto?');">
              ✏️ Editar
            </a>
            <form action="{{ route('puntos.destroy', $p->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este punto?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">
                🗑 Eliminar
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<!-- Inicialización del mapa -->
<script>
  window.initMap = function () {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: { lat: -0.180653, lng: -78.467834 }
    });

    @foreach($puntos as $p)
      let marker = new google.maps.Marker({
        position: { lat: {{ $p->latitud }}, lng: {{ $p->longitud }} },
        map: map,
        title: "{{ $p->nombre }}"
      });

      let infowindow = new google.maps.InfoWindow({
        content: `<strong>{{ $p->nombre }}</strong><br>{{ $p->descripcion }}<br><em>{{ $p->categoria }}</em>`
      });

      marker.addListener("click", function () {
        infowindow.open(map, marker);
      });
    @endforeach
  };
</script>

<!-- Cargar Google Maps API -->
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdmGvaMxpsmSxK6QooJJRoCf2ym5kTYIE&callback=initMap">
</script>
@endsection
