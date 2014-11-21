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
    public function getAllConformite($ari_id){

        $query = "SELECT t_arrivagedetail_ard.cfm_id
        FROM t_arrivagedetail_ard
        INNER JOIN t_arrivage_ari ON t_arrivagedetail_ard.ari_id=t_arrivage_ari.ari_id
        WHERE t_arrivage_ari.ari_id=".$ari_id;
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
