<?php

	class fraisHorsFofait_dao
	{
		
	//Attributs
		private $fraisHorsForfait;


	//Constructeurs
		function __construct($fraisHorsForfait)
		{
			$this->fraisHorsFofait= $fraisHorsForfait;
		}
	//Assesseurs
		 function setFraisHF($fraisHorsForfait)
		{
			$this->fraisHorsFofait=$fraisHorsForfait;
		}
		 
		 function getFraisHF()
		{
			return $this->fraisHorsFofait;
		}

		//CRUD
		 function create()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = "INSERT INTO frais_Hors_Forfait (`id_fiche`, `libelle`, `date_frais_hf`, `montant`) VALUES (:idFiche ,:libelle ,:dateFraisHF ,:montant )";
			$stmt = $conn->prepare($req);
            $idFiche = $this->fraisHorsFofait->getIdFiche();
			$libelle = $this->fraisHorsFofait->getLibelle();
			$montant = $this->fraisHorsFofait->getMontant();
			$dateHF = $this->fraisHorsFofait->getDateFraisHF();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':montant', $montant);
			$stmt->bindParam(':dateFraisHF', $dateHF);
			$stmt->execute() ;
		}
		
		 function retrieve()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = "SELECT * FROM frais_Hors_Forfait WHERE id_fiche=:idFiche AND libelle=:libelle";
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisHorsFofait->getIdFiche();
			$libelle = $this->fraisHorsFofait->getLibelle();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':libelle', $libelle);
			$stmt->execute();
			$rst = $stmt->fetchall();
			foreach($rst as $line):
				$this->fraisHorsFofait->setIdFiche($line['idFiche']);
				$this->fraisHorsFofait->setLibelle($line['libelle']);
				$this->fraisHorsFofait->setDateFraisHF($line['date_Frais_HF']);
				$this->fraisHorsFofait->setMontant($line['montant']);
			endforeach;
		}

		 function update()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'UPDATE frais_Hors_Forfait SET libelle=:libelle, montant=:montant, date_frais_hf=:dateFraisHF WHERE id_fiche=:idFiche';
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisHorsFofait->getIdFiche();
			$libelle = $this->fraisHorsFofait->getLibelle();
			$montant = $this->fraisHorsFofait->getMontant();
			$dateHF = $this->fraisHorsFofait->getDateFraisHF();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':montant', $montant);
			$stmt->bindParam(':dateFraisHF', $dateHF);
			$stmt->execute();
		}
		
		function delete()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'DELETE FROM frais_Hors_Forfait WHERE id_fiche=:idFiche AND libelle=:libelle AND date_frais_hf=:dateHF';
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisHorsFofait->getIdFiche();
			$libelle = $this->fraisHorsFofait->getLibelle();
			$dateHF = $this->fraisHorsFofait->getDateFraisHF();
			$stmt->bindParam(':idFiche', $idFiche);
            $stmt->bindParam(':libelle', $libelle);
			$stmt->bindParam(':dateHF', $dateHF);
			$stmt->execute();
		}

		function findAll(){
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'SELECT * FROM frais_Hors_Forfait WHERE id_fiche=:idFiche';
			$stmt = $conn->prepare($req);
			$idFiche = $this->fraisHorsFofait->getIdFiche();
			$stmt->bindParam(':idFiche', $idFiche);
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			return $resultat;
		}
	}
?>