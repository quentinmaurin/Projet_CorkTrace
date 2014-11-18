<?php

require_once("Db.php");
require_once("Table.php");

final class ArrivageDetail extends Table{
	
	public function __construct(){
        $this->db = new Db();
		$this->name = "t_arrivagedetail_ard";
        $this->fields = array(
                "ARD_ID" => "ARD_ID",
                "ARI_ID" => "ARI_ID",
                "PRO_ID" => "PRO_ID",
                "CFM_ID" => "CFM_ID",
                "ARD_QUANTITE" => "ARD_QUANTITE"
        );
	}
}

?>
