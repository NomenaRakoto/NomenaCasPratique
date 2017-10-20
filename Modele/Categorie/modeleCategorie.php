<?php 
/**
 * Modele pour la catégorie
 */
class ModeleCategorie extends Modele{
	/**
	 * [getTousCategorie description]
	 * @return array [description]
	 */
	public function getTousCategorie(){
		$resultat = $this->select("categories");
		$data = [];
		while($ligne =  $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $ligne;
		}
		return $data;
	}
	/**
	 * [insertCategorie insertion d'une catégorie dans la base]
	 * @param  [type] $data nom des champs associés au valeur
	 * @return [type]       [description]
	 */
	public function insertCategorie($data){
			$this->insert("categories",$data);
	}
	/**
	 * [updateCategorie description]
	 * @param  [type] $data nom des champs associés au valeur
	 * @return [type]       [description]
	 */
	public function updateCategorie($data){
		$this->update("categories",$data);
	}
	public function deleteCategorie($id){
		$this->delete("categories",array("id"=>$id));

		$this->delete("categories",array("id_pere"=>$id));
		$this->delete('categorie_fiche',array("id_categorie"=>$id));
		$this->executerRequete("DELETE FROM fiches where id_fiche not in (SELECT CONCAT(cf.id_fiche) FROM categorie_fiche cf)");
	}
	/**
	 * [getTreeCategorie get categorie pour former un tree]
	 * @return [type] [description]
	 */
	public function getTreeCategorie(){
		$resultat = $this->select("categories",array('id'=>"id","libelle"=>"name","id_pere"=>"id_pere"));
		$data = [];
		while($ligne =  $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $ligne;
		}
		return $data;
	}
}
?>