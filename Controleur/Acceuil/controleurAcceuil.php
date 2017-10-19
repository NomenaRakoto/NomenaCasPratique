<?php 
class controleurAcceuil extends Controleur {
	private $modeleCategorie;
	private $modelefiche;
	function __construct(){
		$this->modeleFiche = $this->chargerModele("ModeleFiche");
		$this->modeleCategorie = $this->chargerModele("ModeleCategorie");
	}
	public function index(){
		$fiches = $this->modeleFiche->getAllFiches();
		$categories = $this->modeleCategorie->getTousCategorie();
		$categorieData = [];
		foreach($categories as $cat){
			$categorieData [] = new Categorie($cat['id'],$cat['libelle'],$cat['id_pere']);
		}
		$this->genererVue('Acceuil',array("fiches"=>$fiches,"categories"=>$categorieData));
	}
	public function getCategorieTree(){
		$categories = $this->modeleCategorie->getTreeCategorie();
		$itemsByReference = array();
		foreach($categories as $key => &$item) {
		   $itemsByReference[$item['id']] = &$item;
		   $itemsByReference[$item['id']]['children'] = array();
		}
		foreach($categories as $key => &$item)
		{
		   if($item['id_pere'] && isset($itemsByReference[$item['id_pere']]))
		   {
		   	  $temp = $item['id_pere'];
		   	  unset($item['id_pere']);
		      $itemsByReference [$temp]['children'][] = &$item;
		   }
		}
		$result = array();
		foreach($categories as $key => &$item) {
		   if(empty($item['id_pere']) && array_key_exists("id_pere", $item)){
			    unset($item['id_pere']);
			    $result[] = $item;
			}
		}
		unset($categories);
		unset($itemsByReference);
		echo json_encode($result);
	}
}
?>