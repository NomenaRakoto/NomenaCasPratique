<?php 
class ModeleCategorie extends Modele{
	public function getTousCategorie(){
		$resultat = $this->select("categories");
		$data = [];
		while($ligne =  $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $ligne;
		}
		return $data;
	}
	public function insertCategorie($data){
			$this->insert("categories",$data);
	}
	public function updateCategorie($data){
		$this->update("categories",$data);
	}
	public function deleteCategorie($id){
		$this->delete("categories",$id);
	}
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