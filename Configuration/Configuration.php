<?php 
/**
 * Singleton obtention des configurations de l'application
 */
 class Configuration {
 	private static $_instance;
 	private $settings;
 	private function __construct(){
 		$file = "Configuration/Configuration.ini";
 		if(file_exists($file)){
 			$this->settings = parse_ini_file($file);
 		}
 		else throw new Exception("fichier de configuration non trouvé");
 	}
 	public function getInstance(){
 		if(self::$_instance==null){
 			self::$_instance = new Configuration();
 		}
 		return self::$_instance;
 	}
 	public function get($name){
 		if(isset($this->settings[$name])){
 			return $this->settings[$name];
 		}
 		else throw new Exception("paramètre ".$name." non trouvé");
 	}
 }
?>