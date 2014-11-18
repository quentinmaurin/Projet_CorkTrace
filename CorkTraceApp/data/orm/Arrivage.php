<?php

require_once("Db.php");
require_once("Table.php");

final class Arrivage extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_arrivage_ari";
        $this->fields = array(
                "ARI_ID" => "ARI_ID",
                "ARI_NUM_ARRIVAGE" => "ARI_NUM_ARRIVAGE",
                "ARI_DATE_RECEPT" => "ARI_DATE_RECEPT",
                "ARI_RESPONSABLE" => "ARI_RESPONSABLE"
        );
	}
}

?>
