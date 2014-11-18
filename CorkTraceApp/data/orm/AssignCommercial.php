<?php

require_once("Db.php");
require_once("Table.php");

final class AssignCommercial extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_clicom_clc";
        $this->fields = array(
            "CLC_ID" => "CLC_ID",
            "CLI_ID" => "CLI_ID",
            "COM_ID" => "COM_ID"
        );
	}
}

?>
