<?php


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$reponse = $bdd->query('SELECT LAT,LON,time,FRE,RSSI  FROM gps ORDER BY ID DESC');

while ($donnees = $reponse->fetch())
{
    $gps[] = array( "lat"=>$donnees['LAT'], "lon"=>$donnees['LON'],"time"=>$donnees['time'],"frequency"=>$donnees['FRE'],
                  "rssi"=>$donnees['RSSI']);
                   
}
$gps =json_encode($gps);
echo $gps;

?>