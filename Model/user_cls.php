<?php
	class User_cls
	{
			
		//Attributs

			private $idUser;
			private $nom;
			private $prenom;
			private $mail;
			private $mdp;
			private $droit;

		//Constructeurs

			function __construct($idUser,$nom,$prenom,$mail,$mdp,$droit)
			{
				$this->idUser= $idUser;
				$this->nom= $nom;
				$this->prenom= $prenom;
				$this->mail= $mail;
				$this->mdp= $mdp;
				$this->droit= $droit;
			}

		//Assesseurs

			function setId($idUser)
			{
				$this->idUser=$idUser;
			}
			function setNom($nom)
			{
				$this->nom=$nom;
			}
			function setPrenom($prenom)
			{
				$this->prenom=$prenom;
			}
			function setMail($mail)
			{
				$this->mail=$mail;
			}
			function setMdp($mdp)
			{
				$this->mdp=$mdp;
			}
			function setDroit($droit)
			{
				$this->droit=$droit;
			}
			function getId()
			{
				return $this->idUser;
			}
			function getNom()
			{
				return $this->nom;
			}
			function getPrenom()
			{
				return $this->prenom;
			}
			function getMail()
			{
				return $this->mail;
			}
			function getMdp()
			{
				return $this->mdp;
			}
			function getDroit()
			{
				return $this->droit;
			}

		//méthodes

		function verifyUser($connexionVar){
			$stmt=$connexionVar->prepare(" SELECT * FROM `users` WHERE mail =:mail");
			$stmt->bindParam(':mail', $this->mail);
			$stmt->execute(); 
			$donnee=$stmt->fetch();
			if ($donnee==null){ $authent=false; return $authent;}//si compte inexistant
			else{
				if(password_verify($this->mdp, $donnee["mdp"])){//si mdp correspond
					$this->idUser=$donnee["Id_user"];
					$this->nom=$donnee["Nom"];
					$this->prenom=$donnee["Prenom"];
					$this->droit=$donnee["id_droit"];
					$this->mdp=$donnee["mdp"];
					$authent=true; return $authent;
				}
				else{
					$authent=false; return $authent;//si mdp correspond pas
				}
			}
		}

		function convertToJson(){
			$jsonUser = array( 
				"mail" => $this->mail,
				"idUser" => $this->idUser,
				"droit" => $this->droit,
				"nom" => $this->nom,
				"prenom" => $this->prenom
				);
			return json_encode($jsonUser);
		}

		function restore($jsonUser){
			$tab[] = json_decode($jsonUser, true);
			$this->mail=$tab[0]["mail"];
			$this->idUser=$tab[0]["idUser"];
			$this->droit=$tab[0]["droit"];
			$this->nom=$tab[0]["nom"];
			$this->prenom=$tab[0]["prenom"];
		}
			
	}
?>
