<?php 
$url ="https://integrations.thethingsnetwork.org/ttn-eu/api/v2/down/voclaude/test_downlink?key=ttn-account-v2.wc7twYyvP8SuoKmNUVt4TaGg3sMULTc75G43EraquDE";
$key=array("Authorization: Bearer ed9f8f5737998027296d8333424a0380");
$data = array(
    "dev_id"=>"gps",
    "confirmed"=> false,
    "port"=>1,
   //"payload_raw"=>"AQ=="
    "payload_fields"=>array('bouton activé'=>01)
        );
$data_json = json_encode($data);
echo ($data_json);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $key); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    // post_data
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
$response  = curl_exec($ch);
echo ("FIN");
echo var_dump($response);
echo ("FIN1");
curl_close($ch); 
echo ($response);
?>