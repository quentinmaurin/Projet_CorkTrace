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
	
}

?>
