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
                "LID_MARQUAGE" => "LID_MARQUAGE",
                "PRO_ID"       => "PRO_ID"
        );
	}

        public function getAll(){

                $query = "SELECT *
                FROM t_livrdetail_lid
                INNER JOIN t_produit_pro ON t_produit_pro.pro_id=t_livrdetail_lid.pro_id
                INNER JOIN t_livraison_liv ON t_livraison_liv.liv_id=t_livrdetail_lid.liv_id
                INNER JOIN t_cmdclient_ccl ON t_cmdclient_ccl.ccl_id=t_livraison_liv.ccl_id
                INNER JOIN t_clicom_clc ON t_clicom_clc.clc_id=t_cmdclient_ccl.clc_id
                INNER JOIN t_client_cli ON t_client_cli.cli_id=t_clicom_clc.cli_id
                ";

                $allRows = $this->db->getResponse($query);

                return $allRows;
        }

        public function getAllByLivraison($liv_id){

                $query = "SELECT *
                FROM t_livrdetail_lid 
                INNER JOIN t_conformite_cfm ON t_livrdetail_lid.cfm_id=t_conformite_cfm.cfm_id
                INNER JOIN t_produit_pro ON  t_livrdetail_lid.pro_id=t_produit_pro.pro_id
                WHERE t_livrdetail_lid.liv_id = ".$liv_id;

                $allRows = $this->db->getResponse($query);

                return $allRows;
        }
	
}

?>
