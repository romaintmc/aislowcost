<?php


     
   //  Script d'envoi de textos depuis un compte SFR
     
    // Envoi possible si le message ne dépasse pas 3 * 160 caractères (3 textos)
     
     
     

   



Define('AUTHENTIFICATION', 'http://www.sfr.fr/communiquer/messagerie/sfr-messagerie/authentification/');
Define('COOKIE_FILE','cookie.txt');						//Fichier COOKIE
Define('EMPTY_FILE',"emptyfile.txt");					//DOIT être un fichier vide
Define('USER_AGENT','Mozilla/5.0');						//User-agent
Define('LOGIN','thong.vo@cegetel.net');							//Login de votre compte SFR (Votre numéro)
Define('PASSWORD','thqv76IY');								//Password de votre compte SFR

$cible = "0601889469";
$message = "coucou";

if(send_sms($cible,$message)) echo("Texto envoyé !");
else echo("Impossible de trouver le token ou message trop long. Message non transmis. Mauvais logins ?");



     
    // Fonction d'envoi de sms
     
     
     
    // @param int $cible Numéro de téléphone du destinataire
     
   //  @param int $message Message pour le destinataire. Supporte les accents. Jusqu'à 480 caractères.
     
    // @return int 1 si succès 0 en cas d'échec.
     


function send_sms($cible,$message)
{
	//Encodage d
	$message = utf8_decode($message);
	
	$ch = curl_init();
	
	// set url
	curl_setopt($ch, CURLOPT_URL, AUTHENTIFICATION);
	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
	curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// $output contains the output string
	$output = curl_exec($ch);
	
	curl_close($ch);
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.sfr.fr/cas/login?service=https://www.sfr.fr/j_spring_cas_security_check");
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"target=&_eventId=&currentPage=&username=".LOGIN."&password=".PASSWORD);
	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$ret = curl_exec($ch);
	
	curl_setopt($ch, CURLOPT_URL, "http://www.sfr.fr/web-messagerie/mc/envoyer-texto-mms/index.do");

	
	$ret = curl_exec($ch);
	
	if ($ret === FALSE) {
	    die(curl_errno($ch));
	}
	
	preg_match("!\"CSRFToken\" value=\"([0-9]*)!",$ret,$out);
	
	if(!isset($out[1]))
	{
		return 0;
	}
	
	$token = $out[1];
	
	$array = Array(
	"CSRFToken" => $token,
	"idMessage" => '',
	"submitMethod" => 'web',
	"todo" => '',
	"boxId" => 'sent',
	'galleryItem' => '-1',
	'msisdns' => $cible,
	'emails' => '',
	'emoticones' => ':)',
	'message' => $message,
	'file' => '@'.realpath(EMPTY_FILE)
	);
	
	curl_setopt($ch, CURLOPT_URL, "http://www.sfr.fr/web-messagerie/mc/envoyer-texto-mms/submit.do");
	curl_setopt($ch, CURLOPT_COOKIEJAR, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_COOKIEFILE, realpath(COOKIE_FILE));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$array);
	$ret = curl_exec($ch);

	preg_match("!\"CSRFToken\" value=\"([0-9]*)!",$ret,$out);
	$token = $out[1];
	
	//Confirmation
	$array = Array(
	"CSRFToken" => $token,
	"idMessage" => '',
	"submitMethod" => 'web',
	"todo" => '',
	"boxId" => 'sent',
	'emoticones' => ':)',
	'mms' => 'false',
	'message' => $message
	);
	
	curl_setopt($ch, CURLOPT_URL, "http://www.sfr.fr/web-messagerie/mc/envoyer-texto-mms/confirm.do");
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$array);
	$ret = curl_exec($ch);
	
	curl_close($ch);

	if(strpos($ret,"Le Texto a été expédié avec succès&nbsp;!") === false) return 0;
	else return 1;
		
	return 1;
}
?>