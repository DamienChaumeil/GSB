<?php

$co = new Connexion();
$connex = $co->connect();

//recup post

$login = htmlspecialchars($_POST["login"]);
$mdp = htmlspecialchars($_POST["mdp"]);

//vérification

// verif non nullité des infos rentrées
if($login==null || $mdp==null){ /*header("location:loginCli.php" );*/ $etat = "erreurAuth";}// AMENE A CHANGER LA REDIRECT LOCATION
$utilisateur = new User_cls(null,null,null,$login,$mdp,null);
if($utilisateur->verifyUser($connex) == true){
    $_SESSION["droit"] = $utilisateur->getDroit();
    $user_dao = new User_dao($utilisateur);
    $utilisateur = $user_dao->retrieve($connex);
    $_SESSION["user"] = $utilisateur->convertToJson();
    $etat = "acceuil";
    //header("location:presentation.php");
}
else{
    //header("location:loginCli.php");
    $etat = "erreurAuth";
}

?>