<?php  session_start(); 

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
 <h2>Admin Inscription</h2>
    
<form action="register_admin.php" method="POST" id="register">
   <p><i>Complete the form. Fields marked with </i><em>*</em> are <em>required</em></p>
  <fieldset>
    <legend>Contact</legend>
      <label for="nom">Name and Lastname <em>*</em></label>
      <input id="nom"  autofocus="" name="name" required=""><br>
            <label for="telephone">Cellphone</label>
      <input id="telephone" type="tel" name="phone" pattern="[0-9]{10}"><br>
      <label for="email">Email </label>
      <input id="email" type="email" name="email"><br>
 </fieldset>
      <fieldset>
    <legend>Information Login</legend>
      <label for="username">Username <em>*</em></label>  
      <input type="text"  id="inputEmail" name="username" placeholder="Username"required=""><br>
       <label for="password" >Password <em>*</em></label> 
       <input type="password"  id="inputPassword" name="pass" placeholder="Password"required="">

  </fieldset>
     
       <button class="favorite styled" style="width: 150px;font-size: 0.8rem" type="submit" name="register">REGISTER</button>
          </form>

    <?php
    if (($_SESSION['success'] == "you are now registered in"))
    {
    ?>   <div class="panel" id ="info1">
            <p>Admin are now registered in</p>
        </div>
        
        <script language='javascript'>
         
            temp=document.getElementById('info1');
             setTimeout('temp.style.display="none"',5000);

 
       </script>
    <?php
        $_SESSION['success'] ="";
    }
    ?>
    
    <?php
    if (isset($_SESSION['errors']) AND $_SESSION['errors']=="Username already exists")
    {
    // On affiche les codes
        $_SESSION['errors']="";
    ?>
        <div class="panel" id ="info">
            <p>Username already exists</p>
        </div>
        <script language='javascript'>
 
            temp=document.getElementById('info');
            setTimeout('temp.style.display="none"',3000);
 
     </script>
        <?php
    }
    ?>

   
</body>
</html>