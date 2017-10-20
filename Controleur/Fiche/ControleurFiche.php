<?php 
class ControleurFiche extends Controleur {
	private $modeleFiche;
	function __construct(){
		$this->modeleFiche = $this->chargerModele("ModeleFiche");
	}
	public function index(){

	}
	public function insertFiche(){
		$libelle = $this->post("libelle");
		$description = $this->post("description");
		$categories = $this->post("categories");
		$this->modeleFiche->insertFiche(array("libelle_fiche"=>$libelle,"description"=>$description));
		$this->modeleFiche->insertFicheCategorie($categories);
	}

	public function updateFiche(){
		$id = $this->post('id_fiche');
		$libelle = $this->post("libelle_fiche");
		$description = $this->post("description");
		$categories = $this->post("categories");
		$this->modeleFiche->updateFiche(array("id_fiche"=>$id,"libelle_fiche"=>$libelle,"description"=>$description));
		$this->modeleFiche->insertFicheCategorie($categories,$id);
	}
	public function deleteFiche(){
		$id= $this->post('id_fiche');
		$this->modeleFiche->deleteFiche($id);
	}
	public function getFicheCategories(){
		$id = $this->post('id_fiche');
		$resultat = $this->modeleFiche->getFicheCategories($id);
		echo json_encode($resultat); 
	}
}
?>