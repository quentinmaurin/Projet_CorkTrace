<?php

require_once("Db.php");
require_once("Table.php");

final class Stock extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_stock_stk";
        $this->fields = array(
                "STK_ID"    => "STK_ID",
                "STK_STOCK" => "STK_STOCK",
                "PRO_ID"    => "PRO_ID"
        );
	}

    public function getAll(){

        $query = "
        SELECT t_stock_stk.stk_id, t_stock_stk.stk_stock, t_produit_pro.pro_nom, t_produit_pro.pro_taille, t_produit_pro.pro_qualite, t_produit_pro.pro_id 
        FROM t_stock_stk 
        INNER JOIN t_produit_pro ON t_stock_stk.pro_id=t_produit_pro.pro_id";

        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
