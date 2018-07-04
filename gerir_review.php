<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Gerir Review";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 require_once "classes/reviews.php";
 
 
 //Carregar dados da review
	
	if(isset($_POST["id-review"]) && isset($_POST["carregar-review"])){
	$review_escolhida = new review();
	$review_escolhida->loadById($_POST["id-review"]);
	$fil = $review_escolhida->getFilme();
	$nome_filme = $fil->titulo;
	$botao_nome = "editar-review";
	$botao_value = "Editar";
	} elseif(isset($_POST["id-review"]) && isset($_POST["editar-review"])) {
	$review_escolhida = new review();
	$review_escolhida->loadById($_POST["id-review"]);
	$fil = $review_escolhida->getFilme();
	$nome_filme = $fil->titulo;
	$botao_nome = "editar-review";
	$botao_value = "Editar";
	} elseif(isset($_POST["apagar-review"])) {
	$review_escolhida = new review();
	$botao_nome = "publicar-review";
	$botao_value = "Publicar";
	} else {
	$review_escolhida = new review();
	$botao_nome = "publicar-review";
	$botao_value = "Publicar";
}
		
?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Gerir Review</li></a>
		</ul>
		
		<form class="editar-perfil" method="post" action="gerir_review.php">
			<select class="comment-box" name="id-review">
				
				<?php

					$reviews = array();
					$reviews = review::getAll();

					foreach ($reviews as $review): ?>
						<option value="<?php echo $review->review_id;?>" >
							<?php echo $review->titulo;?>
						</option>
					<?php endforeach; ?>
			</select>
			<span>
				<input class="comment-add" type="submit" name="carregar-review" value="Carregar">
			</span>
		</form>
	</div>
	
	<div class="main-right">
		<form class="editar-perfil" method="post" action="gerir_review.php">

			<input type="hidden" name="id-review" value="<?php echo $_POST["id-review"];?>">
			
			<label>Título</label>
			<input class="comment-box" type="text" name="titulo-review" value="<?php echo $review_escolhida->titulo; ?>">
		
			<label>Filme</label>
			<select class="comment-box" name="id-filme">
				<?php
					$filmes = array();
					$filmes = filme::getAll();

					foreach ($filmes as $filme): ?>
						<option value="<?php echo $filme->filme_id;?>" >
							<?php echo $filme->titulo;?>
						</option>
					<?php endforeach; ?>
			</select>

			<label>Rating</label>
			<input class="comment-box" type="int" name="rating-review" value="<?php echo $review_escolhida->rating; ?>">

			<label>Opinião</label>
			<input class="comment-box" type="text" name="opiniao-review" value="<?php echo $review_escolhida->texto; ?>">
			
			<span>
				<input type="hidden" name="id-review" value="<?php echo $_POST["id-review"];?>">

				<?php 
					if(!isset($_POST["carregar-review"])) {
						
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>" ;
					} elseif($este_utilizador->id == $review_escolhida->getAutorFull()->id) {
						echo "<input class='comment-add' type='submit' name=$botao_nome value=$botao_value>" ;
						echo "<input class='comment-add' type='submit' name='apagar-review' value='Apagar'>" ;
					}
				?>
			</span>
		</form>
		
	
	</div>	
</div>
	<?php
		
		
		//Editar dados da review
	 	if(isset($_POST["editar-review"])) {
			$novo_titulo = $_POST["titulo-review"];
			$nova_opiniao = $_POST["opiniao-review"];
			$novo_rating = $_POST["rating-review"];
			$id = $_POST["id-review"];
			
			$review_escolhida->editar($id, $novo_titulo, $nova_opiniao, $novo_rating);
			$review_escolhida->loadById($review_id);
	 	}
		
		//Publicar uma nova review
		if(isset($_POST["publicar-review"])){
			$nova_review = new review();
			$novo_titulo = $_POST["titulo-review"] ;
			$novo_rating = $_POST["rating-review"];
			$nova_opiniao= $_POST["opiniao-review"];
			$novo_filmeid = $_POST["id-filme"];
			$novo_utilizadorid = $este_utilizador->id;
			
			$nova_review->inserir(date('Y-m-d H:i:s'), $novo_titulo, $nova_opiniao, $novo_rating, $novo_filmeid, $novo_utilizadorid);
		}
		
		//Apagar uma review
		if(isset($_POST["apagar-review"])){
			$id = $_POST["id-review"];
			$review_escolhida->apagar($id);
		}
		?>




<?
 include "utils/footer.php";
?>