<?php

require_once("Db.php");
require_once("Table.php");

final class Produit extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_produit_pro";
        $this->fields = array(
                "PRO_ID"      => "PRO_ID",
                "PRO_NOM"     => "PRO_NOM",
                "PRO_TAILLE"  => "PRO_TAILLE",
                "PRO_QUALITE" => "PRO_QUALITE"
        );
	}
	
}

?>
