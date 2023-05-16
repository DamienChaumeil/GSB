<?php

	class fraisForfaitaires_dao
	{
		
	//Attributs
		private $fraisForfaitaires;


	//Constructeurs
		function __construct($fraisForfaitaires)
		{
			$this->fraisForfaitaires= $fraisForfaitaires;
		}
	//Assesseurs
		 function setfraisForfaitaires($fraisForfaitaires)
		{
			$this->fraisForfaitaires=$fraisForfaitaires;
		}
		 
		 function getfraisForfaitaires()
		{
			return $this->fraisForfaitaires;
		}

		//CRUD
		 function create()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'INSERT INTO frais_forfaitaire (`id_fiche`, `id`) VALUES (:idfiche ,:id )';
			$stmt = $conn->prepare($req);
            $idFiche = $this->fraisForfaitaires->getidFiche();
			$id = $this->fraisForfaitaires->getId();
			$stmt->bindParam(':idfiche', $idFiche);
            $stmt->bindParam(':id', $id);
			$stmt->execute();
		}

		 function retrieve()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = "SELECT * FROM frais_forfaitaire WHERE id_Fiche=:idFiche AND id=:id";
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisForfaitaires->getidFiche();
			$id = $this->fraisForfaitaires->getId();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':id', $id);
			$stmt->execute();
			$rst = $stmt->fetchall();
			foreach($rst as $line):
				$this->fraisForfaitaires->setQuantiteMensuelle($line['quantite_mensuelle']);
			endforeach;
			return $this->fraisForfaitaires;
		}

		 function update()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'UPDATE frais_forfaitaire SET quantite_mensuelle=:quantiteMensuelle WHERE id_fiche=:idFiche AND id=:id';
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisForfaitaires->getidFiche();
			$id = $this->fraisForfaitaires->getId();
			$quantitee = $this->fraisForfaitaires->getQuantiteMensuelle();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':quantiteMensuelle', $quantitee);
            $stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		
		function delete()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'DELETE FROM frais_forfaitaire WHERE id_Fiche=:idFiche';
			$stmt = $conn->prepare($req);
			$stmt->bindParam(':idFiche', $this->fraisForfaitaires->getIdFiche());
			$stmt->execute() ;
		}
	}
?>