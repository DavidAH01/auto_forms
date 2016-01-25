<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <div class="row">
        <div class="col-md-6">
            <div id="map_<?= $field['complete_name'] ?>" class="map-canvas"></div> 
        </div>
        <div id="infoPanel" class="col-md-6">
            <label><strong>Current position:</strong></label>
            <input type="text" readonly="readonly" id="info_<?= $field['complete_name'] ?>" class="save-input form-control" name="<?= $field['complete_name'] ?>" value="<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>">
            <br>
            <label><strong>Address:</strong> <small>(not exactly)</small></label>
            <div id="address_<?= $field['complete_name'] ?>"></div>
        </div>
    </div>
</div><hr>

<script type="text/javascript">
    var save_position = "<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>";
    var geocoder = new google.maps.Geocoder();

    function geocodePosition_<?= $field['complete_name'] ?>(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
          if (responses && responses.length > 0) {
            updateMarkerAddress_<?= $field['complete_name'] ?>(responses[0].formatted_address);
          } else {
            updateMarkerAddress_<?= $field['complete_name'] ?>('Cannot determine address at this location.');
          }
        });
    }

    function updateMarkerPosition_<?= $field['complete_name'] ?>(latLng) {
        document.getElementById("info_<?= $field['complete_name'] ?>").value = [
          latLng.lat(),
          latLng.lng()
        ].join(', ');
    }

    function updateMarkerAddress_<?= $field['complete_name'] ?>(str) {
        document.getElementById("address_<?= $field['complete_name'] ?>").innerHTML = str;
    }

    function initialize() {
        var latLng = new google.maps.LatLng(-34.397, 150.644);
        var map = new google.maps.Map(document.getElementById("map_<?= $field['complete_name'] ?>"), {
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
        geocodePosition_<?= $field['complete_name'] ?>(latLng);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                if(save_position != ''){
                    map.setCenter(new google.maps.LatLng(<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>));
                    marker.setPosition(new google.maps.LatLng(<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>));
                    geocodePosition_<?= $field['complete_name'] ?>(new google.maps.LatLng(<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>));
                }else{
                    latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(latLng);
                    marker.setPosition(latLng);
                    geocodePosition_<?= $field['complete_name'] ?>(latLng);
                }
            });
        }
        
        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress_<?= $field['complete_name'] ?>('Dragging...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerPosition_<?= $field['complete_name'] ?>(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            geocodePosition_<?= $field['complete_name'] ?>(marker.getPosition());
        });
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
</script>