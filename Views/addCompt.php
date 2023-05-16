<?php
if (!isset($_SESSION["droit"])) {
	$_SESSION["droit"] = null;
}
if ($_SESSION["droit"] == null) {
	header("location: index.php");
}
?>
<!DOCTYPE HTML PUBLIC >
<html>
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GSB</title>
  <link rel="stylesheet" href="Views/Tarif.css">
  <script src='Action/addCpt.js' defer></script>
</head>


<body class="consultation-body client">
  <a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
  <section class="center-container">


<h2>ajouter un Comptable</h2>
<form id="addForm" method="post" action="index.php?action=addCompt&add">
	<?php
	echo '
    <label>nom du visiteur</label>
	<input type="text" id="1" name="nom" value="" required><br>
    <label>prenom du visiteur</label>
	<input type="text" id="2" name="prenom" value="" required><br>
    <label>mail du visiteur</label>
	<input type="text" id="3" name="mail" value="" required><br>
	<label>mot de passe attribué au comptable</label>
	<input type="password" id="4" name="mdp" value="" required><br>'
    ?>
	<input type="submit" name="submit" value="Enregistrer"/>
</form>
<a href='index.php?action=init'><button type='button'>Retour</button></a>

</section>
</body>

</html>