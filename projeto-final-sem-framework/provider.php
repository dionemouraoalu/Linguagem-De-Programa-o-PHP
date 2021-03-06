<?php 

	require_once('models/Conection.model.php');
	require_once('models/Manager.model.php');

	session_start();
	$_SESSION['page'] = "/";

	$connect = new Connect;
	$manager =  new Manager($connect);
	$result = $manager->read('Cidade');;
	
	$return = json_encode($result);

 ?>




<DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Fornecedores</title>
	<link rel="stylesheet" type="text/css" href="Bootstrap/bootstrap.min.css">
</head>
<body class="container-xl">
	


	<ul class="nav justify-content-end">
	  <li class="nav-item">
	    <a class="nav-link active" aria-current="page" href="products.php">Produtos</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="provider.php">Fornecedores</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="shippingCompany.php">Transportadora</a>
	  </li>

	  <li class="nav-item">
	    <a class="nav-link" href="settings.php">Configurações</a>
	  </li>
	  <!-- <li class="nav-item">
	    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
	  </li> -->
	</ul>



	<form style="max-width: 500px;" method="post" action="controllers/Provider.controller.php?acao=cadastrar">

		<div class="form-outline">
			<select class="form-select select-city" name="Cidade_codcidade">
			<option value="">Selecione uma cidade</option>
			</select>
		</div>

		<div class="form-group">
		  <label for="usr">Nome:</label>
		  <input type="text" class="form-control" id="usr" name="fornecedor" >
		</div>

		<div class="form-group">
		  <label for="usr">Endereço:</label>
		  <input type="text" class="form-control" id="usr" name="endereco" >
		</div>

		<div class="form-group">
		  <label for="usr">Num:</label>
		  <input type="text" class="form-control" id="usr" name="num" >
		</div>

		<div class="form-group">
		  <label for="usr">Bairro:</label>
		  <input type="text" class="form-control" id="usr" name="bairro" >
		</div>

		<div class="form-group">
		  <label for="usr">Cep:</label>
		  <input type="text" class="form-control" id="usr" name="cep" >
		</div>

		<div class="form-group">
		  <label for="usr">Contato:</label>
		  <input type="text" class="form-control" id="usr" name="contato" >
		</div>

		<div class="form-group">
		  <label for="usr">CNPJ:</label>
		  <input type="text" class="form-control" id="usr" name="cnpj" >
		</div>

		<div class="form-group">
		  <label for="usr">Insc:</label>
		  <input type="text" class="form-control" id="usr" name="insc" >
		</div>

		<div class="form-group">
		  <label for="usr">Telefone:</label>
		  <input type="text" class="form-control" id="usr" name="tel" >
		 </div> 
		
		<div class="col-auto">
		    <button type="submit" class="btn btn-primary mb-3">Cadastrar</button>
		</div>
	</form>


	<?php 
		$resultProvider = $manager->read('Fornecedor');

		// echo "<pre>";
		// print_r($resultProvider);
		// echo "</pre>";


		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Fornecedor</th>";
					$table .= "<th>Cidade</th>";
					$table .= "<th>CNPJ</th>";
					$table .= "<th>Endreço</th>";
					$table .= "<th>Bairro</th>";
					$table .= "<th>Cep</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultProvider as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codfornecedor'] ."</td>";
					$table .= "<td>". $value['fornecedor'] ."</td>";

					$query_extra = " WHERE codcidade = ". $value['Cidade_codcidade'];
					$resultCity= $manager->read('Cidade', $query_extra);
					$table .= "<td>". $resultCity[0]['cidade']."</td>";
					
					$table .= "<td>". $value['cnpj'] ."</td>";
					$table .= "<td>". $value['endereco'] ."</td>";
					$table .= "<td>". $value['bairro'] ."</td>";
					$table .= "<td>". $value['cep'] ."</td>";

					//echo $query_extra;
					$table .= "</tr>";
				}
			
			$table .= "</tbody>";
		$table .= "</table>";

		echo $table;
	 ?>





<!-- convertendo json para objeto javascript-->
	<script>
		var txt = '<?php print($return); ?> '; // insere o retorno do banco de dados na variável 
		var data =  JSON.parse(txt); //converte para objeto
		// console.log(data);

		// localiza a tebela
		var select = document.querySelector('.select-city');

		//insere a linha com o código e o nome do curso na tabela
		data.forEach( (el)=>{
			var option = document.createElement("option");
			option.setAttribute("value", ""+el.codcidade +"");
			option.innerHTML = el.cidade; 

			// select .innerHTML = [ "<option value=''>Selecione uma cidade</option>" + "<option value='" +el.codcidade +"' >" + el.cidade + '</option>'].join("\n") ;

			select.appendChild(option);
		});
	
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>