<?php

require_once("Db.php");
require_once("Table.php");

final class CommandeFournisseurDetail extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cmdfoudetail_cfd";
        $this->fields = array(
            "CFD_ID" => "CFD_ID",
            "CFO_ID" => "CFO_ID",
            "PRO_ID" => "PRO_ID",
            "CFD_QUANTITE" => "CFD_QUANTITE",
            "CFD_PRIX" => "CFD_PRIX"
        );
	}
    public function getAllDetailByCommande($cfo_id){

        $query = "SELECT t_cmdfoudetail_cfd.cfd_id, t_cmdfoudetail_cfd.cfd_quantite,
        t_produit_pro.pro_id, t_produit_pro.pro_nom, t_produit_pro.pro_qualite, t_produit_pro.pro_taille
        FROM t_cmdfoudetail_cfd
        INNER JOIN t_produit_pro ON t_cmdfoudetail_cfd.pro_id=t_produit_pro.pro_id
        WHERE t_cmdfoudetail_cfd.cfo_id=".$cfo_id;
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
