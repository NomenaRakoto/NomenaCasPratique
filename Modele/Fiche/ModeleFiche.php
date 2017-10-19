<?php 
class ModeleFiche extends Modele {
	public function getAllFiches(){
		$resultat = $this->select("fiches");
		$fiches = [];
		while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
			$requete = "SELECT cat.libelle FROM categorie_fiche cf INNER JOIN categories cat ON cf.id_categorie=cat.id WHERE cf.id_fiche=?";
			$fiche_categories = $this->executerRequete($requete,array($ligne["id_fiche"]));
			$categories = [];
			while($ligne_cat = $fiche_categories->fetch(PDO::FETCH_ASSOC)){
				$categories[] =new Categorie(null, $ligne_cat['libelle'],null);
			}
			$fiche = new Fiche($ligne["id_fiche"],$ligne["libelle_fiche"],$ligne['description'],$categories);
			$fiches[] = $fiche;
		}
		return $fiches;
	}
	public function insertFiche($data)
	{
		$this->insert("fiches",$data);
	}
	public function updateFiche($data)
	{
		$this->update("fiches",$data);
	}
	public function deleteFiche($id)
	{
		$this->delete("fiches",array("id_fiche"=>$id));
		$this->delete("categorie_fiche",array("id_fiche"=>$id));
	}
	public function insertFicheCategorie($categories,$id_fiche=null){
		if($id_fiche==null){
			$id_fiche = $this->last_insert_id();
		}
		$this->delete("categorie_fiche",array("id_fiche"=>$id_fiche));
		foreach ($categories as $value) {
			$this->insert("categorie_fiche",array("id_fiche"=>$id_fiche,"id_categorie"=>$value));
		}
	}
	public function getFicheCategories($id){
		$requete = "SELECT id_categorie FROM categorie_fiche WHERE id_fiche=?";
		$resultat = $this->executerRequete($requete,array($id));
		$categories = [];
		while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
			$categories[] = $ligne['id_categorie'];
		}
		return $categories;
	}
}
?>