<?php
	class Fiche
	{
	//Attributs
		private $idFiche;
		private $idStatut;
		private $idUser;
		private $dateFiche;

	//Constructeurs
		function __construct($idFiche,$idStatut,$idUser,$dateFiche)
		{
			$this->idFiche= $idFiche;
			$this->idStatut= $idStatut;
			$this->idUser= $idUser;
			$this->dateFiche= $dateFiche;
		}
	//Assesseurs
		 function setIdFiche($idFiche)
		{
			$this->idFiche=$idFiche;
		}
		 function setIdStatut($idStatut)
		{
			$this->idStatut=$idStatut;
		}
		 function setIdUser($idUser)
		{
			$this->idUser=$idUser;
		}
		function setDateFiche($dateFiche)
		{
			$this->dateFiche=$dateFiche;
		}
		 function getIdFiche()
		{
			return $this->idFiche;
		}
		 function getIdStatut()
		{
			return $this->idStatut;
		}
		 function getIdUser()
		{
			return $this->idUser;
		}
		function getDateFiche()
		{
			return $this->dateFiche;
		}
	}
?>
