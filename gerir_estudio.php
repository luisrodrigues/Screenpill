<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Gerir Estúdio";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 require_once "classes/estudio.php";
 require_once "classes/filmes.php";
 require_once "classes/estudiofilme.php";
 include "ligarbd.php";

/*esta função verifica se o botao carregar foi premido
 se for, vai buscar o valor da option escolhida na combobox com o nome estudio-selecionado, 
 nesse caso o id do estudio. Depois faz-se o load com base nesse id
Finalmente é só fazer print nas inputboxes (essa parte não fiz)
 */
 #(isset($_POST["load-estudio"])
 if ((isset($_POST["load-estudio"])) && isset($_POST["estudio-selecionado"]))	{
 	$estudio_selecionado = new estudio();
 	$estudio_selecionado->loadById($_POST["estudio-selecionado"]);
	$botao_nome = "editar-estudio";
	$botao_value = "Editar";
 }
 else {
	$estudio_selecionado = new estudio();
	$botao_nome = "publicar-estudio";
	$botao_value = "Publicar";	
 }
?>

<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Gerir Estúdio</li></a>
		</ul>
		<form class="editar-perfil" method="post" action="gerir_estudio.php">
			<select class="comment-box" name="estudio-selecionado">
				<?php

					$estudios = array();
					$estudios = estudio::getAll();

					foreach ($estudios as $estudio) {
						echo "<option value='$estudio->id'>$estudio->nome</option>";
					}
				?>
			</select>
			
			<span>
				<input class="comment-add" type="submit" name="load-estudio" value="Carregar">
				<?php 
					$apagar_estudio = $este_utilizador->verificar_permissao("apagar");

					if($apagar_estudio) {
						echo "<input class='comment-add' type='submit' name='apagar-estudio' value='Apagar'>";
					}

				?> 
				
			</span>
			
			
			<label>Filme</label>
			<select class="comment-box" name="filme-selecionado">
					<?php

					$fils = array();
					$fils = filme::getAll();

					foreach ($fils as $filme) {
						echo "<option value ='$filme->filme_id'>$filme->titulo</option>";
					}
					?>
			</select>
			<span>
			<?php
				$associar_estudio = $este_utilizador->verificar_permissao("associar");
				if($associar_estudio) {
					echo "<input class='comment-add' type='submit' name='associar-filme-estudio' value='Associar'>";
				}
			?>
		</span>
		</form>
	</div>
	<div class="main-right">
		<form class="editar-perfil" method="post" action="gerir_estudio.php">
		
			<input type="hidden" name="estudio-selecionado" value="<?php echo $_POST["estudio-selecionado"];?>">
			<label>Nome</label>
			<input class="comment-box" type="text" name="nome-estudio" value="<?php echo $estudio_selecionado->nome; ?>">
			<label>Data de Criação</label>
			<input class="comment-box" type="date" name="data-estudio" value="<?php echo $estudio_selecionado->data; ?>">
			<label>Sede</label>
			<input class="comment-box" type="text" name="sede-estudio" value="<?php echo $estudio_selecionado->sede; ?>">
			<label>Descrição</label>
			<input class="comment-box" type="text" name="descricao-estudio" value="<?php echo $estudio_selecionado->descricao; ?>">
			<span>
				<?php
					$publicar_estudio = $este_utilizador->verificar_permissao("publicar");
					if($publicar_estudio) {
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>";
					}
				?>
			</span>
		</form>
		<?php
		if(isset($_POST["editar-estudio"])) {
			$novo_id = $_POST["estudio-selecionado"];
			$novo_nome = $_POST["nome-estudio"];   
			$novo_data = $_POST["data-estudio"];
			$novo_sede = $_POST["sede-estudio"];
			$novo_descricao = $_POST["descricao-estudio"];
			$estudio_selecionado->editar($novo_id, $novo_nome, $novo_data, $novo_sede, $novo_descricao);
	 	}
		
		if(isset($_POST["apagar-estudio"])) {
			$novo_id = $_POST["estudio-selecionado"];
			$estudio_selecionado->apagar($novo_id);  
	 	}
		
		if(isset($_POST["publicar-estudio"])) {
			$novo_estudio = new estudio();
			$novo_nome = $_POST["nome-estudio"];   
			$novo_data = $_POST["data-estudio"];
			$novo_sede = $_POST["sede-estudio"];
			$novo_descricao = $_POST["descricao-estudio"];
			$novo_estudio->inserir($novo_nome, $novo_data, $novo_sede, $novo_descricao);

	 	}
		
		if(isset($_POST["associar-filme-estudio"])) {
			
			$estudio_id= $_POST["estudio-selecionado"];
			$filme_id= $_POST["filme-selecionado"]; 
			$associar = new estudiofilme();
			$associar->inserir($estudio_id,$filme_id);

	 	}
		
		
		
		
		
		
		
		
		
		
		
		
?>
	</div>   
	
</div>

<?
 include "utils/footer.php";
?>