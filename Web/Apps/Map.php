<?php

/*
 *
 *              (C) 2016 UIoT
 *
 *                oo
 *
 *       dP    dP dP 88d8b.d8b. .d8888b.
 *       88    88 88 88'`88'`88 Y8ooooo.
 *       88.  .88 88 88  88  88       88
 *       `88888P' dP dP  dP  dP `88888P'
 *
 *     Smart IoT Network Management System
 *
 */

require_once(__DIR__ . '/../UIoT/Vendor/autoload.php');

use Httpful\Mime;
use Httpful\Request;

error_reporting(0);

$jSON = Request::get('http://raise.uiot.org/arguments?token=f4315a8869bc60575be956b97d2cc4b3b2577c08',
    Mime::JSON)->send()->body;

$newJON = [];

foreach ($jSON as $itemKey => $itemValue) {
    if (strpos($itemValue->name, 'latitude_') !== false) {
        $actualItem = new stdClass();
        $actualItem->title = 'Device' . strstr($itemValue->name, '_', false);
        $actualItem->lat = $itemValue->return_value;
        $actualItem->lng = $jSON[$itemKey + 1]->return_value;

        $newJON[] = $actualItem;
    }
}

echo('<script>var jsonMap = ' . json_encode($newJON) . ';</script>');

?>

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
    <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDqUnT1apZfZWIfVl9m1FGd54GOl2KtaEQ"></script>
    <script type="text/javascript">
        var map;
        var infowindow = new google.maps.InfoWindow();

        function initialize() {

            var mapProp = {
                center: new google.maps.LatLng(-11.5472704, -63.5385424),
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map_canvas'), mapProp);

            map.setOptions({minZoom: 3, maxZoom: 30});

            $.each(jsonMap, function (key, data) {

                var latLng = new google.maps.LatLng(data.lat, data.lng);

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: data.title
                });

                var details = data.title + ", using UIoT";

                bindInfoWindow(marker, map, infowindow, details);
            });
        }

        function bindInfoWindow(marker, map, infowindow, strDescription) {
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(strDescription);
                infowindow.open(map, marker);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
<div id="map_canvas"></div>
</body>
</html>
