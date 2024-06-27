<?php
/*Si on des variables dans le POST on affiche et on s'arrête pour éviter les requêtes en boucle*/
if(count($_POST) > 0)
{
	print_r($_POST);
	exit();
}
/*Initialisation de la ressource curl*/
$c = curl_init();
/*L'url est celle de la page courante pour que le script s'appel lui même*/
curl_setopt($c, CURLOPT_URL, 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
/*On indique à curl de nous retourner le contenu de la requête plutôt que de l'afficher*/
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
/*On indique à curl de ne pas retourner les headers http de la réponse dans la chaine de retour*/
curl_setopt($c, CURLOPT_HEADER, false);
/*On indique à curl d'envoyer une requete post*/
curl_setopt($c, CURLOPT_POST,true);
/*On donne les paramêtre de la requete post*/
curl_setopt($c, CURLOPT_POSTFIELDS,array('param0'=>'value0','param1'=>'value1'));
/*On execute la requete*/
$output = curl_exec($c);
/*On a une erreur alors on la leve*/
if($output === false)
{
	trigger_error('Erreur curl : '.curl_error($c),E_USER_WARNING);
}
/*Si tout c'est bien passé on affiche le contenu de la requête*/
else
{
	var_dump($output);
}
/*On ferme la ressource*/
curl_close($c);
?>