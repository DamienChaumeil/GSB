<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
   }
if ($_SESSION["droit"] != 3) {
    header("location: index.php");
}

$etat="modifUser";

$userOBJ = new User_cls(null,null,null,null,null,null);
$dao = new User_dao($userOBJ);

if(isset($_GET["user"]))
{
    $mdp = $_POST["mdp"];
    $id = $_POST["id"];
    $mdp = password_hash($mdp , PASSWORD_DEFAULT);
    $userOBJ->setMdp($mdp);
    $userOBJ->setId($id);
    $dao->setUser($userOBJ);
    $dao->update();
    header("location: index.php?action=modifUser");
}else{   
    $rst = $dao->findAll();
}
?>