<?php  session_start(); 

?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <title>AIS LOW COST</title>
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

 <div id="wrapper">
          
             <div class="panel">
                <h2>Login Admin</h2><br>
                <p>Please fill in the registration form</p>
            </div>
     <form action="setting.php" method="POST" id="login">

             <input type="text" class="form-group" id="inputEmail" name="username" placeholder="Username"><br>
             <input type="password" class="form-group" id="inputPassword" name="password" placeholder="Password"><br>
 
     
     
        <button class="favorite styled"style="width: 200px;font-size: 1rem" name="login"type="submit">LOGIN</button>
        </form>

  
    <?php
    if (isset($_SESSION['errors']) AND $_SESSION['errors']=="Wrong username/password combination")
    {
    // On affiche les codes
        $_SESSION['errors']="";
    ?>
        <div class="panel" id ="info">
            <p>Wrong username/password combination</p>
        </div>
        <script language='javascript'>
 
            temp=document.getElementById('info');
            setTimeout('temp.style.display="none"',2000);
 
     </script>
        <?php
    }
    ?>
    <?php
    if (($_SESSION['errors']=="Username/Password is required"))// Si le mot de passe est bon
    {
    // On affiche les codes
        $_SESSION['errors']="";
    ?>
        <div class="panel" id ="info1">
            <p>Username/Password is required</p>
        </div>
        <script language='javascript'>
 
            temp=document.getElementById('info1');
            setTimeout('temp.style.display="none"',2000);
 
     </script>
        <?php
    }
    ?>
</div>
</body>
</html>