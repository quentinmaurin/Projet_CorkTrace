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

        public function getAllByArrivage($ari_id){

                $query = "SELECT *
                FROM t_arrivagedetail_ard 
                INNER JOIN t_conformite_cfm ON t_arrivagedetail_ard.cfm_id=t_conformite_cfm.cfm_id
                WHERE t_arrivagedetail_ard.ari_id = ".$ari_id;

                $allRows = $this->db->getResponse($query);

                return $allRows;
        }
}

?>
