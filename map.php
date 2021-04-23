<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link rel="stylesheet" href="style-map.css">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <title>Document</title>
</head>
<body>

    <a href="index.php"><button id="backButton">Back</button></a>
    <div id="MOTContainer"></div>
    <div id='map' style='width: 100vw; height: 100vh;'></div>

    <script>

        //TRANSPORT.OPENDATA API
        var RequestFrom = "<?php echo $_GET['RequestFrom'] ?>;"
        var RequestTo = "<?php echo $_GET['RequestTo'] ?>;"
        fetch('http://transport.opendata.ch/v1/connections?from='+RequestFrom+'&to='+RequestTo)
        .then(response => response.json())
        //.then(data => console.log(data))
        .then(data => {
            coordsFromX = data['from']['coordinate']['x'];
            coordsFromY = data['from']['coordinate']['y'];
            coordsToX = data['to']['coordinate']['x'];
            coordsToY = data['to']['coordinate']['y'];
            
            products = data['connections'][2]['products'];
        })
        //MAPBOX
        .then(data =>{
            mapboxgl.accessToken = 'pk.eyJ1IjoiamFzZWtrIiwiYSI6ImNrbmhpZGVzNDJsYzgydm1yazM4dWl2a2MifQ.FPM68PUPvknBwJNJRYIrRw';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [7.5594406, 47.5546492],
                zoom: 12
            });
            //navigation controls (plus minus zoom in and out)
            map.addControl(new mapboxgl.NavigationControl());
            var markerFrom = new mapboxgl.Marker({
                color: "#50ED65",
                draggable: false
                }).setLngLat([coordsFromY,coordsFromX])
                .addTo(map);
            var markerTo = new mapboxgl.Marker({
                color: "#EC2A2A",
                draggable: false
                }).setLngLat([coordsToY,coordsToX])
                .addTo(map);

            //Display Logo of transportation method for each step (in order)
            products.forEach(PrintLogos)
            function PrintLogos(item, index){
                console.log(item);
                if(item == 1 || 2 || 3 || 6 || 8 || 10 || 11 || 14 || 15 || 16 || 17 || 21){
                    var Logo = "img/tram.png"
                }
                if(item > 21){
                    var Logo = "img/bus.png"
                }
                if(item == "ICE"){
                    var Logo = "img/ice.png"
                }
                if(item.startsWith("S") || item == "EC" || item.startsWith("IC")){
                    var Logo = "img/sbb.png"
                }

                document.getElementById("MOTContainer").innerHTML += '<img src="'+Logo+'" class="logos"></img><p class="logoText">'+item+'</p>';

                var Logo = "";            

            }
                //visualisation of the route
        })
    </script>
    
</body>
</html>