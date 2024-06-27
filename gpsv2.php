<?php


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=ttn_gps;charset=utf8', 'root', '');
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

        
        $reponse = $bdd->query('SELECT ID,DEVICE,LAT,LON,time,FRE,RSSI  FROM gps ORDER BY ID DESC');
        while ($donnees = $reponse->fetch())
            {
                $data[] = array("ID"=>$donnees['ID'],"device"=>$donnees['DEVICE'], "lat"=>$donnees['LAT'],"lon"=>$donnees['LON'],                       "time"=>$donnees['time'],"frequency"=>$donnees['FRE'], "rssi"=>$donnees['RSSI']);  
                                                    
        }
    
        
//echo var_dump($data);

$reponse = $bdd->query('SELECT ID,DEVICE,NAME,BOAT_NUMBER,BOAT_TYPE FROM fishers');
while ($donnees = $reponse->fetch())
    {
        $fisher[] = array( "id"=>$donnees['ID'],"device"=>$donnees['DEVICE'],"name"=>$donnees['NAME'], "boat_number"=>$donnees['BOAT_NUMBER'],"boat_type"=>$donnees['BOAT_TYPE']);               
    }

//echo var_dump($fisher);  
    $k=0;
    for($i = 0; $i < sizeof($fisher);$i++)
    
    {          
                for($j = 0; $j < sizeof($data);$j++){
                 if ($fisher[$i]['device']==$data[$j]['device']){
                        $json[$k] = array("color" =>$fisher[$i]['id'],"name"=>$fisher[$i]['name'],"lat"=>$data[$j]['lat'], "lon"=>$data[$j]['lon'],"time"=>$data[$j]['time'],"frequency"=>$data[$j]['frequency'],
                        "rssi"=>$data[$j]  ['rssi']);
                        $k++;
                    }  
            } 
        }
//echo var_dump($json);
$k=sizeof($json);
$j=1;
    $actual[0]=array( "name"=>$json[0]['name'],"lat"=>$json[0]['lat'], "lon"=>$json[0]['lon'],"time"=>$json[0]['time'],"frequency"=>$json[0]['frequency'],"rssi"=>$json[0] ['rssi'],"color"=>$json[0]['color'] );
    for ($i=0;$i<$k-1 ;$i++){
    if ($json[$i]['name']!=$json[$i+1]['name']){
            $actual[$j]=array( "name"=>$json[$i+1]['name'],"lat"=>$json[$i+1]['lat'], "lon"=>$json[$i+1]['lon'],"time"=>$json[$i+1]['time'],"frequency"=>$json[$i+1]['frequency'],
                        "rssi"=>$json[$i+1] ['rssi'],"color"=>$json[$i+1]['color']);
            $j++;
      }
    }
    //echo var_dump($actual);
//echo var_dump($actual);
echo json_encode($actual);

?>