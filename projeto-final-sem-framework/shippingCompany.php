<?php 
	require_once('models/Conection.model.php');
	require_once('models/Manager.model.php');

	session_start();
	$_SESSION['page'] = "/";

	$connect = new Connect;
	$manager =  new Manager($connect);
	$result = $manager->read('Cidade');
	
	$return = json_encode($result);

 ?>




<DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Transportadora</title>
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

	<form  style="max-width: 500px;" method="post" action="controllers/ShippingCompany.controller.php?acao=cadastrar">

		<div class="form-outline">
			<select class="form-select select-city" name="Cidade_codcidade">
				<option value="">Selecione uma cidade</option>
			</select>
		</div>

		<div class="form-group">
		  <label for="usr">Nome:</label>
		  <input type="text" class="form-control" id="usr" name="transportadora" >
		</div>

		<div class="form-group">
		  <label for="usr">Endereço:</label>
		  <input type="text" class="form-control" id="usr" name="endereco" >
		</div>

		<div class="form-group">
		  <label for="usr">Número:</label>
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
		  <label for="usr">CNPJ:</label>
		  <input type="text" class="form-control" id="usr" name="cnpj" >
		</div>

		<div class="form-group">
		  <label for="usr">Insc:</label>
		  <input type="text" class="form-control" id="usr" name="insc" >
		</div>

		<div class="form-group">
		  <label for="usr">Contato:</label>
		  <input type="text" class="form-control" id="usr" name="contato" >
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
		$resultShippingCompany = $manager->read('Transportadora');

		// echo "<pre>";
		// print_r($resultShippingCompany);
		// echo "</pre>";


		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Nome</th>";
					$table .= "<th>Cidade</th>";
					$table .= "<th>Cnpj</th>";
					$table .= "<th>Endereço</th>";
					$table .= "<th>Cep</th>";
					$table .= "<th>Bairro</th>";
					$table .= "<th>Telefone</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultShippingCompany  as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codtransportadora'] ."</td>";
					$table .= "<td>". $value['transportadora'] ."</td>";

					$query_extra = " WHERE codcidade = ". $value['Cidade_codcidade'];
					$resultCity= $manager->read('Cidade', $query_extra);
					$table .= "<td>". $resultCity[0]['cidade']."</td>";

					$table .= "<td>". $value['cnpj'] ."</td>";
					$table .= "<td>". $value['endereco'] ."</td>";
					$table .= "<td>". $value['cep'] ."</td>";
					$table .= "<td>". $value['bairro'] ."</td>";
					$table .= "<td>". $value['tel'] ."</td>";

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
</body>
</html>