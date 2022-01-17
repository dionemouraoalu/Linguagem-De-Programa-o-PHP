<?php
	class Connect{
	    private $host = 'localhost';
	    private $dbname = 'projetoFinalDB';
	    private $user = 'root';
	    private $pass = '';

	    // private $host = 'sql300.epizy.com';
	    // private $dbname = 'epiz_30169159_checklist';
	    // private $user = 'epiz_30169159';
	    // private $pass = 'HEtQTHmoo1FJ';



	    public function get_instance(){
	        try{
	            
	            $conection = new PDO(
	                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
	                "$this->user",
	                "$this->pass"
	            );

	            return $conection;

	        }catch(PDOException $e){
	            echo '<p>'.$e.getMessage().'</p>';
	        }
	    }

	}


?>