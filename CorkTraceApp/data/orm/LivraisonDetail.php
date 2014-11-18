<?php

require_once("Db.php");
require_once("Table.php");

final class LivraisonDetail extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_livrdetail_lid";
        $this->fields = array(
                "LID_ID"       => "LID_ID",
                "LIV_ID"       => "LIV_ID",
                "ARD_ID"       => "ARD_ID",
                "LID_QUANTITE" => "LID_QUANTITE",
                "CFM_ID"       => "CFM_ID"
        );
	}
	
}

?>
