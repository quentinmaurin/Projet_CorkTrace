<?php

require_once("Db.php");
require_once("Table.php");

final class Livraison extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_livraison_liv";
        $this->fields = array(
                "liv_id"      => "liv_id",
                "ccl_id"      => "ccl_id",
                "liv_dateLiv" => "liv_dateLiv",
                "liv_responsable" => "liv_responsable"
        );
	}
	
}

?>
