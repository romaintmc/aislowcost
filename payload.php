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
$info =($array['data'][0]['event']['bodyRaw']);
$time =$array['data'][0]['indexed_at_ms'];
$info =json_decode($info, true);
if (array_key_exists('frequency', $info['metadata']))
    {$data=array('dev_id'=>$info['dev_id'],'frequency'=>$info['metadata']['frequency'],'rssi'=>$info['metadata']['gateways'][0]['rssi'],
                 'latitude'=>$info['payload_fields']['latititude'],'longitude'=>$info['payload_fields']['longitude'],
                 'altitude'=>$info['payload_fields']['altitude']);}
     
else {$data=array('dev_id'=>$info['dev_id'],'latitude'=>$info['payload_fields']['latititude'],'longitude'=>$info['payload_fields']['longitude'],
'altitude'=>$info['payload_fields']['altitude']);}
//echo   var_dump($data);

function write_db($bdd,$data,$time){
    $req = $bdd->prepare('INSERT INTO gps(DEVICE,LAT, LON, ALT,time,FRE,RSSI) VALUES(:DEVICE,:LAT, :LON, :ALT,:time,:FRE,:RSSI)');
    $req->execute(array(
    'DEVICE' => $data['dev_id'],
	'LAT' => $data['latitude'],
	'LON' => $data['longitude'],
    'ALT' =>$data['altitude'],
    'time'=>  $time,
    'FRE' =>$data['frequency'],
    'RSSI' =>$data['rssi']
	));
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
$old_time = $donnees['time'];
if ($time!=$old_time){
    if(($data['latitude']!=0)&&($data['longitude']!=0)){
            write_db($bdd,$data,$time);
            $req = $bdd->exec('DELETE FROM gps ORDER BY ID ASC LIMIT 1');  
    }
}


$reponse = $bdd->query('SELECT LAT,LON,time,FRE,RSSI  FROM gps ORDER BY ID DESC LIMIT 2');

while ($donnees = $reponse->fetch())
{
    $gps[] = array( "lat"=>$donnees['LAT'], "lon"=>$donnees['LON'],"time"=>$donnees['time'],"frequency"=>$donnees['FRE'],
                  "rssi"=>$donnees['RSSI']);
                   
}
$gps =json_encode($gps);
echo $gps;

?>