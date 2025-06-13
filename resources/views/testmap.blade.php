<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de prueba</title>
  <style>
    #map {
      height: 500px;
      width: 100%;
    }
  </style>
</head>
<body>
  <h2>Prueba de Mapa de Google</h2>
  <div id="map"></div>

  <!-- API de Google Maps con callback -->
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdmGvaMxpsmSxK6QooJJRoCf2ym5kTYIE&callback=initMap">
  </script>

  <!-- Inicialización de mapa -->
  <script>
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: { lat: -0.2113576, lng: -78.5069704 }
      });

      const marker = new google.maps.Marker({
        position: { lat: -0.2113576, lng: -78.5069704 },
        map,
        title: "Centro de Arte de Quito"
      });
    }
  </script>
</body>
</html>
