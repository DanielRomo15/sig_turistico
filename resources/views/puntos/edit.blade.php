@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Editar Punto de Interés Turístico</h2>

  <form method="POST" action="{{ route('puntos.update', $punto->id) }}" enctype="multipart/form-data"
        onsubmit="return confirm('¿Estás seguro de actualizar este punto?');">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{ $punto->nombre }}" required>
    </div>

    <div class="mb-3">
      <label>Descripción</label>
      <textarea name="descripcion" class="form-control" required>{{ $punto->descripcion }}</textarea>
    </div>

    <div class="mb-3">
      <label>Categoría</label>
      <select name="categoria" class="form-control" required>
        <option value="natural" {{ $punto->categoria == 'natural' ? 'selected' : '' }}>Natural</option>
        <option value="cultural" {{ $punto->categoria == 'cultural' ? 'selected' : '' }}>Cultural</option>
        <option value="histórico" {{ $punto->categoria == 'histórico' ? 'selected' : '' }}>Histórico</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Imagen actual</label><br>
      @if($punto->imagen)
        <img src="{{ asset('storage/' . $punto->imagen) }}" width="200" class="mb-2">
      @else
        <p>No hay imagen</p>
      @endif
    </div>

    <div class="mb-3">
      <label>Cambiar imagen</label>
      <input type="file" name="imagen" class="form-control">
    </div>

    <div class="mb-3">
      <label>Latitud</label>
      <input type="text" id="lat" name="latitud" class="form-control" value="{{ $punto->latitud }}" readonly required>
    </div>

    <div class="mb-3">
      <label>Longitud</label>
      <input type="text" id="lng" name="longitud" class="form-control" value="{{ $punto->longitud }}" readonly required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>

  <div id="map" style="height: 400px; margin-top: 20px;"></div>
</div>
@endsection

@section('scripts')
<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdmGvaMxpsmSxK6QooJJRoCf2ym5kTYIE"></script>

<!-- Mapa para actualizar ubicación -->
<script>
  function initMap() {
    const posicionInicial = {
      lat: parseFloat({{ $punto->latitud }}),
      lng: parseFloat({{ $punto->longitud }})
    };

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: posicionInicial,
    });

    let marcador = new google.maps.Marker({
      position: posicionInicial,
      map: map,
      title: "Ubicación actual"
    });

    google.maps.event.addListener(map, "click", function (e) {
      const lat = e.latLng.lat();
      const lng = e.latLng.lng();

      document.getElementById("lat").value = lat;
      document.getElementById("lng").value = lng;

      marcador.setMap(null);
      marcador = new google.maps.Marker({
        position: e.latLng,
        map: map,
        title: "Nueva ubicación"
      });
    });
  }

  window.onload = initMap;
</script>
@endsection
