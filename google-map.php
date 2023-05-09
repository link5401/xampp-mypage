<div id="map" style="width:100%;height:400px;"></div>
<form id="lng-lat-form">
  <label for="latitude">Latitude:</label>
  <input type="text" id="latitude" name="latitude">
  <label for="longitude">Longitude:</label>
  <input type="text" id="longitude" name="longitude">
  <button type="submit">Show on Map</button>
</form>
<form id="address-form">
  <label for="address">Address: </label>
  <input type="text" id="address" name="address">
  <button type="button">Show on Map</button>
</form>

<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: {
        lat: 37.7749,
        lng: -122.4194
      } // San Francisco, CA
    });

    var marker = new google.maps.Marker({
      map: map,
      position: {
        lat: 37.7749,
        lng: -122.4194
      } // San Francisco, CA
    });

    $('#lng-lat-form').submit(function(e) {
      e.preventDefault();
      var latitude = parseFloat($('#latitude').val());
      var longitude = parseFloat($('#longitude').val());

      if (isNaN(latitude) || isNaN(longitude)) {
        alert('Please enter valid latitude and longitude values');
        return;
      }

      var location = {
        lat: latitude,
        lng: longitude
      };

      marker.setMap(null);
      map.setCenter(location);
      marker = new google.maps.Marker({
        map: map,
        position: location
      });
    });
    $('#address-form').click(function(e) {
      e.preventDefault();
      var address = $('#address').val();

      var latLng = new google.maps.LatLng(37.7749, -122.4194);
      var geocoder = new google.maps.Geocoder();

      geocoder.geocode({
        'address': address
      }, function(results, status) {
        if (status === 'OK') {
          latLng = results[0].geometry.location;

          map.setCenter(latLng);
          map.setZoom(15);

          var marker = new google.maps.Marker({
            map: map,
            position: latLng
          });
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNI_ZWPqvdS6r6gPVO50I4TlYkfkZdXh8&callback=initMap"></script>

</body>

</html>