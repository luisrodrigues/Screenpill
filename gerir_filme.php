<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Gerir Filme";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 require_once "classes/ator.php";
 require_once "classes/filmes.php";
 require_once "classes/realizador.php";

//Carregar dados do ator
if(isset($_POST["id-filme"]) && isset($_POST["carregar-filme"])){

	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);

	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} elseif(isset($_POST["id-filme"]) && isset($_POST["associar-ator"])) {
	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);
	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} elseif(isset($_POST["id-filme"]) && isset($_POST["retirar-ator"])) {
	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);
	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} elseif(isset($_POST["id-filme"]) && isset($_POST["associar-realizador"])) {
	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);
	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} elseif(isset($_POST["id-filme"]) && isset($_POST["retirar-realizador"])) {
	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);
	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} elseif(isset($_POST["editar-filme"])) {
	$filme_escolhido = new filme();
	$filme_escolhido->loadById($_POST["id-filme"]);
	$botao_nome = "editar-filme";
	$botao_value = "Editar";
} else {
	$filme_escolhido = new filme();
	$botao_nome = "publicar-filme";
	$botao_value = "Publicar";
}
	
?>
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Gerir Filme</li></a>
		</ul>
		<!--Poster filme -->
		<?php if(isset($_POST["id-filme"])) {	?>
			<img src="<?php echo $filme_escolhido->poster; ?>" class="main-film-pic" />
		<?php }	?>

		<!--Combobox para carregar filme-->
		<form class="editar-perfil" method="post" action="gerir_filme.php">
			<select class="comment-box" name="id-filme">
				<?php
					$filmes = array();
					$filmes = filme::getAll();

					foreach ($filmes as $filme): ?>
						<option value="<?php echo $filme->filme_id;?>" 
							<?php echo ($filme->filme_id == $filme_escolhido->filme_id) ? 'selected' : '' ?>>
							<?php echo $filme->titulo;?>
						</option>
					<?php endforeach; ?>
			</select>
			<!--Botão para carregar filme-->
			<span>
				<input class="comment-add" type="submit" name="carregar-filme" value="Carregar">
			</span>
		</form>

		<form class="editar-perfil" method="post" action="gerir_filme.php">
			
			<input type ="hidden" name="id-filme" value="<?php echo $_POST["id-filme"];?>">
			
			<label>Título</label>
			<input class="comment-box" type="text" name="titulo-filme" value="<?php echo $filme_escolhido->titulo; ?>">

			<label>Duração</label>
			<input class="comment-box" type="text" name="duracao-filme" value="<?php echo $filme_escolhido->duracao; ?>">

			<label>Descrição</label>
			<input class="comment-box" type="text" name="descricao-filme" value="<?php echo $filme_escolhido->descricao; ?>">

			<label>Ano de Estreia</label>
			<input class="comment-box" type="text" name="ano-filme" value="<?php echo $filme_escolhido->ano_de_estreia; ?>">
			
			<label>Poster</label>
			<input class="comment-box" type="text" name="poster-filme" value="<?php echo $filme_escolhido->poster; ?>">

			<label>Género</label>
			<!--Combobox para escolher o genero-->
			<select class="comment-box" name="id-genero-filme">
				<?php
					$generos = array();
					$generos = genero::loadAll();

					foreach ($generos as $genero): ?>
						<option value="<?php echo $genero->genero_id;?>"
							<?php echo ($genero->genero_id == $filme_escolhido->genero_id) ? 'selected' : '' ?>>
							<?php echo $genero->nome;?>
						</option>
					<?php endforeach; ?>
			</select>

			<span>
				<?
					/*
						$permissao_publicar_filme = $este_utilizador->verificar_permissao("publicar_filme");
						
						if($permissao_publicar) { 
							echo "botao";
						}
						
					*/
				?>

				<?php
					$publicar_estudio = $este_utilizador->verificar_permissao("publicar");
					if($publicar_estudio) {
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>";
					}
				?>
				
				<?php
					$apagar_filme = $este_utilizador->verificar_permissao("apagar");
					if($apagar_filme) {
						echo "<input class='comment-add' type='submit' name='apagar-filme' value='Apagar'>";
					}
				?>
			</span>
		</form>

	</div>
			<?php if(isset($_POST["carregar-filme"])){ ?>
	<div class="main-right">
		<form class="editar-perfil" method="post" action="gerir_filme.php">
			
			
			<span>
			<h1 class="main-title">Estúdio</h1>
			
			<?php
				
				$estudios = array();
				$estudios = $filme_escolhido->getEstudios();

				foreach($estudios as $estudio):
					echo "<li class='main-list-item underline'>$estudio->nome</li>";
				endforeach;
			?>
			</span>
			
			<!--Combobox para escolher realizador-->
		
			<h1 class="main-title">Realizador</h1>
			<select class="comment-box" name="id-realizador">
				<option value="">--</option>
				<?php
					$realizadores = array();
					$realizadores = realizador::loadAll();

					foreach ($realizadores as $realizador): ?>
						<option value="<?php echo $realizador->id;?>" >
							<?php echo $realizador->nome;?>
						</option>
					<?php endforeach;  ?>	
			</select>
			<?php
				
				$realizadores = array();
				$realizadores = $filme_escolhido->getRealizadores();

				foreach($realizadores as $realizador):
					echo "<a href='ver_realizador.php?id=$realizador->id'><li class='main-list-item underline'>$realizador->nome</li></a>";
				endforeach;
				
			?>
			<span>
			<input type ="hidden" name="id-filme" value="<?php echo $_POST["id-filme"];?>">

				<?php
					$associar_realizador = $este_utilizador->verificar_permissao("associar");
					if($associar_realizador) {
						echo "<input class='comment-add' type='submit' name='associar-realizador' value='Adicionar'>";
					}
				?>
				<?php
					$desassociar_realizador = $este_utilizador->verificar_permissao("desassociar");
					if($desassociar_realizador) {
						echo "<input class='comment-add' type='submit' name='retirar-realizador' value='Retirar'>";
					}
				?>
			</span>


			<span>
			<h1 class="main-title">Elenco</h1>
			<select class="comment-box" name="id-ator">
				<option value="">--</option>
				<?php

					$atores = array();
					$atores = ator::loadAll();

					foreach ($atores as $ator): ?>
						<option value="<?php echo $ator->id;?>" >
							<?php echo $ator->nome;?>
						</option>
					<?php endforeach; ?>
			</select>

			<?php
				
				$elenco = array();
				$elenco = $filme_escolhido->getAtores();

				foreach($elenco as $ator):
					echo "<a href='ver_ator.php?id=$ator->id'><li class='main-list-item underline'>$ator->nome</li></a>";
				endforeach;
				
			?>
			</span>
			<span>
			<input type ="hidden" name="id-filme" value="<?php echo $_POST["id-filme"];?>">
			<?php
					$associar_ator = $este_utilizador->verificar_permissao("associar");
					if($associar_ator) {
						echo "<input class='comment-add' type='submit' name='associar-ator' value='Adicionar'>";
					}
				?>
				<?php
					$desassociar_ator = $este_utilizador->verificar_permissao("desassociar");
					if($desassociar_ator) {
						echo "<input class='comment-add' type='submit' name='retirar-ator' value='Retirar'>";
					}
				?>
			</span>
			<?php } ?>
		</form>
		<?php 
		
		//Associar ator
		if(isset($_POST["associar-ator"], $_POST["id-ator"])) {
			if($_POST["id-ator"] != "") {
				if($filme_escolhido->verificaAssoAtor($_POST["id-ator"])) {
					//Colocar mensagem de erro a dizer que já estão associados
					echo "O ator já está associado ao filme!";
				} else {
					$filme_escolhido->associarAtor($_POST["id-ator"], $filme_escolhido->filme_id);
					echo "O ator foi associado ao filme!";
				}
			} else {
				//Colocar mensagem de erro a dizer que é preciso escolher um ator
			}
		}
		//Retirar ator de um filme
		if(isset($_POST["retirar-ator"], $_POST["id-ator"])) {
			if($_POST["id-ator"] != "") {
				if($filme_escolhido->verificaAssoAtor($_POST["id-ator"])) {
					$filme_escolhido->retirarAtor($_POST["id-ator"], $filme_escolhido->filme_id);
					echo "O ator foi retirado do filme.";
				} else {
					//Colocar mensagem de erro a dizer que já estão associados
					echo "O ator não está associado ao filme!";
				}
			} else {
				//Colocar mensagem de erro a dizer que é preciso escolher um ator
			}
		}

		//Associar realizador
		if(isset($_POST["associar-realizador"], $_POST["id-realizador"])) {
			if($_POST["id-realizador"] != "") {
				if($filme_escolhido->verificaAssoRealizador($_POST["id-realizador"])) {
					//Colocar mensagem de erro a dizer que já estão associados
					echo "O realizador já está associado ao filme!";
				} else {
					$filme_escolhido->associarRealizador($_POST["id-realizador"], $filme_escolhido->filme_id);
					echo "O realizador foi associado ao filme!";
				}
			} else {
				//Colocar mensagem de erro a dizer que é preciso escolher um ator
			}
		}
		//Retirar realizador de um filme
		if(isset($_POST["retirar-realizador"], $_POST["id-realizador"])) {
			if($_POST["id-realizador"] != "") {
				if($filme_escolhido->verificaAssoRealizador($_POST["id-realizador"])) {
					$filme_escolhido->retirarRealizador($_POST["id-realizador"], $filme_escolhido->filme_id);
					echo "O realizador foi retirado do filme.";
				} else {
					//Colocar mensagem de erro a dizer que já estão associados
					echo "O realizador não está associado ao filme!";
				}
			} else {
				//Colocar mensagem de erro a dizer que é preciso escolher um ator
			}
		}
		
		

		 //Editar dados do filme
		if(isset($_POST["editar-filme"])){
			$novo_titulo = $_POST["titulo-filme"] ;
			$nova_duracao = $_POST["duracao-filme"];
			$nova_descricao = $_POST["descricao-filme"];
			$novo_ano = $_POST["ano-filme"];
			$novo_poster = $_POST["poster-filme"];
			$novo_genero = $_POST["id-genero-filme"];
			$id = $_POST["id-filme"];
	
			$filme_escolhido->editar($id, $novo_genero, $novo_titulo, $nova_duracao, $nova_descricao, $novo_poster, $novo_ano);
			$filme_escolhido->loadById($id);
		}
		
		//Publicar um novo filme
		if(isset($_POST["publicar-filme"])){
			$novo_titulo = $_POST["titulo-filme"] ;
			$nova_duracao = $_POST["duracao-filme"];
			$nova_descricao = $_POST["descricao-filme"];
			$novo_poster = $_POST["poster-filme"];
			$novo_ano = $_POST["ano-filme"];
			$novo_genero = $_POST["id-genero-filme"];
			
			$novo_filme = new filme();
			$novo_filme->inserir($novo_genero, $novo_titulo, $nova_duracao, $nova_descricao, $novo_poster, $novo_ano);
		}
		
		//Apagar um filme
		if(isset($_POST["apagar-filme"])){
			$id = $_POST["id-filme"];
			$filme_escolhido->apagar($id);
		}
	?>
	</div>
	

</div>
<?php

	
 include "utils/footer.php";
?>