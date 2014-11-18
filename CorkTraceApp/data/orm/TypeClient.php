<?php

require_once("Db.php");
require_once("Table.php");

final class TypeClient extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_typecli_tyc";
        $this->fields = array(
                "TYC_ID"  => "TYC_ID",
                "TYC_NOM" => "TYC_NOM"
        );
	}
	
}

?>
