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
  <link rel="stylesheet" href="Views/Tarif.css">
  <script src='Action/addFRegExp.js' defer></script>
</head>

<body class="consultation-body client">
  <a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
  <section class="center-container">

    <?php
    echo "<h1> Fiche de frais du mois de " . $ficheDate . "</h1>";
    ?>
    <h2>Eléments forfaitisés</h2>
    <form id="ff" method="post" action="index.php?action=addFiche&add=f">
      <?php
      
      echo '
      <div>
	<label>Forfait Etape</label>
	<input type="number" id="1" name="ForfaitEtape" value="' . $forfaitEtape->getQuantiteMensuelle() . '">€</div>
  <div>
    <label>Frais Kilométrique</label>
	<input type="number" id="2" name="FraisKilometrique" value="' . $fraisKilometrique->getQuantiteMensuelle() . '">km</div>
  <div>
    <label>Nombre de nuitée Hôtel</label>
	<input type="number" id="3" name="NuiteeHotel" value="' . $nuiteeHotel->getQuantiteMensuelle() . '"></div>
  <div>
    <label>Nombre de repas Restaurant</label>
	<input type="number" id="4" name="RepasRestaurant" value="' . $repasRestaurant->getQuantiteMensuelle() . '"></div>
	<input type="submit" name="submit" value="Enregistrer"/>
	<a href="index.php?action=addFiche&suppr=fiche" class="delete"><button type="button" name="delete" >Supprimer la fiche</button></a>'
        ?>
    </form>

    frais hors-forfaits saisis:
    <table>
      <tr>
        <th>libellé</th>
        <th>montant</th>
        <th>date</th>
      </tr>
      <?php
      foreach ($listFraisHF as $line):
        echo '
	<tr>
    <td>' . $line["libelle"] . '</td>
    <td>' . $line["montant"] . '</td>
    <td>' . $line["date_frais_hf"] . '</td>
	<td><a href="index.php?action=addFiche&suppr=hf&libelle=' . $line["libelle"] . '&dateHF=' . $line["date_frais_hf"] . '">supprimer</a></td>
  	</tr>';
      endforeach;
      ?>
    </table>

    <h2>Eléments non-forfaitisés</h2>
    <form id="hf" method="post" action="index.php?action=addFiche&add=hf">
    <div>  
    <label>Libellé</label>
      <input type="text" id="5" name="libelle" value="" required></div>
      <div>
      <label>Montant en €</label>
      <input type="number" id="6" name="montant" required></div>
      <div>
      <label>Date(jj/mm/YYYY)</label>
      <input type="text" id="7" name="dateHF" value="" required></div>
      <input type="submit" name="submit" value="Enregistrer" />
    </form>

    <a href='index.php?action=init'><button type='button'>Retour</button></a>

  </section>
</body>

</html>