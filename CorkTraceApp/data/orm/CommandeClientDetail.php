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
            "CCD_MARQUAGE" => "CCD_MARQUAGE"
        );
	}
	
	public function getListDetails($id_cmd_client){

        $query = "SELECT t_cmdclidetail_ccd.ccd_id, t_cmdclidetail_ccd.pro_id, t_produit_pro.pro_nom,
        t_produit_pro.pro_taille, t_produit_pro.pro_qualite,
        t_cmdclidetail_ccd.ccd_quantite, t_cmdclidetail_ccd.ccd_prix
				  FROM t_cmdclidetail_ccd 
					INNER JOIN t_produit_pro 
					ON t_cmdclidetail_ccd.pro_id = t_produit_pro.pro_id 
				  WHERE ccl_id = $id_cmd_client";
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
