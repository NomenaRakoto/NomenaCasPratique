<?php 
abstract class Controleur {
	private $requete;
	public function setRequete(Requete $requete){
		$this->requete = $requete;
	}
	/**
	 * [index action par defaut]
	 * @return [type] [description]
	 */
	abstract function index();
	protected function chargerModele($name){
		return new $name();
	}
	/**
	 * [genererVue génération d'une interface(vue)]
	 * @param  [type]  $vueName    [description]
	 * @param  [type]  $donnees    [description]
	 * @param  boolean $getContenu [description]
	 * @return [type]              [description]
	 */
	protected function genererVue($vueName,$donnees=null,$getContenu=false){
		$controleur = get_class($this);
		$controleur = str_replace("controleur","",$controleur);
		$vue = new Vue($controleur,$vueName);
		$vue->genererFichier($donnees,$getContenu);
	}
	/**
	 * [get obtenir une paramètre get]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	protected function get($name){
		if($this->requete->existeParametreGet($name)){
			return $this->requete->getParametreGet($name);
		}
		else return null;
	}
	/**
	 * [post obtenir une parametre post
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	protected function post($name){
		if($this->requete->existeParametrePost($name)){
			return $this->requete->getParametrePost($name);
		}
		else return null;
	}
	/**
	 * [executerAction description]
	 * @param  [type] $action [description]
	 * @return [type]         [description]
	 */
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