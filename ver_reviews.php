<?php
/*
	Esta página serve como exemplo para as restantes.
	Instruções:

	1 - mudar a variável title, referente ao título da página
	2 - Verificar os estilos da página (se for acrescentada outro ficheiro css é importante dar-lhe um título semelhante à variavel title desta página)
	3 - Escrever a partir de onde é indicado

*/


 $title = "ScreenPill : Ver Reviews";
 include "utils/header.php";
 //estilos (CSS)
 echo "<link rel='stylesheet' type='text/css' href='css/dashboard.css'>";
 echo "<link rel='stylesheet' type='text/css' href='css/ver_styles.css'>";

 include "utils/menu.php";
 
if(isset($_GET["ver"]) && $_GET["ver"] == "todos") {
	$ver_reviews=$este_utilizador->getAllReviews();
} else if(isset($_GET["ver"]) && $_GET["ver"] == "seguidores") {
	$ver_reviews=$este_utilizador->getAllReviewsSeguidores();
}

?>
	
<div class="main">
	<div class="main-left">
		<ul class="main-primary-menu">
			<a href="ver_filmes.php?ver=todos"><li class="main-primary-menu-item">Filmes</li></a>
			<a href="ver_reviews.php?ver=todos"><li class="main-primary-menu-item">Reviews</li></a>
			<a href="ver_utilizadores.php?ver=todos"><li class="main-primary-menu-item">Users</li></a>
		</ul>
		<ul class="main-secondary-menu">
			<a href="ver_reviews.php?ver=todos"><li class="main-secondary-menu-item">Todas</li></a>
			<a href="ver_reviews.php?ver=seguidores"><li class="main-secondary-menu-item">Seguidores</li></a>
		</ul>
		<?
			
			foreach ($ver_reviews as $review) {
				$filme = $review->getFilme();
				$autor_nome = $review->getAutor();
				$ymd_date = date("Y/m/d", strtotime($review->data));
				
				echo "<div class='ver-card'>
						<img src='$filme->poster' class='ver-poster'>
						<span class='ver-card-info'>
							<a href='ver_review.php?id=$review->review_id'><h1 class='ver-card-title underline'>$review->titulo</h1></a>
							<p class='ver-card-p'>by <a href='ver_perfil.php?id=$review->utilizador_id'><span class='underline'>$autor_nome</span></a></p>
							<p class='ver-card-p'><b>$review->rating/10</b></p>
							<p class='ver-data'>Adicionada a $ymd_date</p>
						</span>
					</div>";
			}
				
		?>
	</div>	
</div>
<?
 include "utils/footer.php";
?>