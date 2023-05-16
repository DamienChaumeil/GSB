<?php

	class statut_dao
	{

	//Constructeurs
		function __construct()
		{
		}

		//CRUD
		 function getAll()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'SELECT * FROM statut';
			$stmt = $conn->prepare($req);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
?>
