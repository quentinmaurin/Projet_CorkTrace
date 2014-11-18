<?php

require_once("Db.php");
require_once("Table.php");

final class LivraisonDetail extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_livrdetail_lid";
        $this->fields = array(
                "lid_id"       => "lid_id",
                "liv_id"       => "liv_id",
                "ard_id"       => "ard_id",
                "lid_quantite" => "lid_quantite",
                "cfm_id"       => "cfm_id"
        );
	}
	
}

?>
