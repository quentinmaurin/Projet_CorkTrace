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
    public function getCommercialByClient($cli_id){

        $query = "SELECT t_clicom_clc.clc_id, t_clicom_clc.cli_id, t_clicom_clc.com_id, t_commercial_com.com_nom
        FROM t_clicom_clc
        INNER JOIN t_commercial_com ON t_clicom_clc.com_id=t_commercial_com.com_id
        WHERE t_clicom_clc.cli_id=".$cli_id;
        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
