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

		$manager->create('Fornecedor', $ar);
		header("Location: ../provider.php"); 
		
		
	}else if($acao == 'ler'){
		require_once('../models/Conection.model.php');
		require_once('../models/Manager.model.php');

		$connect = new Connect;
		$manager =  new Manager($connect);
		$result = $manager->read('Fornecedor');
		
		header("Location: ../settings.php"); 

	}else if($acao == 'atualizar'){
		header("Location: ../settings.php"); 

	}else if($acao == 'deletar'){
		header("Location: ../settings.php"); 

	}





?>