<?php

require_once("Db.php");
require_once("Table.php");

final class Livraison extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_livraison_liv";
        $this->fields = array(
                "LIV_ID"      => "LIV_ID",
                "CCL_ID"      => "CCL_ID",
                "LIV_DATELIV" => "LIV_DATELIV",
                "LIV_RESPONSABLE" => "LIV_RESPONSABLE"
        );
	}
	
}

?>
