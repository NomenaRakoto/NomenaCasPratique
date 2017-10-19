<?php 
abstract class Controleur {
	private $requete;
	public function setRequete(Requete $requete){
		$this->requete = $requete;
	}
	abstract function index();
	protected function chargerModele($name){
		return new $name();
	}
	protected function genererVue($vueName,$donnees=null,$getContenu=false){
		$controleur = get_class($this);
		$controleur = str_replace("controleur","",$controleur);
		$vue = new Vue($controleur,$vueName);
		$vue->genererFichier($donnees,$getContenu);
	}
	protected function get($name){
		if($this->requete->existeParametreGet($name)){
			return $this->requete->getParametreGet($name);
		}
		else return null;
	}
	protected function post($name){
		if($this->requete->existeParametrePost($name)){
			return $this->requete->getParametrePost($name);
		}
		else return null;
	}
	public function executerAction($action){
		if(method_exists($this, $action))
		{
			$this->$action();
		}
		else {
			$class = get_class($this);
			throw new Exception("Méthode ".$action." non trouvé dans la classe ".$class);
			
		}
	}
}
?>