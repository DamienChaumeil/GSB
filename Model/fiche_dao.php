<?php

	class fiche_dao
	{
		
	//Attributs
		private $fiche;

	//Constructeurs
		function __construct($fiche)
		{
			$this->fiche= $fiche;
		}
	//Assesseurs
		 function setfiche($fiche)
		{
			$this->fiche=$fiche;
		}
		 
		 function getfiche()
		{
			return $this->fiche;
		}

		//CRUD
		 function create()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'INSERT INTO fiche_frais (`Id_statut`, `Id_user`, `DateFiche`) VALUES (:idStatut ,:idUser ,:dateFiche )';
			$stmt = $conn->prepare($req);
			$idUser = $this->fiche->getIdUser();
			$dateFiche = $this->fiche->getDateFiche();
			$idStatut = 1;
			$stmt->bindParam(':idStatut', $idStatut);
            $stmt->bindParam(':idUser', $idUser);
			$stmt->bindParam(':dateFiche', $dateFiche);
			$stmt->execute() ;
		}
		
		 function retrieve()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = "SELECT * FROM fiche_frais WHERE id_User=:idUser AND dateFiche=:dateFiche";
			$stmt = $conn->prepare($req);
			$idUser = $this->fiche->getIdUser();
			$dateFiche = $this->fiche->getDateFiche();
			$stmt->bindParam(':idUser', $idUser);
			$stmt->bindParam(':dateFiche', $dateFiche);
			$stmt->execute();
			$rst = $stmt->fetchAll();
			foreach($rst as $line):
				$this->fiche->setIdStatut($line['Id_statut']);
				$this->fiche->setIdFiche($line['id_fiche']);
			endforeach;
			
			return $this->fiche;
		}

		 function update()
		{
			$connex = new Connexion();
			$conn = $connex->connect();
			$req = 'UPDATE fiche_frais SET id_User=:idUser, id_Statut=:idStatut, dateFiche=:dateFiche WHERE id_fiche=:idFiche';
			$stmt = $conn->prepare($req);
			$idUser = $this->fiche->getIdUser();
			$dateFiche = $this->fiche->getDateFiche();
			$idStatut = $this->fiche->getIdStatut();
			$idFiche = $this->fiche->getidFiche();
			$stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':idStatut', $idStatut);
            $stmt->bindParam(':dateFiche', $dateFiche);
			$stmt->bindParam(':idFiche', $idFiche);
			$stmt->execute();
		}

		function updateStatut()
	   {
		   $connex = new Connexion();
		   $conn = $connex->connect();
		   $req = 'UPDATE fiche_frais SET Id_statut=:idStatut WHERE id_fiche=:IdFiche';
		   $stmt = $conn->prepare($req);
		   $idStatut = $this->fiche->getIdStatut();
		   $idFiche = $this->fiche->getidFiche();
		   $stmt->bindParam(':idStatut', $idStatut);
		   $stmt->bindParam(':IdFiche', $idFiche);
		   $stmt->execute();
	   }
		
		function delete()
		{
			$connex = new Connexion();
			$conn=$connex->connect();
			$req = 'DELETE FROM fiche_frais WHERE Id_fiche=:Idfiche';
			$stmt = $conn->prepare($req);
			$idFiche = $this->fiche->getidFiche();
			$stmt->bindParam(':idFiche', $idFiche);
			$stmt->execute() ;
		}

		function findForUser($idUser, $useForfait  = true){
			$connex = new Connexion();
			$conn=$connex->connect();

			$columns = $useForfait
				? 'f.id_fiche,s.Id_statut, s.libelle_statut, f.Id_user, f.DateFiche, SUM(ff.quantite_mensuelle) as quantite_mensuelles, fh.montant, fh.date_frais_hf, fh.libelle'
				: 'f.id_fiche,s.Id_statut, s.libelle_statut, f.Id_user, f.DateFiche';

			$req = '
				SELECT Distinct ' . $columns . '
				from fiche_frais f join users u on f.Id_user = u.Id_user
				join statut s on s.Id_statut = f.Id_statut
				join frais_forfaitaire ff on ff.id_fiche = f.id_fiche
				join frais_hors_forfait fh on fh.id_fiche = f.id_fiche
				where u.Id_user= :Id_user';

			if($useForfait) {
				$req .= ' group by f.id_fiche, s.Id_statut, s.libelle_statut, f.Id_user, f.DateFiche, fh.montant, fh.date_frais_hf, fh.libelle;';
			}
			$stmt = $conn->prepare($req);
			$stmt->bindParam(':Id_user', $idUser);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
?>
