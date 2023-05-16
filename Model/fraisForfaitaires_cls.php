<?php
	class fraisForfaitaires
	{
	//Attributs
		private $idFiche;
		private $quantiteMensuelle;
		private $id;
	//Constructeurs
		function __construct($idFiche,$quantiteMensuelle,$id)
		{
			$this->idFiche= $idFiche;
			$this->quantiteMensuelle= $quantiteMensuelle;
			$this->id= $id;
		}
	//Assesseurs
		 function setidFiche($idFiche)
		{
			$this->idFiche=$idFiche;
		}
		 function setQuantiteMensuelle($quantiteMensuelle)
		{
			$this->quantiteMensuelle=$quantiteMensuelle;
		}
		 function setId($id)
		{
			$this->id=$id;
		}
		 function getIdFiche()
		{
			return $this->idFiche;
		}
		 function getQuantiteMensuelle()
		{
			return $this->quantiteMensuelle;
		}
		 function getId()
		{
			return $this->id;
		}
	}
?>
