<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Gerir Ator";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 require_once "classes/ator.php";

//Carregar dados do ator
if(isset($_POST["id-ator"]) && isset($_POST["carregar-ator"])){
	$ator_escolhido = new Ator();
	$ator_escolhido->loadById($_POST["id-ator"]);
	$botao_nome = "editar-ator";
	$botao_value = "Editar";
} else {
	$ator_escolhido = new Ator();
	$botao_nome = "publicar-ator";
	$botao_value = "Publicar";
}
	
?>
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Gerir Ator</li></a>
		</ul>

		<?php if(isset($_POST["id-ator"])) {	?>
			<img src="<?php echo $ator_escolhido->foto; ?>" class="main-film-pic" />
		<?php }	?>

		<form class="editar-perfil" method="post" action="gerir_ator.php">
			<select class="comment-box" name="id-ator">
				<?php

					$atores = array();
					$atores = ator::loadAll();

					foreach ($atores as $ator): ?>
						<option value="<?php echo $ator->id;?>" >
							<?php echo $ator->nome;?>
						</option>
					<?php endforeach; ?>
			</select>
			
			<span>
				<input class="comment-add" type="submit" name="carregar-ator" value="Carregar">
			</span>

		</form>

	</div>

	<div class="main-right">
		<form class="editar-perfil" method="post" action="gerir_ator.php">
			
			<input type ="hidden" name="id-ator" value="<?php echo $_POST["id-ator"];?>">
			
			<label>Nome</label>
			<input class="comment-box" type="text" name="nome-ator" value="<?php echo $ator_escolhido->nome; ?>">

			<label>Data de Nascimento</label>
			<input class="comment-box" type="date" name="data-ator" value="<?php echo $ator_escolhido->data; ?>">

			<label>Fotografia</label>
			<input class="comment-box" type="text" name="foto-ator" value="<?php echo $ator_escolhido->foto; ?>">

			<label>Biografia</label>
			<input class="comment-box" type="text" name="bio-ator" value="<?php echo $ator_escolhido->bio; ?>">
			
			<span>
				<?php
					$publicar_ator = $este_utilizador->verificar_permissao("publicar");
					if($publicar_ator) {
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>";
					}
				?>
				<?php
					$apagar_ator = $este_utilizador->verificar_permissao("apagar");
					if($apagar_ator) {
						echo "<input class='comment-add' type='submit' name='apagar-ator' value='Apagar'>";
					}
				?>
			</span>
		</form>
		<?php 
		 //Editar dados do ator
		if(isset($_POST["editar-ator"])){
			$novo_nome = $_POST["nome-ator"] ;
			$nova_data = $_POST["data-ator"];
			$novo_foto = $_POST["foto-ator"];
			$novo_bio = $_POST["bio-ator"];
			$id = $_POST["id-ator"];
	
			$ator_escolhido->editar($id, $novo_nome, $nova_data, $novo_foto, $novo_bio);
			$ator_escolhido->loadById($id);

		}
		
		//Publicar um novo ator
		if(isset($_POST["publicar-ator"])){
			$novo_ator = new Ator();
			$novo_nome = $_POST["nome-ator"] ;
			$nova_data = $_POST["data-ator"];
			$novo_foto = $_POST["foto-ator"];
			$novo_bio = $_POST["bio-ator"];
			
			$novo_ator->inserir($novo_nome, $nova_data, $nova_foto, $nova_bio);
		}
		
		//Apagar um ator
		if(isset($_POST["apagar-ator"])){
			$id = $_POST["id-ator"];
			$ator_escolhido->apagar($id);
		}
	?>
	</div>
	

</div>
<?php

	
 include "utils/footer.php";
?>