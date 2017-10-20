<?php 
/**
 * Classe responsable de la vue
 */
class Vue {
	private $fichier;
	function __construct($controleur,$vueName){
		$this->fichier = "Vue/".$controleur."/".$vueName.".php";
	}
	
	/**
	 * [genererFichier description]
	 * @param  [type]  $donnees    [description]
	 * @param  boolean $getContenu [description]
	 * @return [type]              [description]
	 */
	public function genererFichier($donnees=null,$getContenu=false){
		if(file_exists($this->fichier)){
			if($donnees!=null) extract($donnees);
			ob_start();
			require $this->fichier;
			if(!$getContenu){
				echo ob_get_clean();
			}
			else return ob_get_clean();
		}
		else throw new Exception("fichier ".$this->fichier."non trouvé");
		
	}
}
?>