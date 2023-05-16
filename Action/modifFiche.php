<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] != 2) {
    header("location: index.php");
}

$etat = "modifFiche";

$user = new User_cls(null,null,null,null,null,null);
$user->restore($_SESSION["user"]);

$co = new Connexion();
$connex = $co->connect();

$userId = $user->getId();

if(isset($_GET["fiche"])){
    $resPost = $_POST["ficheAModif"];
    $resPost = explode ("-", $resPost);
    $ficheDate = $resPost[0];
    $visitId = $resPost[1];
    if($ficheDate == null || $visitId == null){header("location: index.php?action=init");}
    //recuperation de la fiche si elle existe-----------------------------------------------------------------------------
    $ficheOBJ = new fiche(null,null,$visitId,$ficheDate);
    $dao = new fiche_dao($ficheOBJ);
    $ficheOBJ = $dao->retrieve();
    //recuperation des frais forfaitaires--------------------------------------------------------------------------------
    $idFiche = $ficheOBJ->getIdFiche();
    //creation des frais forfaitaires------------------------------------------------------------------------------------
    $forfaitEtape = new fraisForfaitaires($idFiche, null, 1);
    $fraisKilometrique = new fraisForfaitaires($idFiche, null, 2);
    $nuiteeHotel = new fraisForfaitaires($idFiche, null, 3);
    $repasRestaurant = new fraisForfaitaires($idFiche, null, 4);
    //creation des obj dao-----------------------------------------------------------------------------------------------
    $forfaitEtape_dao = new fraisForfaitaires_dao($forfaitEtape);
    $fraisKilometrique_dao = new fraisForfaitaires_dao($fraisKilometrique);
    $nuiteeHotel_dao = new fraisForfaitaires_dao($nuiteeHotel);
    $repasRestaurant_dao = new fraisForfaitaires_dao($repasRestaurant);
    //remplissage des frais forfaitaires---------------------------------------------------------------------------------
    $forfaitEtape = $forfaitEtape_dao->retrieve();
    $fraisKilometrique = $fraisKilometrique_dao->retrieve();
    $nuiteeHotel = $nuiteeHotel_dao->retrieve();
    $repasRestaurant = $repasRestaurant_dao->retrieve();
    //FIN recuperation des frais forfaitaires--------------------------------------------------------------------------------
    //recuperation des frais hors-forfaits-----------------------------------------------------------------------------------
    $fraisHF = new fraisHorsFofait($idFiche,null,null,null);
    $fraisHF_dao = new fraisHorsFofait_dao($fraisHF);
    $listFraisHF = $fraisHF_dao->findAll();
    //FIN recuperation des frais hors-forfaits-----------------------------------------------------------------------------------
}if(isset($_GET["modif"])){
    $resPost = $_POST["ficheAModif"];
    $resPost = explode ("-", $resPost);
    $ficheId = $resPost[0];
    $statutId = $resPost[1];
    $req = 'UPDATE fiche_frais SET id_statut=:id_statut WHERE id_fiche=:id_fiche';
    $stmt = $connex->prepare($req);
    $stmt->bindParam(':id_fiche', $ficheId);
    $stmt->bindParam(':id_statut', $statutId);
    $stmt->execute();
    header("location: index.php?action=modifFiche");
}else{
    $req = 'SELECT DISTINCT u.Id_User, u.Nom, ff.DateFiche, ff.Id_statut, s.libelle_statut FROM users AS u NATURAL JOIN fiche_frais AS ff NATURAL JOIN statut AS s WHERE ff.Id_statut <= 2 ORDER BY ff.dateFiche, u.nom';
    $stmt = $connex->prepare($req);
    $stmt->execute();
    $rst = $stmt->fetchAll();
}