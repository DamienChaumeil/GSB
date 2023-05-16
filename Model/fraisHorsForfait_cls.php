<?php
	class fraisHorsFofait
	{
	//Attributs
		private $idFiche;
		private $libelle;
		private $montant;
		private $dateFraisHorsForfait;
	//Constructeurs
		function __construct($idFiche,$libelle,$montant,$dateFraisHorsForfait)
		{
			$this->idFiche= $idFiche;
			$this->libelle= $libelle;
			$this->montant= $montant;
			$this->dateFraisHorsForfait= $dateFraisHorsForfait;
		}
	//Assesseurs
		 function setIdFiche($idFiche)
		{
			$this->idFiche=$idFiche;
		}
		 function setLibelle($libelle)
		{
			$this->libelle=$libelle;
		}
		function setMontant($montant)
		{
			$this->montant=$montant;
		}
		 function setDateFraisHF($dateFraisHorsForfait)
		{
			$this->dateFraisHorsForfait=$dateFraisHorsForfait;
		}
		 function getIdFiche()
		{
			return $this->idFiche;
		}
		 function getLibelle()
		{
			return $this->libelle;
		}
		function getMontant()
		{
			return $this->montant;
		}
		 function getdateFraisHF()
		{
			return $this->dateFraisHorsForfait;
		}
	}
?>