<!DOCTYPE html>
<html>
<head>
    <title>UIoT - Device Map Application</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <style type="text/css">
        html {
            height: 100%
        }

        body {
            height: 100%;
            margin: 0;
            padding: 0
        }

        #map_canvas {
            height: 100%;
            width: 100%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqUnT1apZfZWIfVl9m1FGd54GOl2KtaEQ"></script>
    <script type="text/javascript">
        var map;
        var infowindow = new google.maps.InfoWindow();
		
		function setMarkers() {
			$.getJSON('http://raise.uiot.org/arguments?token=f4315a8869bc60575be956b97d2cc4b3b2577c08', function(jsonMap) {
				$.each(jsonMap, function (key, data) {		
					if(data.name.indexOf('latitude_') >= 0) {
						var latLng = new google.maps.LatLng(data.return_value, jsonMap[key + 1].return_value);
						
						data.name = 'Device_' + data.name.substring(data.name.indexOf('_') + 1);

						var marker = new google.maps.Marker({
							position: latLng,
							map: map,
							title: data.name
						});

						var contentString = '<div id="content">'+
						  '<div id="siteNotice">'+
						  '</div>'+
						  '<h1 id="firstHeading" class="firstHeading">' + data.name + '</h1>'+
						  '<div id="bodyContent">'+
						  '<p>Position collected through <b>UIoT</b> at time ' + data.time + '</p>'+
						  '<p>See more details at: <a target="_blank" href="https://uims.uiot.org/arguments/edit?id=' + data.id + '">UIMS</a></p>'+
						  '</div>'+
						  '</div>';
						  
						var infowindow = new google.maps.InfoWindow({
							content: contentString
						});

						marker.addListener('click', function() {
							infowindow.open(map, marker);
						});
					}
				});
			});
		}

        function initialize() {		
			//alert('Bem-Vindo ao UIoT Device Localization Application!');

            var mapProp = {
                center: new google.maps.LatLng(-11.5472704, -63.5385424),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map_canvas'), mapProp);

            map.setOptions({minZoom: 3, maxZoom: 30});
			
			setMarkers();
        }
		
		setInterval(function() {
			console.log('Atualizando Dispositivos IoT');
			
			setMarkers();
		}, 10000);

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
<div id="map_canvas"></div>
</body>
</html>
