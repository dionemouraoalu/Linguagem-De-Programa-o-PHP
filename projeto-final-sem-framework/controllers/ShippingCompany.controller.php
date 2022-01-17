<?php
	
	$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

	if($acao == 'cadastrar'){
		require_once('../models/Conection.model.php');
		require_once('../models/Manager.model.php');

		$connect = new Connect;
		$manager =  new Manager($connect);
		$ar = array();

		//verifica se algum id foi digitado manualmente
		//caso contrário, será incrementado automaticamente(default)
		$ar[] = isset($_POST['id']) ? $_POST['id'] : 'default'; 

		//verifica se o primeiro item do post é a ação
		foreach ($_POST as $key => $value) {
			if( !in_array($key , array('acao', 'id', 'local') ) )
				$ar[] = addslashes( $value);
		}

		$manager->create('Transportadora', $ar);
		
		
	}else if($acao == 'ler'){
		require_once('../models/Conection.model.php');
		require_once('../models/Manager.model.php');

		$connect = new Connect;
		$manager =  new Manager($connect);
		$result = $manager->read('Transportadora');
		
		echo "<pre>";
		print_r($result);
		echo "</pre>";


	}else if($acao == 'atualizar'){

	}else if($acao == 'deletar'){

	}





?>