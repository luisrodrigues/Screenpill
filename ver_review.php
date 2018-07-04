<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Review";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
 if(isset($_GET["id"])) {
	$review_id = $_GET["id"];
	$ver_review = new review();
	$ver_review->loadById($review_id);

	$ver_review_filme = $ver_review->getFilme();
 }
?>
	
<div class="main">
	<div class="main-left">
		<h1 class="main-title"><? echo $ver_review->titulo; ?></h1>
		<a href="ver_perfil.php?id=<? echo $ver_review->utilizador_id; ?>"><p class="main-text">by <span class="underline"><? echo $ver_review->getAutor(); ?></span></p></a>
		<img src="<? echo $ver_review_filme->poster;?>" class="main-film-pic">
		<a href="ver_filme.php?id=<? echo $ver_review_filme->filme_id;?>"><p class="main-text underline"><? echo $ver_review_filme->titulo; ?></p></a>
		<h1 class="main-title">Opinião</h1>
		<p class="main-text-long"><? echo $ver_review->texto; ?></p>
		<h1 class="main-title"><? echo $ver_review->rating; ?>/10</h1>
	</div>
	<div class="main-right">
		<h1 class="main-title">Comentários</h1>
		<form method="post" action="<? echo "ver_review.php?id=$ver_review->review_id"; ?>">
			<input class="comment-box" type="text" name="comentario" placeholder="Escreve aqui o teu comentário">
			<input class="comment-add" type="submit" name="add-comentario" value="Adicionar">
		</form>
		<?php 
			
			if(isset($_POST["add-comentario"])) {
				$descricao = $_POST["comentario"];

				if($descricao != "") {
					$novo_comentario = new comentario();
					$novo_comentario->insert($este_utilizador->id, $ver_review->review_id, $descricao);
				}
		 	}

		 	if(isset($_GET["action"]) && $_GET["action"]=="delete" && isset($_GET["comentario_id"])) {
		 		$comentario_apagar = new comentario();
				$comentario_apagar->delete($_GET["comentario_id"]);
			}

		?>
		<ul>
			<? 
				
				$comentarios = $ver_review->getComentarios();
					foreach	($comentarios as $comentario) {
						$autor = $comentario->getAutor();
						$data = $comentario->getDateDiff();
						$data_str = "horas";

						if($data == 1) {
							$data_str = "hora";
						}

						if($este_utilizador->id == $ver_review->utilizador_id) {
							echo "<li class='main-list-item'><b><span class='underline'><a href='ver_perfil.php?id=$autor->id'>$autor->nome</a></span> (há $data $data_str)</b>: $comentario->descricao <a class='underline' href='ver_review.php?id=$ver_review->review_id&action=delete&comentario_id=$comentario->comentario_id'><b>(delete)</b></a></li>";
						} else {
							echo "<li class='main-list-item'><b><span class='underline'><a href='ver_perfil.php?id=$autor->id'>$autor->nome</a></span> (há $data $data_str)</b>: $comentario->descricao</li>";
						}

					}
				
			?>
		</ul>
	</div>
</div>
<?
 include "utils/footer.php";
?>