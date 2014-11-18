<?php

require_once("Db.php");
require_once("Table.php");

final class Produit extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_produit_pro";
        $this->fields = array(
                "pro_id"      => "pro_id",
                "pro_nom"     => "pro_nom",
                "pro_taille"  => "pro_taille",
                "pro_qualite" => "pro_qualite"
        );
	}
	
}

?>
