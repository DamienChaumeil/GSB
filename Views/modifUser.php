<?php
if (!isset($_SESSION["droit"])) {
	$_SESSION["droit"] = null;
}
if ($_SESSION["droit"] != 3) {
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
	<script src='Action/modifCpt.js' defer></script>
</head>

<body class="consultation-body client">
	<a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
	<section class="center-container">

		<?php
		echo '
	<h2>Choisir un compte pour modifier son mot de passe</h2>
	<form id="modiForm" method="post" action="index.php?action=modifUser&user">
	<select name="id">';
		foreach ($rst as $rstline) :
			echo '
			<option value="' . $rstline["Id_user"] . '">' . $rstline["mail"] . '</option>';
		endforeach;
		echo '</select>
	<label>mot de passe</label>
	<input type="password" id="1" name="mdp" value="" required><br>
	<input type="submit" name="submit" value="valider"/>
	</form>';
		echo '<br><a href="index.php?action=init"><button type="button">retour</button></a>';

		?>
	</section>
</body>

</html>