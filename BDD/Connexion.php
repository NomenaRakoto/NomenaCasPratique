<?php
/**
 * Instanciation unique de la base de données 
 */
 class Connexion {
 	private static $_instance;
 	private static $bdd;
 	public function getInstance(){
 		if(self::$_instance==null){
 			self::$_instance = new Connexion();
 		}
 		return self::$_instance;
 	}
 	private function __construct(){
 		$dsn = Configuration::getInstance()->get('dsn');
 		$user = Configuration::getInstance()->get('user');
 		$mdp = Configuration::getInstance()->get('mdp');
 		try{
 			self::$bdd = new PDO($dsn,$user,$mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

 		} catch (PDOException $e) {
		    print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
 	}
 	public function getBDD(){
 		return self::$bdd;
 	}
 }
?>