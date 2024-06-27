
<?php
$jsonurl = "https://integrations.thethingsnetwork.org/ttn-eu/api/v2/down/geo_ais/ais_lowcost?key=ttn-account-v2.Cf2bOlThA249yQC67dug6bxOms2-OjMMkCNoS1326Uw"; //Link to json file.

$curl = curl_init();

$params = [
    "id_dev"=>"tbeam1",
    "payload_raw" => "AQE="
    
];

$params_string = http_build_query($params);
echo ($params_string);
$opts = [
    CURLOPT_URL =>$jsonurl,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params_string,
    CURLOPT_RETURNTRANSFER => true,
];

curl_setopt_array($curl, $opts);

$response = json_decode(curl_exec($curl), true);

echo var_dump($response);
<?
