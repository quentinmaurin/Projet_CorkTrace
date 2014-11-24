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
                "CFM_ID"       => "CFM_ID",
                "LID_PRIX"     => "LID_PRIX",
                "LID_MARQUAGE" => "LID_MARQUAGE"
        );
	}

        public function getAllByLivraison($liv_id){

                $query = "SELECT *
                FROM t_livrdetail_lid 
                INNER JOIN t_conformite_cfm ON t_livrdetail_lid.cfm_id=t_conformite_cfm.cfm_id
                WHERE t_livrdetail_lid.liv_id = ".$liv_id;

                $allRows = $this->db->getResponse($query);

                return $allRows;
        }
	
}

?>
