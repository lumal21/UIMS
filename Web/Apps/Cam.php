<!DOCTYPE html>
<html>
<head>
    <title>UIoT - Latitude Camera Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.3/foundation.min.css">
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

        #cam_canvas {
            height: 100%;
            width: 100%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<div class="callout" style="background:#0a0a0a;color:white;margin-bottom:0">
    <h6><b>Welcome to UIoT RaspBerry Camera Application </b> <i>(#002)</i> | When you're ready, you can go back to UIMS through <a
            href="/home">here</a>.</h6>
</div>
<iframe id="cam_canvas" src="http://172.16.9.70:8081" style="border:0px solid transparent;"></iframe>
</body>
</html>
