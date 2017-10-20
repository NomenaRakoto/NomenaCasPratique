<?php 
class ControleurCategorie extends Controleur {
	private $modeleCategorie;
	function __construct(){
		$this->modeleCategorie = $this->chargerModele("ModeleCategorie");
	}
	public function index(){

	}
	public function addCategorie(){
		$id_pere = $this->post("idPere");
		$libelle = $this->post("libelle");
		$this->modeleCategorie->insertCategorie(array("libelle"=>$libelle,"id_pere"=>$id_pere));
	}
	public function updateCategorie(){
		$id = $this->post('id');
		$id_pere = $this->post("idPere");
		$libelle = $this->post("libelle");
		$this->modeleCategorie->updateCategorie(array("id"=>$id,"libelle"=>$libelle,"id_pere"=>$id_pere));
	}
	public function deleteCategorie(){
		$id= $this->post('id_categorie');
		$this->modeleCategorie->deleteCategorie($id);
	}
}
?>