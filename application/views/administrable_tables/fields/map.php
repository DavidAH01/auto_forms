<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <div class="row">
        <div class="col-md-6">
            <div id="<?= $field['complete_name'] ?>" class="map-canvas"></div> 
        </div>
        <div id="infoPanel" class="col-md-6">
            <label><strong>Current position:</strong></label>
            <input type="text" readonly="readonly" id="info_<?= $field['complete_name'] ?>" class="save-input form-control" name="">
            <br>
            <label><strong>Address:</strong> <small>(not exactly)</small></label>
            <div id="address_<?= $field['complete_name'] ?>"></div>
        </div>
    </div>
</div><hr>

<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();

    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
          if (responses && responses.length > 0) {
            updateMarkerAddress(responses[0].formatted_address);
          } else {
            updateMarkerAddress('Cannot determine address at this location.');
          }
        });
    }

    function updateMarkerPosition(latLng) {
        document.getElementById('info_<?= $field['complete_name'] ?>').value = [
          latLng.lat(),
          latLng.lng()
        ].join(', ');
    }

    function updateMarkerAddress(str) {
        document.getElementById('address_<?= $field['complete_name'] ?>').innerHTML = str;
    }

    function initialize() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(latLng);
                marker.setPosition(latLng);
                updateMarkerPosition(latLng);
                geocodePosition(latLng);
            });
        }

        var latLng = new google.maps.LatLng(-34.397, 150.644);
        var map = new google.maps.Map(document.getElementById('<?= $field['complete_name'] ?>'), {
            zoom: 8,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Marker',
            map: map,
            draggable: true
        });

        // Update current position info.
        updateMarkerPosition(latLng);
        geocodePosition(latLng);
        
        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Dragging...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            geocodePosition(marker.getPosition());
        });
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
</script>