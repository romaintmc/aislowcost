<?php

//Login data storage TTN
$jsonurl = "https://api.pipedream.com/v1/sources/dc_EYueqk/event_summaries?expand=event"; //Link to json file.
$key = array("Authorization: Bearer ed9f8f5737998027296d8333424a0380"); //Authorization key from TheThingsNetwork

//Make an array of your devices 
//$deviceID = array('tbeam');

//Fetch Payload data
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $jsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $key); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
curl_close($ch);
//echo $result;
$array = json_decode($result, true);
//echo var_dump($array);
function write_db($bdd,$data,$time,$i){
    $req = $bdd->prepare('INSERT INTO gps(DEVICE,LAT, LON, ALT,time,FRE,RSSI) VALUES(:DEVICE,:LAT, :LON, :ALT,:time,:FRE,:RSSI)');
    $req->execute(array(
    'DEVICE' => $data[$i]['dev_id'],
	'LAT' => $data[$i]['latitude'],
	'LON' => $data[$i]['longitude'],
    'ALT' =>$data[$i]['altitude'],
    'time'=>  $time,
    'FRE' =>$data[$i]['frequency'],
    'RSSI' =>$data[$i]['rssi']
	));
}
function update_db($bdd,$data,$i){
    $ID =$data[$i]['ID'];
    $DEVICE =$data[$i]['dev_id'];
    $LAT=$data[$i]['latitude'];
    $LON=$data[$i]['longitude'];
    $ALT=$data[$i]['altitude'];
    $time=$data[$i]['time'];
    $FRE=$data[$i]['frequency'];
    $RSSI=$data[$i]['rssi'];
    $req = $bdd->prepare('UPDATE gps SET DEVICE =:DEVICE,LAT =:LAT,LON =:LON,ALT =:ALT,time =:time,FRE =:FRE,RSSI =:RSSI WHERE ID = :ID');
    $req->execute(array(
    'ID' => $ID,
    'DEVICE' =>$DEVICE,
    'LAT' =>$LAT,
     'LON' =>$LON,
     'ALT' =>$LON,
     'time' =>$time,
      'FRE' =>$FRE,
       'RSSI' =>$RSSI
	));
} 

$nombre= sizeof ($array['data']);
//echo $nombre;
//echo var_dump ($array['data']);
for ($i=0;$i<$nombre;$i++)
{   //echo $i;
    if ($array['data'][$i]['event']['method']=='POST'){
    $info[$i] =($array['data'][$i]['event']['bodyRaw']);
    }
}
for ($i=0;$i<$nombre;$i++){
$info[$i] =json_decode($info[$i], true);
}
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query('SELECT time FROM gps ORDER BY ID DESC LIMIT 1');
$donnees =$reponse->fetch();

if (empty($donnees))
{   
    for ($i=$nombre-1;$i>=0;$i--){
         //echo $i;
            if (array_key_exists('frequency', $info[$i]['metadata'])){
        $data[$i]=array('dev_id'=>$info[$i]['dev_id'],'frequency'=>$info[$i]['metadata']['frequency'],'rssi'=>$info[$i]['metadata']                ['gateways'][0]['rssi'],'latitude'=>$info[$i]['payload_fields']['latititude'],'longitude'=>$info[$i]['payload_fields']['longitude'],'altitude'=>$info[$i]['payload_fields']['altitude']);
        }
     
    else {
        $data[$i]=array('dev_id'=>$info[$i]['dev_id'],'latitude'=>$info[$i]['payload_fields']['latititude'],'longitude'=>$info[$i]                  ['payload_fields']['longitude'],'altitude'=>$info[$i]['payload_fields']['altitude']);
    } 
    write_db($bdd,$data,$array['data'][$i]['indexed_at_ms'],$i);
    }
}
else 
    {    
       
        $reponse = $bdd->query('SELECT ID,DEVICE,LAT,LON,time,FRE,RSSI  FROM gps ORDER BY ID DESC');
        while ($donnees = $reponse->fetch())
            {
                $gps[] = array("ID"=>$donnees['ID'],"device"=>$donnees['DEVICE'], "lat"=>$donnees['LAT'],"lon"=>$donnees['LON'],                       "time"=>$donnees['time'],"frequency"=>$donnees['FRE'], "rssi"=>$donnees['RSSI']);  
                                                    
        }
       
        $i=0;
        

        //echo var_dump($gps);
        while ($array['data'][$i]['indexed_at_ms']!=$gps[$i]['time']){
        //echo ($i);
            if (array_key_exists('frequency', $info[$i]['metadata'])){
            $data[$i]=array("ID"=>$gps[$i]['ID'],'dev_id'=>$info[$i]['dev_id'],'frequency'=>$info[$i]['metadata']['frequency'],'rssi'=>$info[$i]['metadata']                ['gateways'][0]['rssi'],'latitude'=>$info[$i]['payload_fields']['latititude'],'longitude'=>$info[$i]['payload_fields']                    ['longitude'],'altitude'=>$info[$i]['payload_fields']['altitude'],'time'=>$array['data'][$i]['indexed_at_ms']);
        }
     
        else {
                $data[$i]=array("ID"=>$gps[$i]['ID'],'dev_id'=>$info[$i]['dev_id'],'latitude'=>$info[$i]['payload_fields']['latititude'],'longitude'=>$info[$i]['payload_fields']                      ['longitude'],'altitude'=>$info[$i]['payload_fields']['altitude'],'time'=>$array['data'][$i]['indexed_at_ms']);
            }
        update_db($bdd,$data,$i);
        $i++;
        if ($i==$nombre-1) break ;
        }
     //echo var_dump($data);
     if (($i==$nombre) or ($i==0)) 
     {
         $data =null;
     }
    }
$reponse = $bdd->query('SELECT ID,DEVICE,NAME,BOAT_NUMBER,BOAT_TYPE FROM fishers');
while ($donnees = $reponse->fetch())
    {
        $fisher[] = array("id"=>$donnees['ID'], "device"=>$donnees['DEVICE'],"name"=>$donnees['NAME'], "boat_number"=>$donnees['BOAT_NUMBER'],"boat_type"=>$donnees['BOAT_TYPE']);               
    }


if ($data!=null){
    
    $k=0;
    for($i = 0; $i < sizeof($fisher);$i++)
    
    {
                for($j = 0; $j < sizeof($data);$j++){
                 if ($fisher[$i]['device']==$data[$j]['dev_id']){
                        $json[$k] = array("color" =>$fisher[$i]['id'], "name"=>$fisher[$i]['name'],"lat"=>$gps[$j]['lat'], "lon"=>$gps[$j]['lon'],"time"=>$data[$j]['time'],"frequency"=>$data[$j]['frequency'],
                        "rssi"=>$data[$j]  ['rssi']);
                        $k++;
                    }  
            } 
        }
//echo var_dump($json);
$k=sizeof($json);
$j=1;
        $actual[0]=array( "name"=>$json[0]['name'],"lat"=>$json[0]['lat'], "lon"=>$json[0]['lon'],"time"=>$json[0]['time'],"frequency"=>$json[0]['frequency'],
                        "rssi"=>$json[0] ['rssi'],"color"=>$json[0]['color']);
    for ($i=0;$i<$k-1 ;$i++){
    if ($json[$i]['name']!=$json[$i+1]['name']){
            $actual[$j]=array( "name"=>$json[$i+1]['name'],"lat"=>$json[$i+1]['lat'], "lon"=>$json[$i+1]['lon'],"time"=>$json[$i+1]['time'],"frequency"=>$json[$i+1]['frequency'],
                        "rssi"=>$json[$i+1] ['rssi'],"color"=>$json[$i+1]['color']);
            $j++;
      }
    }

    //echo var_dump($actual);

echo json_encode($actual);
}
else {
   echo json_encode(array("name"=>0));
}
?>