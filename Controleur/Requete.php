<?php 
class Requete {
	private $parametres;
	function __construct($parametres){
		$this->parametres = $parametres;
	}
	public function getAction(){
		if( $this->existeParametreGet('action'))
			return $this->getParametreGet('action');
		else return null;
	}
	public function existeParametrePost($name){
		if(isset($this->parametres["post"][$name]))
		{
			return true;
		}
		else return false;
	}
	public function existeParametreGet($name){
		if(isset($this->parametres["get"][$name]))
		{
			return true;
		}
		else return false;
	}
	public function getParametrePost($name){
		if($this->existeParametrePost($name))
		{
			return $this->parametres["post"][$name];
		}
		else throw new Exception("paramètre post".$name." non trouvé");
	}
	public function getParametreGet($name){
		if($this->existeParametreGet($name))
		{
			return $this->parametres["get"][$name];
		}
		else throw new Exception("paramètre get".$name." non trouvé");
	}
	public function getControleur(){
		if( $this->existeParametreGet('controleur'))
			return $this->getParametreGet('controleur');
		else return null;
	}

}
?>