<?php
	
class Manager{
		private $conection;

		public function __construct(Connect $conection){
			$this->conection = $conection->get_instance();
		}

		function create($table, $values){
			// echo($table);


			// echo "<pre>";
			// print_r($values);
			// echo "</pre>";
			$query = "INSERT INTO $table VALUES ( ";

				//'[value-1]','[value-2]') ";



			foreach ($values as $key => $value) {
				if( $value == 'default'){
					$query .= " $value " . " , ";
				}else{
					$query .= " '$value' " . " , ";
				}
			}
			$query = substr($query, 0, -2);
			$query .= 	")";


			echo($query);


			try{
	            $sql = $this->conection->prepare($query);
	            $sql->execute();
	        }catch(PDOException $e){
	            echo '<p>'.$e.'</p>';
	        }

		}//end create

		function read($table){
			$query = "SELECT * FROM  $table";

			try{
	            $sql = $this->conection->prepare($query);
	            $sql->execute();
	            return $sql->fetchAll(PDO::FETCH_ASSOC);

	        }catch(PDOException $e){
	            echo '<p>'.$e.'</p>';
	        }
			
		}
		function update(){
			
		}
		function delete(){
			
		}

		


}//end class manager






// public function delete_common($table, $filters, $query_extra){
// 	//criando o objeto pdo...
// 	$pdo = parent::get_instance();


// 	//filtros
// 	$filters_delete= "";

// 	foreach ($filters as $key => $value) {
// 		$filters_delete .= "$key=:$key AND ";
// 	}

// 	//removendo ultimo "AND";
// 	$filters_delete = substr($filters_delete, 0, -4);


// 	# preparando query apartir dos campos($fields) e os parametros de valores nomeados($values)
// 	$query =
// 	"DELETE FROM $table WHERE $filters_delete;";


// 	# se a consulta precisar de algo mais..
// 	if($query_extra !=
// 	""){
// 	$query .= $query_extra;
// 	}


// 	# apenas para testar a query (descomente o echo) - PADRÃO - COMENTADO
// 	//echo $query;
// 	//continuação da preparação da query...
// 	$statement = $pdo->prepare($query);
// 	if (!$statement) {
// 	echo "\PDO::errorInfo():\n";
// 	print_r($dbh->errorInfo());
// 	}


// 	//substituindo os parametros dos filtros nomeados pelos verdadeiros valores, ex: ":name" por "Anthony"
// 	foreach ($filters as $key => $value){
// 		//$parameters[":$key"] = $value;
// 		$statement->bindValue(":$key"
// 		, $value, PDO::PARAM_STR);
// 	}


// 	//executando a query já com seus valores
// 	if($statement->execute()){
// 		//se der certo retorna true...
// 		return true;
// 	}else{
// 		//se não der certo, retornará false...
// 		return false;
// 	}
// }//Fechando o método DELETE COMMOM 