<?php

require_once("Db.php");
require_once("Table.php");

final class TypeFourni extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_typefou_tyf";
        $this->fields = array(
                "tyf_id"  => "tyf_id",
                "tyf_nom" => "tyf_nom"
        );
	}
	
}

?>
