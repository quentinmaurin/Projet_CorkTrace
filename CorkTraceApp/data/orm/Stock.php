<?php

require_once("Db.php");
require_once("Table.php");

final class Stock extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_stock_stk";
        $this->fields = array(
                "stk_id"    => "stk_id",
                "stk_stock" => "stk_stock",
                "pro_id"    => "pro_id"
        );
	}
	
}

?>
