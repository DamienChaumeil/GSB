<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] == null) {
    header("location: index.php");
}

$etat = "consFiche";

$user = new User_cls(null,null,null,null,null,null);
$user->restore($_SESSION["user"]);

$co = new Connexion();
$connex = $co->connect();

$userId = $user->getId();

//consultation utilisateur________________________________________________________________________________________________________
if ($_SESSION["droit"] == 1) {
    if(isset($_GET["cons"])){
        $ficheDate = $_POST["ficheConsulte"];
        if($ficheDate == null){header("location: index.php?action=init");}
        //recuperation de la fiche si elle existe-----------------------------------------------------------------------------
        $ficheOBJ = new fiche(null,null,$userId,$ficheDate);
        $dao = new fiche_dao($ficheOBJ);
        $ficheOBJ = $dao->retrieve();
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
        $listFraisHF = $fraisHF_dao->findAll();
        //FIN recuperation des frais hors-forfaits-----------------------------------------------------------------------------------
    }else{
        $req = 'SELECT ff.id_fiche, s.libelle_statut, ff.DateFiche FROM fiche_frais AS ff NATURAL JOIN statut AS s WHERE Id_user = :Id_user';
        $stmt = $connex->prepare($req);
        $stmt->bindParam(':Id_user', $userId);
        $stmt->execute();
        $rst = $stmt->fetchAll();
    }
}
//consultation comptable________________________________________________________________________________________________________
if ($_SESSION["droit"] == 2){
    if(isset($_GET["cons"])){
        $resPost = $_POST["ficheConsulte"];
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
    }if(isset($_GET["visit"])){
        $visitId = $_POST["ficheConsulte"];
        $req = 'SELECT ff.id_fiche, s.libelle_statut, ff.DateFiche FROM fiche_frais AS ff NATURAL JOIN statut AS s WHERE Id_user = :Id_user';
        $stmt = $connex->prepare($req);
        $stmt->bindParam(':Id_user', $visitId);
        $stmt->execute();
        $rst = $stmt->fetchAll();
    }else{
        $reqBis = 'SELECT COUNT(*) FROM fiche_frais NATURAL JOIN users WHERE users.id_droit = 1 GROUP BY Id_user ORDER BY users.Nom';
        $stmtBis = $connex->prepare($reqBis);
        $stmtBis->execute();
        $rstBis = $stmtBis->fetchAll();
        $req = 'SELECT DISTINCT u.Id_User, u.Nom, u.Prenom, u.mail FROM users AS u LEFT JOIN fiche_frais AS ff ON ff.Id_User=u.Id_User WHERE id_droit = 1 ORDER BY u.Nom';
        $stmt = $connex->prepare($req);
        $stmt->execute();
        $rst = $stmt->fetchAll();
        
        $nbFiches = array();
        $cli = array();
        foreach($rstBis as $ligne):
            array_push( $nbFiches, array("nb"=>$ligne["COUNT(*)"]));
        endforeach;
        foreach($rst as $ligne):
            array_push( $cli, array("Nom"=>$ligne["Nom"], "Prenom"=>$ligne["Prenom"], "mail"=>$ligne["mail"], "Id_User"=>$ligne["Id_User"] ));
        endforeach;
    }
}
?>