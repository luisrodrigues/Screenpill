<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Feed";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="#"><li class="main-primary-menu-item">Feed</li></a>
		</ul>
		<ul class="main-secondary-menu">
			<a href="feed.php?ver=comentarios"><li class="main-secondary-menu-item">Comentários</li></a>
			<a href="feed.php?ver=favoritos"><li class="main-secondary-menu-item">Favoritos</li></a>
			<a href="feed.php?ver=reviews"><li class="main-secondary-menu-item">Reviews</li></a>
			<a href="feed.php?ver=seguidores"><li class="main-secondary-menu-item">Seguidores</li></a>
		</ul>
		<?

			if(isset($_GET["ver"]) && $_GET["ver"] == "comentarios") {
				$feed_comentario = new comentario();
				$feed_comentarios = $feed_comentario->getAllComentarios();

				foreach ($feed_comentarios as $comentario) {
					$utilizador = $comentario->getAutor();
					$review = $comentario->getReview();
					$data = $comentario->getDateDiff();
					
					echo "<div class='ver-card feed-card'>
							<p><span class='underline'><b><a href='ver_perfil.php?id=$utilizador->id'>$utilizador->nome</a></b></span> comentou <span class='underline'><b><a href='ver_review.php?id=$review->review_id'>$review->titulo</a></b></span> há <b>$data horas</b>.</p>	
						</div>";
				}

			} else if(isset($_GET["ver"]) && $_GET["ver"] == "favoritos") {
				$feed_favoritos=$este_utilizador->getAllFavoritos();
				
				foreach ($feed_favoritos as $favorito) {
					$utilizador = new utilizador();
					$utilizador->loadById($favorito["utilizador_id"]);
					$data = $utilizador->getDateDiff($favorito["data"]);
					$filme = new filme();
					$filme->loadById($favorito["filme_id"]);
					
					echo "<div class='ver-card feed-card'>
							<p><span class='underline'><b><a href='ver_perfil.php?id=$utilizador->id'>$utilizador->nome</a></b></span> adicionou aos favoritos <span class='underline'><b><a href='ver_filme.php?id=$filme->filme_id'>$filme->titulo</a></b></span> há <b>$data horas</b>.</p>	
						</div>";
				}


			} else if(isset($_GET["ver"]) && $_GET["ver"] == "reviews") {
				$feed_reviews=$este_utilizador->getAllReviews();

				foreach ($feed_reviews as $review) {
					$autor = $review->getAutorFull();
					$data = $review->getDateDiff();
					
					echo "<div class='ver-card feed-card'>
							<p><span class='underline'><b><a href='ver_perfil.php?id=$autor->id'>$autor->nome</a></b></span> adicionou a review <span class='underline'><b><a href='ver_review.php?id=$review->review_id'>$review->titulo</a></b></span> há <b>$data horas</b>.</p>	
						</div>";
				}


			} else if(isset($_GET["ver"]) && $_GET["ver"] == "seguidores") {
				$feed_seguidores=$este_utilizador->getAllSeguidores();
				
				foreach ($feed_seguidores as $seguidor) {
					$utilizadorSeguido = new utilizador();
					$utilizadorSeguidor = new utilizador();
					$utilizadorSeguido->loadById($seguidor["id_seguido"]);
					$utilizadorSeguidor->loadById($seguidor["id_seguidor"]);
					$data = $utilizadorSeguido->getDateDiff($seguidor["data"]);
					
					echo "<div class='ver-card feed-card'>
							<p><span class='underline'><b><a href='ver_perfil.php?id=$utilizadorSeguidor->id'>$utilizadorSeguidor->nome</a></b></span> seguiu <span class='underline'><b><a href='ver_perfil.php?id=$utilizadorSeguido->id'>$utilizadorSeguido->nome</a></b></span> há <b>$data horas</b>.</p>	
						</div>";
				}

			}
		?>
	</div>	
</div>
<?
 include "utils/footer.php";
?>