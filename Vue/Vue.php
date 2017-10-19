<?php 
class Vue {
	private $fichier;
	function __construct($controleur,$vueName){
		$this->fichier = "Vue/".$controleur."/".$vueName.".php";
	}
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