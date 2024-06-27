
<?php  session_start(); 
 $_SESSION['errors']="";

?> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AIS LOW LOST</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <link href='styles/menu1.css' rel='stylesheet' type='text/css' />
        <!-- CSS -->
        <style>

            #maCarte{
                height: 100vh;
            }
        </style>
    </head>
   
    <body>

        <ul id="menu_horizontal">

            <li class="bouton_gauche"><a href="accueil.php">Home</a></li>
            <li class="bouton_gauche"><a href="connexion.php"onclick="window.open(this.href);return false">Register User</a></li>
<li class="bouton_gauche"><a href="inscription_admin.php"onclick="window.open(this.href);return false">Register Admin</a></li>
<li class="bouton_droite"><a href="historical.php"onclick="window.open(this.href);return false">historical</a></li>
<li class="bouton_droite"><a href="contact.php">Contact</a></li>
<li class="bouton_droite"><a href="logo"><img src="vn.png"></a></li>
</ul>
        
   
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
        var myIcon1 = L.icon({
			iconUrl:  "homme_a_la_mer_rouge.png",
			iconSize: [20, 20],
			iconAnchor: [20, 20],
			popupAnchor: [-3, -15],
		});
        var myIcon2 = L.icon({
			iconUrl:  "homme_a_la_mer_vert.png",
			iconSize: [20, 20],
			iconAnchor: [20, 20],
			popupAnchor: [-3, -15],
		});
       var myIcon3 = L.icon({
			iconUrl:  "homme_a_la_mer_jaune.png",
			iconSize: [20, 20],
			iconAnchor: [20, 20],
			popupAnchor: [-3, -15],
		});
        
        
        </script>
        

        <script>
            //var carte = null;
            var icon=[myIcon,myIcon2,myIcon3,myIcon,myIcon2,myIcon3,myIcon,myIcon2,myIcon3];
             var carte = L.map('maCarte').setView([48.852969, 2.349903], 5);
             var villes =null;
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
               url: "gps.php",
               success: function(data){
                        var obj= JSON.parse(data);
                       var j =0;
                       for (var i=obj.length;i>1;i=i-2)
                        {
                            var d = new  Date(parseInt(obj[i-1].time,10));
                            var time= d.toString();
                            var marker = L.marker([obj[i-1].lat, obj[i-1].lon],{ icon: icon[j++] } );
                            marker.bindPopup(obj[i-1].name+" LA :"+obj[i-1].lat+" "+"LO :"+obj[i-1].lon+"<br />"
                                +time.substr(0, 24)
                                             + "Rssi :" +obj[i-1].rssi+" dBm" );
                                markerClusters.addLayer(marker);
                             d = new  Date(parseInt(obj[i-2].time,10));
                             var time1= d.toString();                        
                            
                            if (obj[i-1].name==obj[i-2].name){
                                var marker1 = L.marker([obj[i-2].lat, obj[i-2].lon]);
                                marker1.bindPopup(obj[i-2].name+" LA :"+obj[i-2].lat+" "+"LO :"+obj[i-2].lon+"<br />"
                                +time1.substr(0, 24)
                                             + "Rssi :" +obj[i-2].rssi+" dBm" );
                                markerClusters.addLayer(marker1);
                                villes = [
	                               ["marker1", obj[i-2].lat, obj[i-2].lon],
	                               ["marker2", obj[i-1].lat, obj[i-1].lon]
                                ];
                                var trajet = new L.Polyline(pointsArray(villes));
                                carte.addLayer(trajet);
                            }
                            else{
                                var marker1 = L.marker([obj[i-2].lat, obj[i-2].lon],{ icon: icon[j++] });
                                marker1.bindPopup(obj[i-2].name+" LA :"+obj[i-2].lat+" "+"LO :"+obj[i-2].lon+"<br />"
                                +time1.substr(0, 24)
                                             + "Rssi :" +obj[i-2].rssi+" dBm" );
                                markerClusters.addLayer(marker1); 
                            }
                            
                            var trajet = new L.Polyline(pointsArray(villes));
                            carte.addLayer(trajet);
                        }
                      if ((obj.length%2)!=0){
                                var marker1 = L.marker([obj[0].lat, obj[0].lon],{ icon: icon[j] });
                                marker1.bindPopup(obj[0].name+" LA :"+obj[0].lat+" "+"LO :"+obj[0].lon+"<br />"
                                +time1.substr(0, 24)
                                             + "Rssi :" +obj[0].rssi+" dBm" );
                                markerClusters.addLayer(marker1); 
                      }
                       carte.addLayer(markerClusters);
                  
                      
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
            intervalId = setInterval(Map, 5000); 

        
        </script>
    </body>
</html>
