<?php

require_once("Db.php");
require_once("Table.php");

final class Livraison extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_livraison_liv";
        $this->fields = array(
                "LIV_ID"      => "LIV_ID",
                "CCL_ID"      => "CCL_ID",
                "LIV_DATELIV" => "LIV_DATELIV",
                "LIV_RESPONSABLE" => "LIV_RESPONSABLE"
        );
	}
    public function getAllConformite($liv_id){

        $query = "SELECT t_livrdetail_lid.cfm_id
        FROM t_livrdetail_lid
        INNER JOIN t_livraison_liv ON t_livrdetail_lid.liv_id=t_livraison_liv.liv_id
        WHERE t_livraison_liv.liv_id=".$liv_id;
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
	
}

?>
