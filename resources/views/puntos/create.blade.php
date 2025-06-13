@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Registrar Punto de Interés Turístico</h2>

  <form method="POST" action="{{ route('puntos.store') }}" enctype="multipart/form-data"
        onsubmit="return confirm('¿Estás seguro de guardar esto?');">
    @csrf

    <div class="mb-3">
      <label>Nombre</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Descripción</label>
      <textarea name="descripcion" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label>Categoría</label>
      <select name="categoria" class="form-control" required>
        <option value="">Selecciona una categoría</option>
        <option value="natural">Natural</option>
        <option value="cultural">Cultural</option>
        <option value="histórico">Histórico</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Imagen (opcional)</label>
      <input type="file" name="imagen" class="form-control">
    </div>

    <div class="mb-3">
      <label>Latitud</label>
      <input type="text" id="lat" name="latitud" class="form-control" readonly required>
    </div>

    <div class="mb-3">
      <label>Longitud</label>
      <input type="text" id="lng" name="longitud" class="form-control" readonly required>
    </div>

    <div class="d-flex gap-2 mt-4">
      <button type="submit" class="btn btn-primary">💾 Guardar</button>
      <a href="{{ route('puntos.index') }}" class="btn btn-secondary">← Regresar</a>
    </div>
  </form>

  <div id="map" style="height: 400px; margin-top: 20px;"></div>
</div>
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdmGvaMxpsmSxK6QooJJRoCf2ym5kTYIE"></script>
<script>
  function initMap() {
    const centro = { lat: -0.180653, lng: -78.467834 }; // Quito, Ecuador

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12,
      center: centro,
    });

    let marcador;

    google.maps.event.addListener(map, "click", function (e) {
      const lat = e.latLng.lat();
      const lng = e.latLng.lng();

      document.getElementById("lat").value = lat;
      document.getElementById("lng").value = lng;

      if (marcador) marcador.setMap(null);

      marcador = new google.maps.Marker({
        position: e.latLng,
        map: map,
        title: "Ubicación seleccionada"
      });
    });
  }

  window.onload = initMap;
</script>
@endsection
