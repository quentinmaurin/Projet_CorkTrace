<?php

/**
    * @file Db.php
    * @author Loïc TRICJAUD
    * @version 1.0
    * @date 01/10/2014
    * @brief Db class. This class allows the connection, access and disconnection of database
*/

/**
    * @class Db
    * @brief This class allows the connection, access and disconnection of database
*/
class Db{

    private $host;
    private $user;
    private $password;
    private $bd_name;
	private $link;
	
	public function __construct(){

        $this->host = "localhost";
        $this->user = "corktrace_bcpf";
        $this->password = "imerir66";
        $this->bd_name = "corktrace_bcpf";

        $this->user = "root";
        $this->password = "";
        $this->bd_name = "DB_CORKTRACE";

		$this->link = mysqli_connect( $this->host , $this->user, $this->password, $this->bd_name) or die ("Connexion MYSQL => PROBLEME");
		mysqli_set_charset($this->link, "utf8");
	}
	
	/**
        * Returns the result of a sql query
        * @param $query SQL request
        * @return $response response of query
    */
	public function getResponse($query){
		
		$resultQuery = $this->executeQuery($query);
		$reponse = "";
		
		if($resultQuery){
		
			$response = array();
			
			while( $row = mysqli_fetch_assoc($resultQuery) ){
			
				array_push($response, $row);
			}
			
		}else{
		
			$response = $resultQuery;
			
		}
		
		return $response;
	}
	
	/**
        * Returns the result of a sql query
        * @param $query SQL request
        * @return $response response of query
    */
	public function executeQuery($query){
	
		$resultQuery = mysqli_query($this->link, $query) or die ("Requete => PROBLEME");
		
		return $resultQuery;

	}
	
	/**
        * Display the list of tables
    */
	public function showTables(){
	
		$resultQuery = $this->executeQuery("SHOW TABLES;");
		
		echo "Liste des tables : <br><br>";
		
		while( $row = mysqli_fetch_row($resultQuery) ){
		
			echo " - ".$row[0]."<br>";
		}
		
		echo "<br>";
	}
	
	/**
        * Database deconnection
    */
	public function deconnect(){
		
		mysqli_close($this->link);
		$this->link = NULL;
	}
}

?>
