<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] != 1) {
    header("location: index.php");
}

$etat = "addFiche";

$user = new User_cls(null,null,null,null,null,null);
$user->restore($_SESSION["user"]);

$co = new Connexion();
$connex = $co->connect();

$cDay = date("d");
$cMonth = date("m");
$cYear = date("Y");
if($cDay > 25){
	if($cMonth == 12){$cYear++ ; $cMonth = 01;} else{$cMonth++;}
}
$ficheDate = $cMonth."/".$cYear;

$userId = $user->getId();

//recuperation de la fiche si elle existe-----------------------------------------------------------------------------
$ficheOBJ = new fiche(null,null,$userId,$ficheDate);
$dao = new fiche_dao($ficheOBJ);
$ficheOBJ = $dao->retrieve();
//FIN creation de la fiche si elle n'existe pas déja-----------------------------------------------------------------
//recuperation des frais forfaitaires--------------------------------------------------------------------------------
$idFiche = $ficheOBJ->getIdFiche();
//creation des frais forfaitaires
$forfaitEtape = new fraisForfaitaires($idFiche, null, 1);
$fraisKilometrique = new fraisForfaitaires($idFiche, null, 2);
$nuiteeHotel = new fraisForfaitaires($idFiche, null, 3);
$repasRestaurant = new fraisForfaitaires($idFiche, null, 4);
//creation des obj dao
$forfaitEtape_dao = new fraisForfaitaires_dao($forfaitEtape);
$fraisKilometrique_dao = new fraisForfaitaires_dao($fraisKilometrique);
$nuiteeHotel_dao = new fraisForfaitaires_dao($nuiteeHotel);
$repasRestaurant_dao = new fraisForfaitaires_dao($repasRestaurant);
//remplissage des frais forfaitaires
$forfaitEtape = $forfaitEtape_dao->retrieve();
$fraisKilometrique = $fraisKilometrique_dao->retrieve();
$nuiteeHotel = $nuiteeHotel_dao->retrieve();
$repasRestaurant = $repasRestaurant_dao->retrieve();
//FIN recuperation des frais forfaitaires--------------------------------------------------------------------------------
//recuperation des frais hors-forfaits-----------------------------------------------------------------------------------
$fraisHF = new fraisHorsFofait($idFiche,null,null,null);
$fraisHF_dao = new fraisHorsFofait_dao($fraisHF);
//FIN recuperation des frais hors-forfaits-----------------------------------------------------------------------------------
//ajout des frais forfaitaires et hors forfaits--------------------------------------------------------------------------
if(isset($_GET["add"])){
    if($ficheOBJ->getIdFiche()==null){
        //création d'une fiche car inexistante pour ce mois-ci
        $dao->create();
        $ficheOBJ = $dao->retrieve();
        $idFiche = $ficheOBJ->getIdFiche();
        //maj des fraisForfaitaires en fonction de l'id fiche nouvellement récupéré
        $forfaitEtape->setIdFiche($idFiche);
        $fraisKilometrique->setIdFiche($idFiche);
        $nuiteeHotel->setIdFiche($idFiche);
        $repasRestaurant->setIdFiche($idFiche);
        $forfaitEtape_dao->setfraisForfaitaires($forfaitEtape);
        $fraisKilometrique_dao->setfraisForfaitaires($fraisKilometrique);
        $nuiteeHotel_dao->setfraisForfaitaires($nuiteeHotel);
        $repasRestaurant_dao->setfraisForfaitaires($repasRestaurant);
        //création en base des frais forfaitaires de la fiche
        $forfaitEtape_dao->create();
        $fraisKilometrique_dao->create();
        $nuiteeHotel_dao->create();
        $repasRestaurant_dao->create();
    }
    if($_GET["add"]=="f"){
        $fE = htmlspecialchars($_POST["ForfaitEtape"]);
        $fK = htmlspecialchars($_POST["FraisKilometrique"]);
        $nH = htmlspecialchars($_POST["NuiteeHotel"]);
        $rR = htmlspecialchars($_POST["RepasRestaurant"]);
        //mise a jour des frais forfaitaires        
        $forfaitEtape->setQuantiteMensuelle($fE);
        $fraisKilometrique->setQuantiteMensuelle($fK);
        $nuiteeHotel->setQuantiteMensuelle($nH);
        $repasRestaurant->setQuantiteMensuelle($rR);
        //envoie à la base des frais forfaitaires
        $forfaitEtape_dao->setfraisForfaitaires($forfaitEtape);
        $fraisKilometrique_dao->setfraisForfaitaires($fraisKilometrique);
        $nuiteeHotel_dao->setfraisForfaitaires($nuiteeHotel);
        $repasRestaurant_dao->setfraisForfaitaires($repasRestaurant);

        $forfaitEtape_dao->update();
        $fraisKilometrique_dao->update();
        $nuiteeHotel_dao->update();
        $repasRestaurant_dao->update();
    }
    if($_GET["add"]=="hf"){
        $libelle = htmlspecialchars($_POST["libelle"]);
        $montant = htmlspecialchars($_POST["montant"]);
        $dateHF = htmlspecialchars($_POST["dateHF"]);
        $fraisHF->setLibelle($libelle);
        $fraisHF->setMontant($montant);
        $fraisHF->setDateFraisHF($dateHF);
        $fraisHF_dao->setFraisHF($fraisHF);
        $fraisHF_dao->create();
    }
}
//FIN ajout des frais forfaitaires et hors forfaits--------------------------------------------------------------------------
if(isset($_GET["suppr"])){
    if($_GET["suppr"]=="hf"){
        $libelle = htmlspecialchars($_GET["libelle"]);
        $dateHF = htmlspecialchars($_GET["dateHF"]);
        $fraisHF->setLibelle($libelle);
        $fraisHF->setIdFiche($idFiche);
        $fraisHF->setDateFraisHF($dateHF);
        $fraisHF_dao->setFraisHF($fraisHF);
        $fraisHF_dao->delete();
    }
    if($_GET["suppr"]=="fiche"){
        $req = 'DELETE FROM fiche_frais WHERE id_fiche=:idFiche';
        $stmt = $connex->prepare($req);
        $stmt->bindParam(':idFiche', $idFiche);
        $stmt->execute();
    }
}
$listFraisHF = $fraisHF_dao->findAll();
?>