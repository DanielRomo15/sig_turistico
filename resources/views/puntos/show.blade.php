@extends('layouts.app')

@section('content')
<div class="container">
  <h2>{{ $punto->nombre }}</h2>

  @if($punto->imagen)
    <div class="mb-3">
      <img src="{{ asset('storage/' . $punto->imagen) }}" alt="Imagen del punto" class="img-fluid" style="max-width: 400px;">
    </div>
  @endif

  <p><strong>Categoría:</strong> {{ $punto->categoria }}</p>
  <p><strong>Descripción:</strong><br>{{ $punto->descripcion }}</p>
  <p><strong>Latitud:</strong> {{ $punto->latitud }}</p>
  <p><strong>Longitud:</strong> {{ $punto->longitud }}</p>

  <div id="map" style="height: 400px; margin-top: 20px;"></div>

  <a href="{{ route('puntos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdmGvaMxpsmSxK6QooJJRoCf2ym5kTYIE"></script>
<script>/* ... */</script>
@endsection

<script>
  function initMap() {
    const ubicacion = {
      lat: parseFloat({{ $punto->latitud }}),
      lng: parseFloat({{ $punto->longitud }})
    };

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 12,
      center: ubicacion
    });

    new google.maps.Marker({
      position: ubicacion,
      map: map,
      title: "{{ $punto->nombre }}"
    });
  }

  window.onload = initMap;
</script>
@endsection
