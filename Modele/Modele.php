<?php 
abstract class Modele {
	private static $bdd;
	function __construct(){
		self::$bdd = Connexion::getInstance()->getBDD();
	}
	/**
	 * [executerRequete protected function pour executer une requete
	 * @param  [type] $requete [description]
	 * @param  [type] $params  [description]
	 * @return [type]          [description]
	 */
	protected function executerRequete($requete,$params=null){
		if($params==null){
			$resultat = self::$bdd->query($requete);
		}
		else {
			$resultat = self::$bdd->prepare($requete);
			$resultat->execute($params);
		}
		return $resultat;
	}
	/**
	 * [insert protected function pour faciliter l'insertion dans la base de donnéds]
	 * @param  [type] $table  [description]
	 * @param  [type] $values [description]
	 * @return [type]         [description]
	 */
	protected function insert($table,$values){
		$requete = "INSERT INTO ".$table." SET ";
		$params = [];
		foreach ($values as $key => $value) {
			$requete.=$key."=?,";
			$params[] = $value;
		}
		$requete = substr($requete, 0,count($requete)-2);
		$this->executerRequete($requete,$params);
	}
	/**
	 * [update protected function pour faciliter la mise à jour]
	 * @param  [type] $table  [description]
	 * @param  [type] $values [description]
	 * @return [type]         [description]
	 */
	protected function update($table,$values){
		$requete = "UPDATE ".$table." SET ";
		$primary_key_column = ""; 
		$params = [];
		foreach ($values as $key => $value) {
			if($primary_key_column == ""){
				$primary_key_column = $key;
				$primary_key_value = $value;
			}
			else {
				$requete.=$key."= ?,";
				$params[] = $value;
			}
		}
		$params[] = $primary_key_value; 
		$requete = substr($requete, 0,count($requete)-2);
		$requete.=" WHERE ".$primary_key_column."=?";
		$this->executerRequete($requete,$params);
	}
	/**
	 * [delete protected function pour la suppression]
	 * @param  [type] $table  [description]
	 * @param  [type] $column [description]
	 * @return [type]         [description]
	 */
	protected function delete($table,$column){
		$requete = "DELETE FROM ".$table." WHERE ";
		$params = [];
		foreach ($column as $key => $value) {
			$requete.=$key."=?";
			$params[] = $value;
		}
		$this->executerRequete($requete,$params);
	}
	/**
	 * [last_insert_id derniere id insertion]
	 * @param  [type] $info_table [description]
	 * @return [type]             [description]
	 */
	protected function last_insert_id($info_table=null){
		if($info_table==null){
			return self::$bdd->lastInsertId();
		}
		else {
			$table = $info_table[0];
			$table_column = $infotable[1];
			$requete = "SELECT MAX(".$table_column.") AS lastInsertId FROM ".$table;
			$resultat = $this->executerRequete($requete);
			if ($resInsert = $resultat->fetch(PDO::FETCH_ASSOC)) {
				return $resInsert["lastInsertId"];
			}
			else return null;
		}
	}
	/**
	 * [select protected function pour la recuperation des données]
	 * @param  [type] $table  [description]
	 * @param  [type] $column [description]
	 * @return [type]         [description]
	 */
	protected function select($table,$column=null){
		if($column==null){
			$requete = "SELECT * FROM ".$table;
		}
		else{
			$requete = "SELECT ";
			foreach ($column as $key => $value) {
				$requete.=$key;
				if($value!=""){
					$requete.=" AS ".$value;
				}
				$requete.=",";
			}
			$requete = substr($requete, 0,count($requete)-2);
			$requete.=" FROM ".$table;
		}
		$resultat = $this->executerRequete($requete);
		return $resultat;
	}
}
?>