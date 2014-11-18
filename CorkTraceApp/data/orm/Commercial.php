<?php

require_once("Db.php");
require_once("Table.php");

final class Commercial extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_commercial_com";
        $this->fields = array(
            "COM_ID" => "COM_ID",
            "COM_NOM" => "COM_NOM",
            "COM_PRENOM" => "COM_PRENOM",
            "COM_ADRESSE" => "COM_ADRESSE",
            "COM_MAIL" => "COM_MAIL",
            "COM_TEL" => "COM_TEL",
            "COM_FAX" => "COM_FAX"
        );
	}
}

?>
