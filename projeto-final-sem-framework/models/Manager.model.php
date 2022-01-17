<?php
	
class Manager{
		private $conection;

		public function __construct(Connect $conection){
			$this->conection = $conection->get_instance();
		}

		function create($table, $values){
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

		function read($table, $query_extra=null){
			$query = "SELECT * FROM  $table ";

			if($query == null){
				

				try{
		            $sql = $this->conection->prepare($query);
		            $sql->execute();
		            return $sql->fetchAll(PDO::FETCH_ASSOC);

		        }catch(PDOException $e){
		            echo '<p>'.$e.'</p>';
		        }
			}else{
				$query .= $query_extra;

				try{
		            $sql = $this->conection->prepare($query);
		            $sql->execute();
		            return $sql->fetchAll(PDO::FETCH_ASSOC);

		        }catch(PDOException $e){
		            echo '<p>'.$e.'</p>';
		        }
			}

			
			
		}


		function update($table, $array=null){
			$query = "UPDATE $table ";

			if($query != null){
				foreach($array as $key => $value){
					$query_aux = "SET $key = $value";
				}
				$query_aux = $query = substr($query_aux, 0, -2);
				$query .= $query_aux;

				try{
		            $sql = $this->conection->prepare($query);
		            $sql->execute();
		            return $sql->fetchAll(PDO::FETCH_ASSOC);

		        }catch(PDOException $e){
		            echo '<p>'.$e.'</p>';
		        }
			}
		}




		function delete($table, $query_extra=null){
			$query = "DELETE FROM $table";

			if($query != null){
				$query .= $query_extra;

				try{
		            $sql = $this->conection->prepare($query);
		            $sql->execute();
		            return $sql->fetchAll(PDO::FETCH_ASSOC);

		        }catch(PDOException $e){
		            echo '<p>'.$e.'</p>';
		        }
			}
		}

		


}//end class manager