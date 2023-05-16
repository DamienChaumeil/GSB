<?php
if (!isset($_SESSION["droit"])) {
    $_SESSION["droit"] = null;
   }
if ($_SESSION["droit"] != null) {
    $etat = "acceuil";
}else{
    $etat = "authentification";
}
?>