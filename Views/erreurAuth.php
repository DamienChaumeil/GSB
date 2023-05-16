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
  <link rel="stylesheet" href="Views/Tarif.css">
  <script src='Action/connValid.js' defer></script>
</head>

<body>

  <div id="page"><!-- div page ____________________________________________________________________________________ !-->

     <div id="corpus"><!-- div corpus-------------------------------------------------------------------------------- !-->
      <div id="container-error">
        </br>
            <p>Identifiant ou mot de passe incorrect</p>
            <a href='index.php?action=init' ><button type='button'>retour</button></a>
        </div>
      </div>

     </div><!-- Fin div corpus-------------------------------------------------------------------------------- !-->

    </div><!-- Fin div page ____________________________________________________________________________________ !-->
</body>

</html>