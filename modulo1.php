<?php
    /*
    * Dione Mourão
    * Exercício de Progressão de Módulo 1
    */


    echo "------------------------------------------------------ \n";
    echo "                   Questão 6 \n";
    echo "------------------------------------------------------ \n";

  
            $array = [0,1,2,3,4,5,6,7,8,9];
            $aux = 0;
            
            for($i = 0; $i < count($array) ; $i++){   
                $aux += $array[$i]; 
            }
            $aux = $aux /count($array); 
            
            echo "$aux \n\n\n";


      

    echo "------------------------------------------------------\n\n";
    echo "                   Questão 7 \n";
    echo "------------------------------------------------------\n";

            $array = [-2, 1, 5, 30, -3];
            $aux = 0;
            
            for($i = 0; $i < count($array) ; $i++){   
                if( $aux < $array[$i] ){
                    $aux = $array[$i];
                }
            }

            echo "O maior número é $aux \n\n\n";
        



    echo "------------------------------------------------------\n";
    echo "                   Questão 8 \n";
    echo "------------------------------------------------------ \n";
        
            $arrayIdades = [10, 8, 25, 30, 17];
            $arraySoma = [0, 0]; 
                
                for($i = 0; $i < count($arrayIdades) ; $i++){   
                    if(  $arrayIdades[$i] < 18 ){  
                        $arraySoma[0] += 1;
                    }else{
                        $arraySoma[1] += 1; 
                    }
                }
            
                echo "O número de pessoas maiores de idade é $arraySoma[0]  e o número de pessoas menores de idade é $arraySoma[1] \n\n\n";
       


    echo "------------------------------------------------------ \n";
    echo "                   Questão 9 \n";
    echo "------------------------------------------------------ \n";

    
                $arrayNomes = ['Hulk', 'Gamora', 'Viúva Negra', 'Capitão América', 'Miranha'];

                echo "Array de nomes: "; 

                for($i=0; $i < count($arrayNomes); $i++){
                    echo "$arrayNomes[$i],";
                }

                echo "\n\nArray de nomes invertidos: "; 

                for( $i= (count($arrayNomes) - 1); $i >=0; $i--){
                    echo "$arrayNomes[$i], ";
                }

                echo "\n\n";

    echo "------------------------------------------------------ \n";
    echo "                   Questão 10 \n";
    echo "------------------------------------------------------\n";
            
      

                $data = "04/12/2021";
                $array = array( 0 => '',
                                1 => '',
                                2 => ''
                            );   
                    
                    for($i=0; $i < 3; $i++){
                        for($j=0; $j < strlen( $data ); $j++){
                            if($j == 2 || $j == 5){
                                $j++;
                                $i++;
                            }
                                
                            $array[$i] .= $data[$j]; 
                        }
                    }
                        
                    echo "Dia = $array[0], Mês = $array[1], Ano = $array[2] \n\n";
            
            
    