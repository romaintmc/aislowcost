
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
                height: 88vh;
            }
        </style>
    </head>
   
    <body>

        <ul id="menu_horizontal">

            <li class="bouton_gauche"><a href="accueil.php">Home</a></li>
            <li class="bouton_gauche"><a href="connexion.php"onclick="window.open(this.href);return false">Register User</a></li>
<li class="bouton_gauche"><a href="inscription_admin.php"onclick="window.open(this.href);return false">Register Admin</a></li>
<li class="bouton_droite"><a href="historical.php"onclick="window.open(this.href);return false">historical</a></li>
<li class="bouton_droite"><a href="connexion1.php"onclick="window.open(this.href);return false">Setting</a></li>
<li class="bouton_droite"><a href="logo"><img src="vn.png"></a></li>
</ul>
        
        <div id="maCarte"></div>
   <div class="text">
   <footer >
      <p >created by Vo Claude © . All rights reserved.</p>
    </footer>
   </div>
        <!-- Fichiers Javascript -->
        <script type="text/javascript" src="calcul_cap.js"></script>  
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
       var myIcon4 = L.icon({
			iconUrl:  "homme_a_la_mer_violet.png",
			iconSize: [20, 20],
			iconAnchor: [20, 20],
			popupAnchor: [-3, -15],
		});
        
        </script>
        

        <script>
            //var carte = null;
            var icon=[myIcon1,myIcon,myIcon2,myIcon3,myIcon4,myIcon2,myIcon3,myIcon,myIcon2,myIcon3];
            var color=["red","white","green","yellow","purple","0AAA","FF00","AA00","0AAA"];
            var lat=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            var lon=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            var lat1=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            var lon1=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            var villes =null;
            var Nombre_device=0;
             var carte = L.map('maCarte').setView([48.383, -4.500 ], 5);
             
             
            // On charge les "tuiles"
                 L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(carte);
             var Nombre =0;


            function Map() {
               var markerClusters;
               markerClusters = new L.markerClusterGroup();
                
               $.ajax({
                
               type: "GET",
               url: "gps.php",
               success: function(data){
                        var obj= JSON.parse(data);
                       var j =0;
                      if (obj.name!=0){
                        Nombre_device=obj.length;
                        for (var i=0;i<obj.length;i++){
                                var d1 = new  Date(parseInt(obj[i].time,10));
                                var time2= d1.toString();
                                var Dis= distance(obj[i].lat, obj[i].lon, 10.42, 107.3, "N");

                                if ((Nombre%2)==0){
                                    var marker1 = L.marker([obj[i].lat, obj[i].lon],{ icon: icon[obj[i].color] });
                                    lat[i]=obj[i].lat;
                                    lon[i]=obj[i].lon;
                                    markerClusters.addLayer(marker1);
                                marker1.bindPopup(obj[i].name+" LA :"+obj[i].lat+" "+"LO :"+obj[i].lon+"<br />"
                                +time2.substr(0, 24)
                                  +"D: " + i + "Rssi :" +obj[i].rssi+" dBm" );
                                }
                                else{
                                    var marker1 = L.marker([obj[i].lat, obj[i].lon],{ icon: obj[i].color});
                                    markerClusters.addLayer(marker1); 
                                marker1.bindPopup(obj[i].name+" LA :"+obj[i].lat+" "+"LO :"+obj[i].lon+"<br />"
                                +time2.substr(0, 24)
                                  +"D: " + i + "Rssi :" +obj[i].rssi+" dBm" );
                                    markerClusters.addLayer(marker1); 
                                    var marker2 = L.marker([lat[i], lon[i]]);
                                     markerClusters.addLayer(marker2);  
                                marker2.bindPopup(obj[i].name+" LA :"+obj[i].lat+" "+"LO :"+obj[i].lon+"<br />"
                                +time2.substr(0, 24)
                                  +"D: " + i + "Rssi :" +obj[i].rssi+" dBm" );
                                    lat1[i]=obj[i].lat;
                                    lon1[i]=obj[i].lon;
                                }
                        if(Nombre>0){if ((lat[i]!=0) && (lat[i]!=0)&& (lat1[i]!=0)&& (lon1[i]!=0)){
                            villes = [
	                               ["marker1", lat[i], lon[i]],
	                               ["marker2", lat1[i], lon1[i]]
                                ];
                                var trajet = new L.Polyline(pointsArray(villes),{color: color[obj[i].color]});
                                carte.addLayer(trajet);
                            }
                          }
                                      
                        }
                           Nombre++;
                           
                      }
                   else {      for (var i=0;i<Nombre_device;i++){
                               if ((Nombre%2)==0){
                                var marker1 = L.marker([lat1[i], lon1[i]],{ icon: myIcon1 });
                               }
                                else{
                                  var marker1 = L.marker([lat[i], lon[i]],{ icon: myIcon1 });  
                                }
                                 markerClusters.addLayer(marker1);
                        }
                   }
                   
                   
                       carte.addLayer(markerClusters);
                    var latlng1 = L.latLng(obj[0].lat, obj[0].lon);
                      carte.setView (latlng1,19);
                     //var latlng2 = L.latLng(obj[obj.length-1].lat, obj[obj.length-1].lon);
                    //var arrayOfLatLngs = [latlng1, latlng2];
                    //var bounds = new L.LatLngBounds(arrayOfLatLngs);
                   // carte.fitBounds(bounds); 
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
            intervalId = setInterval(Map, 32000); 

        
        </script>
    </body>
</html>
