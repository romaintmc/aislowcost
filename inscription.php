<?php  
session_start(); 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <title>AIS LOW COST</title>
        <link href='inscriptionn.css' rel='stylesheet' type='text/css' />
        <link href='style_old.css' rel='stylesheet' type='text/css' />
        <div id="hg">
            <div id="hd">
                <div id="contenu">
                    <h1>AIS LOWCOST</h1>
                </div> <!-- /contenu -->
            </div> <!-- /bd -->
        </div> <!-- /bg -->
    </head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<h2>Fisher Inscription</h2>
<form action="register_user.php" method="POST" id="register">
  <p><i>Complete the form. Fields marked with </i><em>*</em> are <em>required</em></p>
  <fieldset>
    <legend>Contact</legend>
      <label for="nom">Name and Lastname <em>*</em></label>
      <input id="nom"  autofocus="" name="name" required=""><br>
      <label for="telephone">Cellphone</label>
      <input id="telephone" type="tel" name="phone"pattern="[0-9]{10}"><br>
      <label for="email">Email </label>
      <input id="email" type="email" name="email"  ><br>
  </fieldset>
  <fieldset>
    <legend>Information personal</legend>
      <label for="age">Age</label>
      <input id="age" type="number"  pattern="[0-9]{2}" name="age" ><br>
      <label for="sexe">Gender</label>
      <select id="sexe" name="gender" >
        <option value="F" name="sexe">F</option>
        <option value="H" name="sexe">M</option>
      </select><br>
     <label for="Boat number">Boat number<em>*</em></label>
      <input id="Boat number" type="Boat number" name="boat_number"  required=""><br>
      <label for="Boat type">Boat Type</label>
      <select id="Boat type" name="boat_type">
        <option value="Panier" name="Boat type">Pannier</option>
        <option value="Little Boat" name="Boat type">Litte Boat</option>
        <option value="Midle Boat" name="Boat type">Midle Boat</option> 
      </select><br>
  </fieldset>
  <button class="favorite styled" style="width: 100px;font-size: 0.8rem" type="submit" name="register">REGISTER</button>
 
    </form>
    <?php
    if (($_SESSION['success'] == "you are now registered in"))// Si le mot de passe est bon
    {
    ?>   <div class="panel" id ="info">
            <p>Fisher are now registered in</p>
        </div>
        
        <script language='javascript'>
         
            temp=document.getElementById('info');
             setTimeout('temp.style.display="none"',5000);

 
       </script>
    <?php
        $_SESSION['success'] ="";
    }
    ?>
    

</body>
</html