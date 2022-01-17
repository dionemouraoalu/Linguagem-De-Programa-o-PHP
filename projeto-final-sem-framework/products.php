<?php 

	require_once('models/Conection.model.php');
	require_once('models/Manager.model.php');

	$connect = new Connect;
	$manager =  new Manager($connect);
	$resultCategory = $manager->read('Categoria');
	$resultProvide = $manager->read('Fornecedor');
	
	$category = json_encode($resultCategory);
	$provide = json_encode($resultProvide);

 ?>



<DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Produtos</title>
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

	<form style="max-width: 500px;" method="post" action="controllers/Products.controller.php?acao=cadastrar">

		<div class="form-outline">
			<select class="form-select select-category" name="Categoria">
				<option value="">Selecione uma categoria</option>
			</select>
		</div>

		<div class="form-outline">
			<select class="form-select select-provider" name="Fornecedor">
				<option value="">Selecione um Fornecedor</option>
			</select>
		</div>

		<div class="form-group">
		  <label for="usr">Descrição:</label>
		  <input type="text" class="form-control" id="usr" name="descricao" >
		</div>

		<div class="form-group">
		  <label for="usr">Peso:</label>
		  <input type="text" class="form-control" id="usr" name="peso" >
		</div>

		

		<div class="form-outline">
			<label for="usr">Controlado:</label>
			<select class="form-select select-controlado" name="Controlado">
				<option value="1">Sim</option>
				<option value="2">Não</option>
			</select>
		</div>

		<div class="form-group">
		  <label for="usr">Quantidade:</label>
		  <input type="text" class="form-control" id="usr" name="qtdemin" >
		</div>


		<div class="col-auto">
		    <button type="submit" class="btn btn-primary mb-3">Cadastrar</button>
		</div>
	</form>


	<?php 
		$resultProduct = $manager->read('Produto');

		// echo "<pre>";
		// print_r($resultProduct);
		// echo "</pre>";


		$table = "<table class='table table-striped'>";
			$table .= "<thead>";
				$table .= "<tr>";
					$table .= "<th>Id</th>";
					$table .= "<th>Descrição</th>";
					$table .= "<th>Categoria</th>";
					$table .= "<th>Fornecedor</th>";
					$table .= "<th>Peso</th>";
					$table .= "<th>Controlado</th>";
					$table .= "<th>Quantidade</th>";
				$table .= "</tr>";
			$table .= "</thead>";
			$table .= "<tbody>";
				
				foreach ($resultProduct as $key => $value) {
					$table .= "<tr>";
					$table .= "<td>". $value['codproduto'] ."</td>";
					$table .= "<td>". $value['descricao'] ."</td>";

					$query_extra = " WHERE codcategoria = ". $value['Categoria_codcategoria'];
					$resultCategory = $manager->read('Categoria', $query_extra);
					$table .= "<td>". $resultCategory[0]['categoria']."</td>";
					
					
					$query_extra = " WHERE codfornecedor = ". $value['Fornecedor_codfornecedor'];
					$resultProvider = $manager->read('Fornecedor', $query_extra);

					$table .= "<td>". $resultProvider[0]['fornecedor']."</td>";
					$table .= "<td>". $value['peso']."</td>";

					if($value['controlado'] == '1'){
						$table .= "<td>". 'Sim'."</td>";
					}else{
						$table .= "<td>". 'Não'."</td>";
					}

					$table .= "<td>". $value['qtdemin']."</td>";

					//echo $query_extra;
					$table .= "</tr>";
				}
			
			$table .= "</tbody>";
		$table .= "</table>";

		echo $table;
	 ?>







<!-- convertendo json para objeto javascript-->
	<script>
		createSelectCategory('.select-category');
		createSelectProvider('.select-provider');


		function createSelectCategory(nameSelect){
			var txt = '<?php print( $category ) ?> '; // insere o retorno do banco de dados na variável 
			var data =  JSON.parse(txt); //converte para objeto
			console.log(data);

			// localiza a tebela
			var select = document.querySelector(nameSelect);
			
			// //insere a linha com o código e o nome do curso na tabela
			data.forEach( (el)=>{
				var option = document.createElement("option");
				option.setAttribute("value", ""+el.codcategoria+"");
				option.innerHTML = el.categoria; 

				select.appendChild(option);
			});
		}

		function createSelectProvider(nameSelect){
			var txt = '<?php print( $provide) ?> '; // insere o retorno do banco de dados na variável 
			var data =  JSON.parse(txt); //converte para objeto
			// console.log(data);

			// localiza a tebela
			var select = document.querySelector(nameSelect);
			
			// //insere a linha com o código e o nome do curso na tabela
			data.forEach( (el)=>{
				var option = document.createElement("option");
				option.setAttribute("value", ""+el.codfornecedor+"");
				option.innerHTML = el.fornecedor; 

				select.appendChild(option);
			});
		}
		
		
	</script>
</body>
</html>