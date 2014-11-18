<?php

require_once("Db.php");
require_once("Table.php");

final class TypeFourni extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_typefou_tyf";
        $this->fields = array(
                "TYF_ID"  => "TYF_ID",
                "TYF_NOM" => "TYF_NOM"
        );
	}
	
}

?>
