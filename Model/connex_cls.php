<?php
	class Connexion
	{

	//Attributs
		private $connex;
		
	//Constructeur
		function __construct(){}

	//Méthodes	
		function connect(){
			try
			{
				$connexion = new PDO("mysql:host=127.0.0.1;dbname=gsb1","root","");
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
				die('Erreur : '.$e->getMessage());
			}
			$this->connex = $connexion;
			return $this->connex;
		}
	}
?>
