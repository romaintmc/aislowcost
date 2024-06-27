<?php  
session_start(); 

function write_db($bdd,$username,$password_1,$name,$email,$phone){
            $password = md5($password_1);//encrypt the password before saving in the database
            $req=$bdd->prepare('INSERT INTO users(user,password,name,email,phone) VALUES(:user,:password,:name,:email,:phone)');
            $req->execute(array(
            'user'=>$username,
            'password'=>$password,
            'name'=>$name, 
            'email'=>$email,
            'phone'=>$phone   
            ));
    $_SESSION['success'] = "you are now registered in";
    header('location:inscription_admin.php');
}


// connect to the database
try
{
	$bdd = new mysqli("localhost","root","","test");
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
  $name = $bdd->real_escape_string($_POST['name']);
  echo $name;
  $phone = $bdd->real_escape_string($_POST['phone']);
  echo $phone;
  $email = $bdd->real_escape_string($_POST['email']);
  echo $email;
  $username = $bdd->real_escape_string($_POST['username']);
   echo $username; 
  $password_1 =  $bdd-> real_escape_string($_POST['pass']) ;
   echo $password_1;
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
    try
        {
	       $bdd =  new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', ''); 
    //$bdd = new PDO('mysql:host=mysql-eae.alwaysdata.net;dbname=eae_ais;charset=utf8', 'eae', 'josana210698');
        }
    catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
            $reponse = $bdd->query('SELECT user FROM users');
     while ($donnees = $reponse->fetch())
        {
            $user[]=$donnees['user'];
        } 
    
    if (!empty($user)){ 

            if(in_array($username,$user)){
                $_SESSION['errors']="Username already exists";
                header('location:inscription_admin.php');
                $_POST['username']="";
            }
            else {
                write_db($bdd,$username,$password_1,$name,$email,$phone);
            }
    }
    else {
            write_db($bdd,$username,$password_1,$name,$email,$phone);
      }  
  // Finally, register user if there are no errors in the form
    
	
}
    
  
?>

