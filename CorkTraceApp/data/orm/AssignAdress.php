<?php

require_once("Db.php");
require_once("Table.php");

final class AssignAdress extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cliadr_cla";
        $this->fields = array(
            "CLA_ID" => "CLA_ID",
            "CLI_ID" => "CLI_ID",
            "ADR_ID" => "ADR_ID"
        );
	}
    public function getDeliveriesAdress($cli_id){

        $query = "SELECT t_cliadr_cla.cla_id, t_adresse_adr.adr_id, t_adresse_adr.adr_adresse
        FROM t_cliadr_cla
        INNER JOIN t_adresse_adr ON t_cliadr_cla.adr_id=t_adresse_adr.adr_id
        WHERE t_cliadr_cla.cli_id=".$cli_id;
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
