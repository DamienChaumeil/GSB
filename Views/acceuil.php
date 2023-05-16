<?php
if (!isset($_SESSION["droit"])) {
  $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] == null) {
  header("location: index.php");
}
?>

<!DOCTYPE HTML PUBLIC>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GSB</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="Views/Tarif.css">
  <script src='Action/nav.js' defer></script>
</head>

<body>

  <div id="page">
    <!-- div page ____________________________________________________________________________________ !-->
    <div id="corpus">
      <!-- div corpus-------------------------------------------------------------------------------- !-->
      <div id="container">
        <!-- div container-------------------------------------------------------------------------------- !-->
          <a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
        <?php
        $user = new User_cls(null, null, null, null, null, null);
        $user->restore($_SESSION["user"]);
        echo "<h1 class='main-title'>Bienvenue " . $user->getNom() . " " . $user->getPrenom() . "</h1>";
        ?>

        <div class="button-container">

          <?php
          if ($_SESSION["droit"] == 1) {
          ?>
            <a href='index.php?action=addFiche'><button type='button'>reseigner une fiche</button></a>
            <a href='index.php?action=consFiche'><button type='button'>consulter mes fiches</button></a>
          <?php
          }
          if ($_SESSION["droit"] == 2) {
          ?>
            <a href='index.php?action=consFiche'><button type='button'>Consulter une fichez</button></a>
            <a href='index.php?action=modifFiche'><button type='button'>Mettre à jour une fiche</button></a>
          <?php
          }
          if ($_SESSION["droit"] == 3) {
          ?>
            <a href='index.php?action=addVisit'><button type='button'>ajouter un visiteur</button><a>
                <a href='index.php?action=addCompt'><button type='button'>ajouter un comptable</button><a>
                    <a href='index.php?action=modifUser'><button type='button'>modifier les informations d'un compte</button><a>
                      <?php
                    }

                      ?>

                      <a href='index.php?action=logout'><button type='button' id='deco'>déconnexion</button></a>

        </div>

        <?php

        ?>
      </div><!-- Fin div container-------------------------------------------------------------------------------- !-->
    </div><!-- Fin div corpus-------------------------------------------------------------------------------- !-->

  </div><!-- Fin div page ____________________________________________________________________________________ !-->
</body>

</html>