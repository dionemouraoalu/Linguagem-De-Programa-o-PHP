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
		function update($table, $values){
			
		}
		function delete($table, $id){
			
		}

		


}//end class manager