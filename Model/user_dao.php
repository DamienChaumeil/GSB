<?php

	class User_dao
	{
		
	//Attributs
		private $user;


	//Constructeurs
		function __construct($user)
		{
			$this->user= $user;
		}
	//Assesseurs
		 function setUser($user)
		{
			$this->user=$user;
		}
		 
		 function getUser()
		{
			return $this->user;
		}

		//CRUD
		 function create()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'INSERT INTO `users`(`Nom`, `Prenom`, `mail`, `mdp`, `id_droit`) VALUES (:nom ,:prenom ,:mail ,:mdp ,:droit )';
			$stmt = $conn->prepare($req);
			$mail = $this->user->getMail();
			$mdp = $this->user->getMdp();
			$nom = $this->user->getNom();
			$prenom = $this->user->getPrenom();
			$droit = $this->user->getDroit();
			$stmt->bindParam(':nom', $nom);
			$stmt->bindParam(':prenom', $prenom);
			$stmt->bindParam(':mail', $mail);
			$stmt->bindParam(':mdp', $mdp);
			$stmt->bindParam(':droit', $droit);
			$stmt->execute() ;
		}
		
		 function retrieve()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = "SELECT * FROM users WHERE mail=:mail AND mdp=:mdp";
			$stmt = $conn->prepare($req);
			$mail = $this->user->getMail();
			$mdp = $this->user->getMdp();
			$stmt->bindParam(':mail', $mail);
			$stmt->bindParam(':mdp', $mdp);
			$stmt->execute();
			$rst = $stmt->fetchall();
			foreach($rst as $line):
				$this->user->setId($line['Id_user']);
				$this->user->setNom($line['Nom']);
				$this->user->setPrenom($line['Prenom']);
				$this->user->setDroit($line['id_droit']);
			endforeach;
			return $this->user;

		}

		 function update()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'UPDATE users SET mdp=:mdp WHERE Id_user=:IdUser ';
			$stmt = $conn->prepare($req);
			$mdp = $this->user->getMdp();
			$idUser = $this->user->getId();
			$stmt->bindParam(':mdp', $mdp);
			$stmt->bindParam(':IdUser', $idUser);
			$stmt->execute();
		}
		
		function delete()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'DELETE FROM users WHERE Id_user=:IdUser';
			$stmt = $conn->prepare($req);
			$idUser = $this->user->getId();
			$stmt->bindParam(':id', $idUser());
			$stmt->execute() ;
		}

		function findAll(){
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'SELECT * FROM users';
			$stmt = $conn->prepare($req);
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			return $resultat;
		}
	}
?>
