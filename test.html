<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AIS LOW LOST</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <link href='styles/index.css' rel='stylesheet' type='text/css' />
        <!-- CSS -->
        <style>
            body{
                margin:0
            }
            #maCarte{
                height: 100vh;
            }
        </style>
    </head>
    <body>
        <div id="maCarte"></div>


        <!-- Fichiers Javascript -->
        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
        <script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>
            var myIcon = L.icon({
			iconUrl:  "homme_a_la_mer.png",
			iconSize: [20, 20],
			iconAnchor: [20, 20],
			popupAnchor: [-3, -15],
		});
        
        </script>
        

        <script>
            //var carte = null;

             var carte = L.map('maCarte').setView([48.852969, 2.349903], 5);
             var t2=0;
            // On charge les "tuiles"
                 L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(carte);
             

            function Map() {
               var markerClusters;
               markerClusters = new L.markerClusterGroup();
               var marker2;
                marker2= new L.marker();

               $.ajax({
                
               type: "GET",
               url: "download_db.php",
               success: function(data){
                        var obj= JSON.parse(data);
                        carte.removeLayer(marker2);
                        var d = new  Date(parseInt(obj[0].time,10));
                        var time= d.toString(); 
                        //var t1 =obj[0].time; 

                                var marker1 = L.marker([obj[0].lat, obj[0].lon],{ icon: myIcon } );
                
           
                        marker1.bindPopup("LA :"+obj[0].lat+" "+"LO :"+obj[0].lon+" "+time.substr(0, 24) +
                                          "<br />Rssi :"+ obj[0].rssi+" dBm" );
                        marker1.addTo(carte);
                       // marker2 =marker1;
                        
                        for (var i=1;i<obj.length;i++)
                        {
                            d = new  Date(parseInt(obj[i].time,10));
                            time= d.toString(); 
                            var marker = L.marker([obj[i].lat, obj[i].lon] );
                            marker.bindPopup("LA :"+obj[i].lat+" "+"LO :"+obj[i].lon+" "+time.substr(0, 24)
                                             + "<br />Rssi :" +obj[0].rssi+" dBm" );
                            markerClusters.addLayer(marker);
                          
                        }
                       carte.addLayer(markerClusters);
                            var villes = new Array();
                            for (var i=0;i<obj.length;i++)
                                {
                                    villes[i] =   new Array(i.toString,obj[i].lat,obj[i].lon);
                                    
                                }
                   
                              var trajet = new L.Polyline(pointsArray(villes));
                            carte.addLayer(trajet);
                      
                }
                 
            });
                 
            function pointsArray(items) {
	        var pointsArray = new Array();
	        for (var i = 0; i < items.length; i++) {
		    var item = items[i];
		          pointsArray.push(new L.LatLng(item[1],item[2]));
	           }
	       return pointsArray;
            }

            }
        window.onload = function(){
		// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
		Map(); 
	    };

        
        </script>
    </body>
</html>
