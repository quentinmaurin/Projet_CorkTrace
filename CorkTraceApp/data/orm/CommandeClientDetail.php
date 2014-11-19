<?php

require_once("Db.php");
require_once("Table.php");

final class CommandeClientDetail extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cmdclidetail_ccd";
        $this->fields = array(
            "CCD_ID" => "CCD_ID",
            "CCL_ID" => "CCL_ID",
            "PRO_ID" => "PRO_ID",
            "CCD_PRIX" => "CCD_PRIX",
            "CCD_QUANTITE" => "CCD_QUANTITE",
            "CCD_MARQUAGE" => "CCD_MARQUAGE",
			"CFM_ID" => "CFM_ID"
        );
	}
}

?>
