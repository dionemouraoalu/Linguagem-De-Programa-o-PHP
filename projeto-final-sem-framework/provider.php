<?php 
	require_once('models/Conection.model.php');
	require_once('models/Manager.model.php');

	$connect = new Connect;
	$manager =  new Manager($connect);
	$result = $manager->read('Cidade');;
	
	$return = json_encode($result);

 ?>




<DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Fornecedores</title>
</head>
<body>
	<label>PHP Curso</label>

	<div>
		<label>Home</label>
		<label>Produtos</label>
		<label>Fornecedores</label>
		<label>Transportadora</label>
		<label>Categoria</label>

	</div>	

	<form method="post" action="controllers/Manager.class.php?acao=cadastrar">
		<input type="hidden" name="local" value="X5MPuu"/> 
		<select class="select-city" name="Cidade_codcidade">
			<option value="">Selecione uma cidade</option>
		</select>
		<input type="text" name="fornecedor" placeholder="fornecedor" />
		<input type="text" name="endereco" placeholder="endereco"/>
		<input type="number" name="num" placeholder="num"/>
		<input type="text" name="bairro" placeholder="bairro"/>
		<input type="text" name="cep" placeholder="cep" min="1" max="9"/>
		<input type="text" name="contato" placeholder="contato"/>
		<input type="text" name="cnpj" placeholder="cnpj" min="1" max="18"/>
		<input type="text" name="insc" placeholder="insc" />
		<input type="text" name="tel" placeholder="tel" min="1" max="14"/>
		<input type="submit" value="Cadastrar" placeholder=>
	</form>




<table>
	<thead>
		
	</thead>

	<tbody>
		
	</tbody>	
</table>




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
			select .innerHTML = [ "<option value=''>Selecione uma cidade</option>" + "<option value='" +el.codcidade +"' >" + el.cidade + '</option>'].join("\n") ;
			//select.appendChild(option);
		});
		
	</script>
</body>
</html>