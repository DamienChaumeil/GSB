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

<body class="consultation-body client">
        <a href="index.php?action=init"><img src="./Views/image/logo.png" alt="lama"></a>
    <section class="center-container">
        <?php
        if ($_SESSION["droit"] == 1) {
            if (isset($_GET["cons"])) {
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
                foreach ($listFraisHF as $line) :
                    echo '
            <tr>
                <td>' . $line["libelle"] . '</td>
                <td>' . $line["montant"] . '</td>
                <td>' . $line["date_frais_hf"] . '</td>
            </tr>';
                endforeach;
                echo '
            </table>
            <br><a href="index.php?action=consFiche"><button type="button">Retour</button></a>';
            } else {
                echo '
            <h2>Choisir une fiche</h2>
            <form method="post" action="index.php?action=consFiche&cons=true">
            <select name="ficheConsulte">';
                foreach ($rst as $rstline) :
                    echo '
                
                    <option value="' . $rstline["DateFiche"] . '">fiche du ' . $rstline["DateFiche"] . ' - ' . $rstline["libelle_statut"] . '</option>';
                endforeach;
                echo '</select>
            <input type="submit" name="submit" value="valider"/>
            </form>';
                echo '<br><a href="index.php?action=init"><button type="button">Retour</button></a>';
            }
        }
        if ($_SESSION["droit"] == 2) {
            if (isset($_GET["cons"])) {
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
            <br><a href="index.php?action=consFiche"><button type="button">Retour</button></a>';
            }

            // VISITE

            if (isset($_GET["visit"])) {
                //choix fiche-------------------------------------------------------------------------------------------------------------
                echo '
            <h2>Choisir une fiche à consulter</h2>
            <form method="post" action="index.php?action=consFiche&cons">
            <select name="ficheConsulte">';
                foreach ($rst as $rstline) :
                    echo '
                    <option value="' . $rstline["DateFiche"] . '-' . $visitId . '">fiche du ' . $rstline["DateFiche"] . ' - ' . $rstline["libelle_statut"] . '</option>';
                endforeach;
                echo '</select>
            <input type="submit" name="submit" value="valider"/>
            </form>';
                echo '<br><a href="index.php?action=consFiche"><button type="button">Retour</button></a>';
            }

            // CONSULTATION

            if (!isset($_GET["cons"]) && !isset($_GET["visit"])) {
                //choix visiteur-------------------------------------------------------------------------------------------------------------
                echo '
            <h2>Choisir un client</h2>
            <form method="post" action="index.php?action=consFiche&visit">
            <select name="ficheConsulte">';
                $i = 0;
                foreach ($cli as $cliLine) :
                    echo '
                    <option value="' . $cliLine["Id_User"] . '">fiche de ' . strtoupper($cliLine["Nom"]) . ' ' . ucfirst($cliLine["Prenom"]) . ' fiches: ' . $nbFiches[$i]["nb"] . '</option>';
                    $i++;
                endforeach;
                echo '</select>
            <input type="submit" name="submit" value="valider"/>
            </form>';
                echo '<br><a href="index.php?action=init"><button type="button">Retour</button></a>';
            }
        }
        ?>
    </section>
</body>

</html>