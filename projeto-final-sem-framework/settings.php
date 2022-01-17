<?php 

	require_once('models/Conection.model.php');
	require_once('models/Manager.model.php');

	$connect = new Connect;
	$manager =  new Manager($connect);
	$resultCategory = $manager->read('Categoria');
	$resultProvide = $manager->read('Fornecedor');	
	$resultCity = $manager->read('Cidade');
	
	$category = json_encode($resultCategory);
	$provide = json_encode($resultProvide);
	$city = json_encode($resultCity);

 ?>



<DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Configurações</title>
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


	<h3>Cadastrar cidades</h3>
	<form method="post" action="controllers/City.controller.php?acao=cadastrar">
		<input type="text" name="cidade" placeholder="Cidade">
		<input type="text" name="uf" placeholder="UF">

		<input type="submit" value="Cadastrar">
	</form>

	<?php 
		$resultCity = $manager->read('Cidade');
		

		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Cidade</th>";
					$table .= "<th>UF</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultCity as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codcidade'] ."</td>";
					$table .= "<td>". $value['cidade']."</td>";
					$table .= "<td>". $value['uf']."</td>";
					$table .= "</tr>";
				}
			
			$table .= "</tbody>";
		$table .= "</table>";

		echo $table;
	 ?>




	<h3>Cadastrar categoria</h3>
	<form method="post" action="controllers/Category.controller.php?acao=cadastrar">
		<input type="text" name="categoria" placeholder="Categoria">

		<input type="submit" value="Cadastrar">
	</form>

	<?php 
		$resultCity = $manager->read('Categoria');
		// echo "<pre>";
		// print_r($resultCity);
		// echo "</pre>";

		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Nome</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultCity as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codcategoria'] ."</td>";
					$table .= "<td>". $value['categoria']."</td>";
					$table .= "</tr>";
				}
			
			$table .= "</tbody>";
		$table .= "</table>";

		echo $table;
	 ?>


	<h3>Cadastrar Loja</h3>
	<form style="max-width: 500px;" method="post" action="controllers/Store.controller.php?acao=cadastrar">

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
		  <label for="usr">Telefone:</label>
		  <input type="text" class="form-control" id="usr" name="tel" >
		</div>
		
		<div class="form-group">
		  <label for="usr">Insc:</label>
		  <input type="text" class="form-control" id="usr" name="insc" >
		</div>

		<div class="form-group">
		  <label for="usr">CNPJ:</label>
		  <input type="text" class="form-control" id="usr" name="cnpj" >
		</div>

		


		<div class="col-auto">
		    <button type="submit" class="btn btn-primary mb-3">Cadastrar</button>
		</div>
	</form>

	<?php 
		$resultStore = $manager->read('Loja');
		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Nome</th>";
					$table .= "<th>Endereço</th>";
					$table .= "<th>Cidade</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultStore as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codloja'] ."</td>";
					$table .= "<td>". $value['nome']."</td>";
					$table .= "<td>". $value['endereco']."</td>";
					

					$query_extra = " WHERE codcidade = ". $value['Cidade_codcidade'];
					$resultCity = $manager->read('Cidade', $query_extra);

					$table .= "<td>". $resultCity[0]['cidade']."</td>";
					$table .= "</tr>";
				}
			
			$table .= "</tbody>";
		$table .= "</table>";

		echo $table;
	 ?>







<!-- convertendo json para objeto javascript-->
	<script>
		createSelectCity('.select-city');


		function createSelectCity(nameSelect){
			var txt = '<?php print($city); ?> '; // insere o retorno do banco de dados na variável 
			var data =  JSON.parse(txt); //converte para objeto
			// console.log(data);

			// localiza a tebela
			var select = document.querySelector('.select-city');
			
		// 	//insere a linha com o código e o nome do curso na tabela
			data.forEach( (el)=>{
				var option = document.createElement("option");
				option.setAttribute("value", ""+el.codcidade +"");
				option.innerHTML = el.cidade; 
				select.appendChild(option);
			});
		}
		
		
	</script>
</body>
</html>