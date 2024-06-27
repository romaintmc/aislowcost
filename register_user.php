<?php  
session_start(); 

try
{
	$bdd = new mysqli("localhost","root","","ginf1");
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

//echo var_dump($_POST);
// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username = $bdd->real_escape_string($_POST['name']);
 // echo $username;
  $phone = $bdd->real_escape_string($_POST['phone']);
 // echo $phone;
  $email = $bdd->real_escape_string($_POST['email']);
 // echo $email;
  $age = $bdd->real_escape_string($_POST['age']);
  //echo $age;
  $gender = $bdd->real_escape_string($_POST['gender']);
    $boat_number = $bdd->real_escape_string($_POST['boat_number']);
    $boat_type = $bdd->real_escape_string($_POST['boat_type']);


  // a user does not already exist with the same username and/or email
        try
        {
	      $bdd =  new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', ''); 
     // $bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
        }
        catch(Exception $e)
       {
            die('Erreur : '.$e->getMessage());
        }
$reponse = $bdd->query('SELECT * FROM fishers ORDER BY ID DESC LIMIT 1');
$donnees = $reponse->fetch();
if (empty($donnees['ID'])){
    $donnees['ID'] =0;  
}
 //echo var_dump($donnees) ; 
$req = $bdd->prepare('INSERT INTO fishers(DEVICE,NAME,PHONE,EMAIL,AGE,GENDER,BOAT_NUMBER,BOAT_TYPE) VALUES(:DEVICE,:NAME,:PHONE, :EMAIL, :AGE,:GENDER,:BOAT_NUMBER,:BOAT_TYPE)');
$req->execute(array(
    'DEVICE'=>"tbeam".ceil($donnees['ID']+1) ,
    'NAME' => $username,
	'PHONE' => $phone,
	'EMAIL' => $email,
    'AGE' =>$age,
    'GENDER'=> $gender,
    'BOAT_NUMBER' =>$boat_number,
    'BOAT_TYPE' =>$boat_type
	));
    $_SESSION['success'] = "you are now registered in";
    header('location:inscription.php');	

}
?>

