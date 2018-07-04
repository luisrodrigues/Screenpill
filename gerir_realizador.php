<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Gerir Realizador";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 require_once "classes/realizador.php";

//Carregar dados do realizador
if(isset($_POST["id-realizador"]) && isset($_POST["carregar-realizador"])){
	$realizador_escolhido = new realizador();
	$realizador_escolhido->loadById($_POST["id-realizador"]);
	$botao_nome = "editar-realizador";
	$botao_value = "Editar";
} else {
	$realizador_escolhido = new realizador();
	$botao_nome = "publicar-realizador";
	$botao_value = "Publicar";
}

	
?>
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Gerir Realizador</li></a>
		</ul>

		<?php if(isset($_POST["id-realizador"])) {	?>
			<img src="<?php echo $realizador_escolhido->foto; ?>" class="main-film-pic" />
		<?php }	?>

		<form class="editar-perfil" method="post" action="gerir_realizador.php">
			<select class="comment-box" name="id-realizador">
				<?php

					$realizadores = array();
					$realizadores = realizador::loadAll();

					foreach ($realizadores as $realizador): ?>
						<option value="<?php echo $realizador->id;?>" >
							<?php echo $realizador->nome;?>
						</option>
					<?php endforeach; ?>
			</select>
			
			<span>
				<input class="comment-add" type="submit" name="carregar-realizador" value="Carregar">
			</span>

		</form>

	</div>

	<div class="main-right">
		<form class="editar-perfil" method="post" action="gerir_realizador.php">
			
			<input type ="hidden" name="id-realizador" value="<?php echo $_POST["id-realizador"];?>">
			
			<label>Nome</label>
			<input class="comment-box" type="text" name="nome-realizador" value="<?php echo $realizador_escolhido->nome; ?>">

			<label>Data de Nascimento</label>
			<input class="comment-box" type="date" name="data-realizador" value="<?php echo $realizador_escolhido->data; ?>">

			<label>Fotografia</label>
			<input class="comment-box" type="text" name="foto-realizador" value="<?php echo $realizador_escolhido->foto; ?>">

			<label>Biografia</label>
			<input class="comment-box" type="text" name="bio-realizador" value="<?php echo $realizador_escolhido->bio; ?>">
			
			<span>
				<?php
					$publicar_realizador = $este_utilizador->verificar_permissao("publicar");
					if($publicar_realizador) {
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>";
					}
				?>
				<?php
					$apagar_realizador = $este_utilizador->verificar_permissao("desassociar");
					if($apagar_realizador) {
						echo "<input class='comment-add' type='submit' name='apagar-realizador' value='Apagar'>";
					}
				?>
			</span>
		</form>
		<?php 
		 //Editar dados do realizador
		if(isset($_POST["editar-realizador"])){
			$novo_nome = $_POST["nome-realizador"] ;
			$nova_data = $_POST["data-realizador"];
			$novo_foto = $_POST["foto-realizador"];
			$novo_bio = $_POST["bio-realizador"];
			$id = $_POST["id-realizador"];
	
			$realizador_escolhido->editar($id, $novo_nome, $nova_data, $novo_foto, $novo_bio);
			$realizador_escolhido->loadById($id);

		}
		
		//Publicar um novo realizador
		if(isset($_POST["publicar-realizador"])){
			$novo_realizador = new realizador();
			$novo_nome = $_POST["nome-realizador"] ;
			$nova_data = $_POST["data-realizador"];
			$novo_foto = $_POST["foto-realizador"];
			$novo_bio = $_POST["bio-realizador"];
			
			$novo_realizador->inserir($novo_nome, $nova_data, $novo_foto, $novo_bio);
		}
		
		//Apagar um realizador
		if(isset($_POST["apagar-realizador"])){
			$id = $_POST["id-realizador"];
			$realizador_escolhido->apagar($id);
		}
	?>
	</div>
	

</div>
<?php

	
 include "utils/footer.php";
?>