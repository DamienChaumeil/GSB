<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
}
if ($_SESSION["droit"] != 3) {
    header("location: index.php");
}

$etat="addVisit";

if(isset($_GET["add"]))
{
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];

//création de l'utilisateur
$hashMDP=password_hash( $mdp, PASSWORD_DEFAULT);
$userOBJ = new User_cls(null,$nom,$prenom,$mail,$hashMDP,1);
$dao = new User_dao($userOBJ);
$dao->create();
}
?>