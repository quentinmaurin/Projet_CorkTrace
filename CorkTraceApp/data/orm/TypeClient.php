<?php

require_once("Db.php");
require_once("Table.php");

final class TypeClient extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_typecli_tyc";
        $this->fields = array(
                "tyc_id"  => "tyc_id",
                "tyc_nom" => "tyc_nom"
        );
	}
	
}

?>
