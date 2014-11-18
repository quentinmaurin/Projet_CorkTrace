<?php

require_once("Db.php");
require_once("Table.php");

final class CommandeFournisseurDetail extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cmdfoudetail_cfd";
        $this->fields = array(
            "CFD_ID" => "CFD_ID",
            "CFO_ID" => "CFO_ID",
            "PRO_ID" => "PRO_ID",
            "CFD_QUANTITE" => "CFD_QUANTITE",
            "CFD_PRIX" => "CFD_PRIX"
        );
	}
}

?>
