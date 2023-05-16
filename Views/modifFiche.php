<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] != 2) {
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

<body class="consultation-body client">
    <a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
    <section class="center-container">
        <?php
        if (isset($_GET["fiche"])) {
            echo '<h1> Fiche de frais du mois de ' . $ficheDate . '</h1>
        <h2>Eléments forfaitisés</h2>
        <label>Forfait Etape</label>
        <label>' . $forfaitEtape->getQuantiteMensuelle() . ' €</label><br><br>
        <label>Frais Kilométrique</label>
        <label>' . $fraisKilometrique->getQuantiteMensuelle() . ' km</label><br><br>
        <label>Nombre de nuitée Hôtel</label>
        <label>' . $nuiteeHotel->getQuantiteMensuelle() . ' </label><br><br>
        <label>Nombre de repas Restaurant</label>
        <label>' . $repasRestaurant->getQuantiteMensuelle() . ' </label><br><br>

        <h2>frais hors-forfaits :</h2>
        <table>
        <tr>
            <th>libellé</th>
            <th>montant</th>
            <th>date</th>
        </tr>';
            //affichage des frais hf------------------------------------------------------------------------------------------
            foreach ($listFraisHF as $line) :
                echo '
        <tr>
            <td>' . $line["libelle"] . '</td>
            <td>' . $line["montant"] . '</td>
            <td>' . $line["date_frais_hf"] . '</td>
        </tr>';
            endforeach;
            //FIN affichage des frais hf------------------------------------------------------------------------------------------
            echo '
        </table>
        <h2>Mettre à jour le statut de la fiche</h2>
        <form method="post" action="index.php?action=modifFiche&modif">
        <select name="ficheAModif">';
            if ($ficheOBJ->getIdStatut() == 1) {
                echo '
        <option value="' . $ficheOBJ->getIdFiche() . '-2">Validée</option>
        <option value="' . $ficheOBJ->getIdFiche() . '-3">Refusée</option>';
            }
            if ($ficheOBJ->getIdStatut() == 2) {
                echo '
        <option value="' . $ficheOBJ->getIdFiche() . '-4">Remboursée</option>
        <option value="' . $ficheOBJ->getIdFiche() . '-3">Refusée</option>';
            }
            echo '</select>
        <input type="submit" name="submit" value="Enregistrer"/>

        <br><br><br><a href="index.php?action=modifFiche"><button type="button">Retour</button></a>';
        } else {
            //choix fiche-------------------------------------------------------------------------------------------------------------
            echo '
        <h2>Choisir une fiche à traiter</h2>
        <form method="post" action="index.php?action=modifFiche&fiche">
        <select name="ficheAModif">';
            foreach ($rst as $rstline) :
                echo '
                <option value="' . $rstline["DateFiche"] . '-' . $rstline["Id_User"] . '">fiche du ' . $rstline["DateFiche"] . ' de ' . $rstline["Nom"] . ' - ' . $rstline["libelle_statut"] . '</option>';
            endforeach;
            echo '</select>
        <input type="submit" name="submit" value="valider"/>
        </form>';
            echo '<br><a href="index.php?action=init"><button type="button">Retour</button></a>';
        }
        ?>

    </section>
</body>

</html>