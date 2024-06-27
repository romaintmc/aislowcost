<?php  
session_start(); 

// initializing variables
$username = "";


// connect to the database
try
{
	$db = new mysqli("localhost","root","","ginf1");
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// LOGIN USER
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    echo $username ;
    echo $password;
    if ((empty($username))OR (empty($password))) {
        $_SESSION['errors']="Username/Password is required";
        header('location:connexion.php');
    }

   else {

       $password = md5($password);
       $query = "SELECT * FROM users WHERE user='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $data=mysqli_fetch_assoc($results);
          $_SESSION['id']=$data['ID'];
          $_SESSION['success'] = "You are now logged in";
          header('location: inscription.php');
          
        }else {
            $_SESSION['errors']= "Wrong username/password combination";
            header('location:connexion.php');

        }
    }
  }
  ?>
    




