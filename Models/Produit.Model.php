﻿<?php
	/* Models : classe Produit */
	//Inclusion de Classe Mère
	require_once('Model.Model.php');
	class ProduitModel extends Model{
		//Les Attributs  : chaque attribut correspond a une colonne de la table produit.
		private $id;
		private $designation; 
		private $prixUnitaire;
		private $tva;
		private $quantite;
		private $idFamille;
		private $conn;
		
		public function __construct() 
		{
			$this->conn=self::connecter();
		}

		//Accesseurs et modificateurs des attributs privé (getters et setters)
		
		/*
			* @desc         retourne id de l'objet courant
			* @return   id 
		*/
		public function getId(){
			return $this->id;
		}
		
		/*
			* @desc         retourne designation de l'objet courant
			* @return   designation 
		*/
		public function getDesignation(){
			return $this->designation;
		}
		/*
			* @desc change la valeur de l'attribut designation aprés la validation
			* @param   str $value     valeur de l'attribut designation
		*/
		public function setDesignation($value){
			if(!empty($value))
				$this->designation = $value;
			else{
				global $ErrorAttribut;
				$ErrorAttribut[] = "designation";
			}
		}
		
		/*
			* @desc     retourne prixUnitaire de l'objet courant
			* @return    prixUnitaire 
		*/
		public function getPrixUnitaire(){
			return $this->prixUnitaire;
		}
		/*
			* @desc       change la valeur de l'attribut prixUnitaire apr�s la validation
			* @param   	str $value     valeur de l'attribut prixUnitaire
		*/
		public function setPrixUnitaire($value){
			if(is_numeric($value))
				$this->prixUnitaire = $value;
			else{
				global $ErrorAttribut;
				$ErrorAttribut[] = "prixUnitaire";
			}
		}
		
		/*
			* @desc     retourne tva de l'objet courant
			* @return    tva 
		*/
		public function getTva(){
				return $this->tva;
		}
		/*
			* @desc       change la valeur de l'attribut tva apr�s la validation
			* @param   	str $value     valeur de l'attribut tva
		*/
		public function setTva($value){
			if(is_numeric($value))
				$this->tva = $value;
			else{
				global $ErrorAttribut;
				$ErrorAttribut[] = "tva";
			}
		}
		
		/*
			* @desc     retourne quantite de l'objet courant
			* @return    quantite 
		*/
		public function getQuantite(){
				return $this->quantite;
		}
		/*
			* @desc       change la valeur de l'attribut quantite apr�s la validation
			* @param   	str $value     valeur de l'attribut quantite
		*/
		public function setQuantite($value){
			if(is_numeric($value))
				$this->quantite = $value;
			else{
				global $ErrorAttribut;
				$ErrorAttribut[] = "quantite";
			}
		}
		
		/*
			* @desc     retourne IdFamille de l'objet courant
			* @return    tva 
		*/
		public function getIdFamille(){
			return $this->idFamille;
		}
		/*
			* @desc       change la valeur de l'attribut IdFamille 
						"Nous n' avons pas besoin de validation puisque on va selecter la 
						famille de produit � partir d'une liste"
			* @param   	str $value     valeur de l'attribut IdFamille
		*/
		public function setIdFamille($value){
			$this->idFamille = $value;
		}
		
		//CRUD : Create   Red    Update  Delete
		
		//Ajouter
		public function addProduit(){
			$rqt = 'INSERT INTO produits (designation, prixUnitaire, tva, quantite, 
					idFamille) VALUES ("'.$this->designation.'", 
					'.$this->prixUnitaire.', '.$this->tva.', '.$this->quantite.'
					, '.$this->idFamille.')';
			mysqli_query($this->conn,$rqt);
		}
		//Modifier
		public function updateProduit($idProduit){
			$rqt = 'UPDATE produits SET designation = "'.$this->designation.'", 
					prixUnitaire = '.$this->prixUnitaire.', tva = '.$this->tva.', 
					quantite = '.$this->quantite.', 
					idFamille = '.$this->idFamille. ' WHERE id = '.$idProduit;
			mysqli_query($this->conn,$rqt);
		}
		//Supprimer
		public function deleteProduit($idProduit){
			$rqt = 'DELETE FROM produits WHERE id = '.$idProduit;
			mysqli_query($this->conn,$rqt);
		}
		//Lecture
		//	Liste des Produits
		public function listProduit(){
			$tab = array();
			$rqt = mysqli_query($this->conn,"SELECT * FROM produits");
			while($data = mysqli_fetch_assoc($rqt))
				$tab[] = $data;
			return $tab;
		}
		//Recherche
		public function findProduit($idProduit){
			$rqt = mysqli_query($this->conn,"SELECT * FROM produits WHERE id = ".$idProduit);
			$data = mysqli_fetch_assoc($rqt);
			if(count($data)>0){
				$this->id = $data['id'];
				$this->designation = $data['designation'];
				$this->prixUnitaire = $data['prixUnitaire'];
				$this->tva = $data['tva'];
				$this->quantite = $data['quantite'];
				$this->idFamille = $data['idFamille'];
			}
			return $this;
		}
	}
?>
		
		
		