<?php
if (!isset($_SESSION["droit"])) {
 $_SESSION["droit"] = null;
}
?>

<!DOCTYPE HTML PUBLIC >
<html>
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GSB</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="./Views/image/logo.png">
  <link rel="stylesheet" href="Views/Tarif.css">
  <script src='Action/connValid.js' defer></script>
</head>

<body>
  <div id="page"><!-- div page ____________________________________________________________________________________ !-->

     <div id="corpus"><!-- div corpus-------------------------------------------------------------------------------- !-->

      <div id="container" >
	     <div id="txtT1">
       </br>
       <i class="bi bi-person-circle" id="logo-person"></i>
          </br></br>
          <form method="POST" id="form1" action="index.php?action=verifLogin">
          <input required placeholder='email' type='email' name='login' id='login' class="authent"></br>
          <span class='error' id='erreurLogin'>*format invalide ou caractères interdits: " ' ` < ></span>
          </br>
          <input required placeholder='mot de passe' type='password' name='mdp' id='mdp' class="authent"></br>
          <span class='error' id='erreurMdp'>*caractères interdits: " ' ` < ></span>
          </br>
          <input class='bouton-validation' type='submit' name='submit'  value='Connexion'/>
          </form>
        </div>
      </div>

     </div><!-- Fin div corpus-------------------------------------------------------------------------------- !-->

    </div><!-- Fin div page ____________________________________________________________________________________ !-->
</body>

</html>