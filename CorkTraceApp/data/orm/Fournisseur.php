<?php

require_once("Db.php");
require_once("Table.php");

final class Fournisseur extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_fournisseur_fou";
        $this->fields = array(
                "FOU_ID"      => "FOU_ID",
                "FOU_NOM"     => "FOU_NOM",
                "FOU_ADRESSE" => "FOU_ADRESSE",
                "FOU_MAIL"    => "FOU_MAIL",
				"FOU_TEL"     => "FOU_TEL",
				"FOU_FAX"     => "FOU_FAX",
				"TYF_ID"      => "TYF_ID"
        );
	}
	
}

?>
