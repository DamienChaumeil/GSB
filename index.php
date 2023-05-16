<?php


require ("Model/user_cls.php");
require ("Model/user_dao.php");
require ("Model/connex_cls.php");
require ("Model/fiche_cls.php");
require ("Model/fiche_dao.php");
require ("Model/statut_dao.php");
require ("Model/fraisForfaitaires_cls.php");
require ("Model/fraisForfaitaires_dao.php");
require ("Model/fraisHorsForfait_cls.php");
require ("Model/fraisHorsForfait_dao.php");

session_start();

if(isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    $action = "init";
}
$scriptAction = "Action/".$action.".php";
Include ($scriptAction);

$scriptVue = "Views/".$etat.".php";
Include ($scriptVue);
?>